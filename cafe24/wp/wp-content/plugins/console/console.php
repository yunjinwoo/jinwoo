<?php /*
Plugin Name: Console
Description: Description: Debug PHP variables in the JavaScript console (Chrome & Firebug). Use instead of PHP's native var_dump() function. Usage: &lt;?php console( $var ); ?&gt; - You can also tag a variable; Usage: &lt;?php console( $var, $tag ); ?&gt; - Debug with <a href="http://krumo.sourceforge.net/" target="_blank">Krumo</a>: &lt;?php console( $var, $tag, true ); ?&gt; - To globally enable Krumo, add: &lt;?php define( 'CONSOLE_KRUMO', true ); ?&gt; to functions.php OR wp-config.php. Shorthand: &lt;?php c( $var ); ?&gt; - You must be a logged-in Admin to see debug messages. 
Version: 1.7.2
Author: Kelly Meath
*/
add_action( 'plugins_loaded', 'console_plugins_loaded' );
function console_plugins_loaded(){
    global $console;
    $console = array( 
        'access' => ( is_user_logged_in() && current_user_can( 'activate_plugins' ) ),
        'data' => '',
        'krumo' => array(),
        'console' => array(),
        'caller' => false
    );
}
add_action( 'init', 'console_init' );
function console_init(){
    global $console;
    if( !isset($console['access']) || !$console['access'] ) return;
    require_once( dirname( __FILE__ ) . '/krumo/class.krumo.php' );
    add_action( 'wp_footer', 'console_wp_footer' );
    add_action( 'admin_footer', 'console_wp_footer' );
}
function console( $data, $tag = false, $krumo = false ){
    global $console;
    if( !$console['access'] ) return;
    $console['caller'] = debug_backtrace();
    c( $data, $tag, $krumo );
}
function c( $data, $tag = false, $krumo = false ){
    global $console;
    if( !isset($console) || !$console['access'] ) return;
    if( !$console['caller'] ) $console['caller'] = debug_backtrace();
    $console['line'] = '<span class="normal">Called from </span>' . $console['caller'][0]['file'] . '<span class="normal">, line </span>' . $console['caller'][0]['line'];
    $console['line'] = str_replace(ABSPATH, '', $console['line'] );
    $console['data'] = _console_escape_html($data);
    if( $krumo || ( defined( 'CONSOLE_KRUMO' ) && CONSOLE_KRUMO ) ){
        _console_build_dump_var('krumo', $tag);
    }

    _console_build_dump_var('console', $tag);
    $console['caller'] = false;
}

function _console_escape_html( $data ){
    $temp = array();
    if( !is_object( $data ) && !is_array( $data) ){
        $temp = $data;
    }
    elseif( is_array( $data ) || is_object( $data ) ){
        foreach( $data as $key => $val ){
            if( is_array( $val ) || is_object( $val ) ){
                $temp[$key] = _console_escape_html($val);
            }
            else{
                $temp[$key] = str_replace(array("&", "<", ">", "'", '"' ), array('&amp;', '&lt;', '&gt;', '&#39;', '&quot;'), $val);
            }
        }
    }
    return $temp;
}

function _console_build_dump_var( $key = false, $tag = false ){
    global $console;
    if( !isset($console['access']) || !$console['access'] ) return;
    $line = ( $key == 'krumo' ? $console['line'] : strip_tags( $console['line'] ) );
    if( $tag ){
        $tag = 'Tag: ' . $tag;
        if( isset($console[$key][$tag][$line]) && !is_array($console[$key][$tag][$line]) ){
            $temp = $console[$key][$tag][$line];
            $console[$key][$tag][$line] = array();
            $console[$key][$tag][$line][] = $console['data'];
        }
        elseif( isset($console[$key][$tag][$line]) && is_array($console[$key][$tag][$line]) ){
            $console[$key][$tag][$line][] = $console['data'];
        }
        else{
            $console[$key][$tag][$line] = $console['data'];
        }        
    }
    else{
        if( isset($console[$key][$line]) && !is_array($console[$key][$line]) ){
            $temp = $console[$key][$line];
            $console[$key][$line] = array();
            $console[$key][$line][] = $console['data'];
        }
        elseif( isset($console[$key][$line]) && is_array($console[$key][$line]) ){
            $console[$key][$line][] = $console['data'];
        }
        else{
            $console[$key][$line] = $console['data'];
        }
    }
}
function console_wp_footer(){
    global $console;
    if( !isset($console['access']) || !$console['access'] ) return;
    if( !empty( $console['krumo'] ) ) : ?>
        <div id="console-wrapper">
            <div id="console-header-wrapper">
                <div class="title">Console</div>
                <a class="close" onclick="javascript:this.parentNode.parentNode.style.display='none'; return false;">[X]</a>
            </div>
            <div id="console-krumo-dump">
                <?php krumo( $console['krumo'] ) ?>
            </div>
        </div>
    <?php endif; 
    if ( !empty( $console['console'] ) ) : ?>
    <script type="text/javascript">
        /* <![CDATA[ */
            if (typeof( console ) != 'undefined' && window.console && console.log ){
                console.log(<?php echo json_encode($console['console']); ?> );
            }
        /* ]]> */
    </script>
    <?php endif;
}