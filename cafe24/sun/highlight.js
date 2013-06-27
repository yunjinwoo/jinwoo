
/*
참고 옵션
http://alexgorbatchev.com/SyntaxHighlighter/manual/configuration/

<pre class="brush: css;html-script: true; ">
참고 소스
</pre>
*/
var cdn_path = 'http://alexgorbatchev.com/pub/sh/current/' ;
document.write( '<link type="text/css" rel="stylesheet" href="'+cdn_path+'styles/shCoreDefault.css"/>' );
document.write( '<link type="text/css" rel="Stylesheet" href="'+cdn_path+'styles/shThemeDefault.css"/>' );
document.write( '<scr'+'ipt type="text/javascript" src="'+cdn_path+'scripts/shCore.js"></scr'+'ipt>' );
document.write( '<scr'+'ipt type="text/javascript" src="'+cdn_path+'scripts/shBrushXml.js"></scr'+'ipt>' );

document.write( '<scr'+'ipt type="text/javascript" src="'+cdn_path+'scripts/shAutoloader.js"></scr'+'ipt>' );

function path()
{
  var args = arguments,
	  result = [] ;
	   
  for(var i = 0; i < args.length; i++)
	  result.push(args[i].replace('@', ''+cdn_path+'scripts/'));
	   
  return result ;
};

var highStart = function(){

//	SyntaxHighlighter.config.bloggerMode = false;
//	SyntaxHighlighter.config.stripBrs = true;

	SyntaxHighlighter.autoloader.apply(null, path(
	  'applescript            @shBrushAppleScript.js',
	  'actionscript3 as3      @shBrushAS3.js',
	  'bash shell             @shBrushBash.js',
	  'coldfusion cf          @shBrushColdFusion.js',
	  'cpp c                  @shBrushCpp.js',
	  'c# c-sharp csharp      @shBrushCSharp.js',
	  'css                    @shBrushCss.js',
	  'delphi pascal          @shBrushDelphi.js',
	  'diff patch pas         @shBrushDiff.js',
	  'erl erlang             @shBrushErlang.js',
	  'groovy                 @shBrushGroovy.js',
	  'java                   @shBrushJava.js',
	  'jfx javafx             @shBrushJavaFX.js',
	  'js jscript javascript  @shBrushJScript.js',
	  'perl pl                @shBrushPerl.js',
	  'php                    @shBrushPhp.js',
	  'text plain             @shBrushPlain.js',
	  'py python              @shBrushPython.js',
	  'ruby rails ror rb      @shBrushRuby.js',
	  'sass scss              @shBrushSass.js',
	  'scala                  @shBrushScala.js',
	  'sql                    @shBrushSql.js',
	  'vb vbnet               @shBrushVb.js',
	  'xml xhtml xslt html    @shBrushXml.js'
	));

	SyntaxHighlighter.all(); 
}


if (window.addEventListener) window.addEventListener("load", highStart, false);
else if (window.attachEvent) window.attachEvent("onload", highStart);
else window.onload = highStart
