=== Console ===
Contributors: kjmeath
Donate link: http://developertools.kjmeath.com/donate/
Tags: theme, developer, development, tool, tools, krumo, debug, debugging, php, console, firebug, javascript, plugin, fire, firephp, fireconsole, bug
Requires at least: 3.0.0
Tested up to: 3.3
Stable tag: 1.7.1
Debug PHP variables in the JavaScript console (Chrome & Firebug). Use instead of PHP's native var_dump() function. 
== Description ==
Debug PHP variables in the JavaScript console (Chrome & Firebug). Use instead of PHP's native var_dump() function. 
Usage: `<?php console( $var ); ?>`
You can also tag a variable; Usage: `<?php console( $var, $tag ); ?>`.
Debug with [Krumo](http://krumo.sourceforge.net/ "Krumo"): `<?php console( $var, $tag, true ); ?>`. 
To globally enable Krumo, add: `<?php define( 'CONSOLE_KRUMO', true ); ?>` to functions.php OR wp-config.php. 
Shorthand: `<?php c( $var ); ?>`. 
You must be a logged-in Admin to see debug messages.
== Installation ==
1. Download and unzip the Console plugin
2. Upload 'console' folder to the '/wp-content/plugins/' directory
3. Activate the plugin through the 'Plugins' menu in WordPress
== Frequently Asked Questions ==
= N/A =
== Screenshots ==
1. Console - Example of a PHP dump in the JavaScript console.1. Krumo - Example of a PHP dump with Krumo.1. Tagging - Example of tagging a PHP dump.

== Changelog === 1.7.2 =Fixed bug of console printing an empty array. = 1.7.1 =Improved console check in JavaScript. Fixed html entity replacement.
= 1.7 =
Fixed displaying html entities error in the JavaScript console. Added custom Krumo skin. Moved all inline CSS to custom Krumo skin. Added label to tagging.

= 1.6 =
Remove un-used Krumo skins. Fixed logic for checking access.
= 1.5 =
Fixed logic for dumping vars in a loop
= 1.4 =Public release
== Upgrade Notice ==
= 1.7 =
Fixed displaying html entities error in the JavaScript console.
= 1.4 =
N/A