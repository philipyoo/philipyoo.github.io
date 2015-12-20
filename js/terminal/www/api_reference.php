<?php // -*- mode: nxml -*-
header("X-Powered-By: ");
?>
<!DOCTYPE HTML>
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <meta charset="utf-8" />
    <title>JQuery Terminal Emulator Plugin - Api Reference</title>
    <link rel="canonical" href="http://terminal.jcubic.pl/api_reference.php"/>
    <meta name="author" content="Jakub Jankiewicz - jcubic&#64;onet.pl"/>
    <meta name="Description" content="API refernce for JQuery Terminal Emulator - list of all methods and options."/>
    <meta name="keywords" content="jquery,terminal,interpreter,console,bash,history,authentication,ajax,server,client"/>
    <link rel="shortcut icon" href="favicon.ico"/>
    <link rel="alternate" type="application/rss+xml" title="Notification RSS" href="http://terminal.jcubic.pl/notification.rss"/>
    <link href="http://fonts.googleapis.com/css?family=Droid+Sans+Mono" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" href="css/style.css"/>
    <script src="js/jquery-1.5.min.js"></script>
    <script src="js/code.js"></script>
  </head>
  <body>
    <header id="main"><h1>JQuery Terminal Emulator Plugin</h1>
    <a href="/"><pre id="sig">
      __ _____                     ________                              __
     / // _  /__ __ _____ ___ __ _/__  ___/__ ___ ______ __ __  __ ___  / /
 __ / // // // // // _  // _// // / / // _  // _//     // //  \/ // _ \/ /
/  / // // // // // ___// / / // / / // ___// / / / / // // /\  // // / /__
\___//____ \\___//____//_/ _\_  / /_//____//_/ /_/ /_//_//_/ /_/ \__\_\___/
          \/              /____/                                     0.9.1

</pre><img src="/signature.png"/><!-- for FB bigger then gihub ribbon --></a>
<pre class="separator">---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------</pre>
    </header>
    <nav>
      <ul>
        <li><a href="/#demo">Demo</a></li>
        <li><a href="api_reference.php">API Reference</a></li>
        <li><a href="examples.php">Examples</a></li>
		<li><a href="http://stackoverflow.com/questions/tagged/jquery-terminal">Q&amp;A</a></li>
        <li><a href="/#download">Download</a></li>
        <li><a href="/#comments">Comments</a></li>
        <li><a href="https://gitter.im/jcubic/jquery.terminal">Chat</a></li>
      </ul>
    </nav>
    <a href="https://github.com/jcubic/jquery.terminal" style="position: fixed; top: 0; left: 0; z-index:1000"><img style="border: 0;" src="https://s3.amazonaws.com/github/ribbons/forkme_left_darkblue_121621.png" alt="Fork JQuery Terminal Emulator on GitHub"></a>
    <section>
      <header id="api"><h1>API Reference</h1></header>
      <article id="interpreter">
        <header><h2>Interpreter</h2></header>
        <p>To create terminal you must pass interpreter function (as first argument) which will be called when you type enter. <strong>Function has two argumentss</strong> command that user type in terminal and terminal instance. Optionally you can pass string as first argument, in this case interpreter function will be created for you using passed string as <strong><abbr title="Uniform Resource Identifier">URI</abbr></strong> (path to file) of <strong>JSON-RPC</strong> service (it's ajax so must be on the same server).</p>
        <pre class="javascript">
$('#some_id').terminal(function(command, term) {
    if (command == 'test') {
        term.echo("you just typed 'test'");
    } else {
        term.echo('unknown command');
    }
}, { prompt: '>', name: 'test' });
        </pre>
        <p>You can pass object as first argument - the methods will be invoked by commands typed by a user. In those methods <strong>this</strong> will point to terminal object.</p>
        <pre class="javascript">
$('#some_id').terminal({
    echo: function(arg1) {
        this.echo(arg1);
    },
    rpc: 'some_file.php',
    calc: {
        add: function(a, b) {
            this.echo(a+b);
        },
        sub: function(a, b) {
            this.echo(a-b);
        }
    }
}, { prompt: '>', greeting: false });
        </pre>
        <p>This code will create two command <strong>echo</strong> that will print first argument and <strong>add</strong> that will add two integers.</p>
        <p>From version 0.8.0 you can also use array with strings, objects and functions. You can use multiple number of objects and strings and one function (that will be called last if no other commands found). If you have ignoreSystemDescribe function enabled you will be able to use only one string (JSON-RPC url). If you have <a href="#completion">completion</a> enabled then your commands will be that from objects and JSON-RPC that have system.describe</p>
        <pre class="javascript">
$('#some_id').terminal(["rpc.php", {
    "mysql": function() {
        this.push(function(command, term) {
            $.jrpc("rpc.php", 'mysql', [command], function(json) {
                term.echo(json.result);
            });
        }, {
            prompt: 'mysql> '
        });
    }
}], { prompt: '>', greeting: false });
        </pre>
        <p>In previous example mysql will be exception, even that rpc have that method it will not call it but create new interpreter.</p>
        <p>Terminal will always process numbers if processArguments is set to true (by default).</p>
      </article>
      <article id="options">
        <header><h2>Options</h2></header>
        <p>This is list of options (for second argument):</p>
        <ul>
          <li id="history"><strong>history [bool]</strong> &mdash; if false will not store your commands</li>
          <li id="prompt"><strong>prompt [string|function]</strong> &mdash; default is &ldquo;&gt;&rdquo; you can set it to string or function with one parameter which is callback that must be called with string for your prompt (you can use ajax call to get prompt from the server). You can use the same formatting as in <a href="#echo">echo</a>.</li>
          <li id="name"><strong>name [string]</strong> &mdash; name is used if you want to distinguish two or more terminals on one page or on one server. (if name them differently they will have different history and authentication)</li>
          <li id="greetings"><strong>greetings [string|function(callback)]</strong> &mdash; default is set to JQuery Terminal Singnature. You can set it to string or function (like prompt) with callback argument which must be called with your string.</li>
          <li id="processarguments"><strong>processArguments [bool | function]</strong> &mdash; if set to true it will process arguments when using an object (replace regex with real regex object number with numbers and process escape characters in double quoted strings - like \x1b \033 will be Escape for ANSI codes) - default true. If you pass function you can parse command line by yourself - it have one argument with string without name of the function and you need to return an array.</li>
		  <li id="outputlimit"><strong>outputLimit [number]</strong> &mdash; if non negative it will limit the printing lines on terminal. If set to 0 it will print only lines that fit on one page (it will not create scrollbar if it's enabled). Default -1 which disable the function.</li>
		  <li id="linksnoreferer"><strong>linksNoReferer [bool]</strong> &mdash; if set to true it will add rel="noreferer" to all links crated by terminal (default false).</li>
          <li id="exit"><strong>exit [bool]</strong> &mdash; if this option is set to false it don't use CTRL+D to exit from terminal and don't include &ldquo;exit&rdquo; command. default is true</li>
          <li id="clear"><strong>clear [bool]</strong> &mdash; if this option is set to false it don't include &ldquo;clear&rdquo; command. default is true</li>
          <li id="login"><strong>login [function|string]</strong> &mdash; login can be function, string or true. Function must have 3 arguments login password and callback which must be called with token (if login and password match) or false (if authentication fail). If interpreter is string with valid URI JSON-RPC service you can set login option to true (it will use login remote method) or name of RPC method. <strong>this</strong> in login function is terminal object.
            <pre class="javascript">
function(user, password, callback) {
    if (user == 'demo' && password == 'secret') {
        callback('SECRET TOKEN');
    } else {
        callback(null);
    }
}
            </pre>
But you need to know that everybody can look at your javascript source code so it's better to call server using AJAX here and call callback on responce. If callback receive not null value, you can get that value using <a href="#token">token method</a> so you can pass when calling the server (and server then can identify that token)
          </li>
          <li id="tabcompletion"><strike><strong>tabcompletion [bool]</strong> &mdash; enable tab completion when you pass object as first argument. Default is false (tabulation key default insert tabulation character).</strike> removed in version 0.8.0</li>
          <li id="completion"><strong>completion [function (terminal, string, callback)|array|boolean]</strong> &mdash; function with a callback that need to be executed with list of commands for tab completion (you need to pass array of commands to callback function), from version 0.8.0 you can also use true (it will act as <a href="#tabcompletion">tabcompletion</a> option for objects and RPC as interpreter) or array if you know what your commands are and don't need to call ajax to get them.</li>
          <li id="greetings"><strong>greetings</strong> &mdash; Display your greetings. You can put it in onClear so you will always have it in terminal.</li>
          <li id="enabled"><strong>enabled [bool]</strong> &mdash; default is true, if you want disable terminal you can set it to false. This is usefull if you want to hide terminal and enable on some action (If Terminal is enabled it intercept keyboard).</li>
		  <li id="checkarity"><strong>checkArity [bool]</strong> &mdash; if set to true (by default) it will check number of arguments in functions and in JSON-RPC if service return system.describe (only 1.1 draft say that it must return in new Spec 2.0 don't say anything about it, json-rpc used by examples return system.describe).</li>
          <li id="onInit"><strong>onInit [function(terminal)]</strong> &mdash; callback function called after initialization (if there is login function it will be called after authentication).</li>
          <li id="onRPCError"><strong>onRPCError [function(terminal)]</strong> &mdash; callback function that will be called instead of built in RPC error.</li>
          <li id="onExit"><strong>onExit [function(terminal)]</strong> &mdash; callback function called when you logout</li>
          <li id="onClear"><strong>onClear [function(terminal)]</strong> &mdash; callback function called when clear command is executed.</li>
          <li id="onBlur"><strong>onBlur [function(terminal)]</strong> &mdash; callback function called when terminal get out of focus. If you return false in this callback function the terminal will not get out of focus.</li>
          <li id="onResize"><strong>onResize [function(terminal)]</strong> &mdash; callback function called when terminal get resized.</li>
          <li id="onFocus"><strong>onFocus [function(terminal)]</strong> &mdash; callback function called when terminal get focus.</li>
          <li id="onTerminalChange"><strong>onTerminalChange [function(terminal)]</strong> &mdash; callback function called when you switch to next terminal.</li>
          <li id="onBeforeLogin"><strong>onBeforeLogin [function(terminal)]</strong> &mdash; callback function called called before login.</li>
          <li id="processRPCResponse"><strong>processRPCResponse [function(object)]</strong> &mdash; callback function that will be use with any result returned by JSON-RPC. So you can create better handler.</li>
          <li id="onCommandChange"><strong>onCommandChange [function(command, terminal)]</strong> &mdash; event fired when command line is changed.</li>
          <li id="exceptionHandler"><strong>exceptionHandler [function(exception)]</strong> &mdash; callback that will be executed instead of default print exception on terminal</li>
          <li id="historyFilter"><strong>historyFilter [function(command)]</strong> &mdash; if you return false in this function command will not be added into history</li>
          <li id="ignoreSystemDescribe"><strong>ignoreSystemDescribe [boolean]</strong> &mdash; if used it will not call system.describe metod for JSON-RPC (it was in version 1.1 of JSON-RPC which was a draft, but it's supported by JSON-RPC implementetion used in demos)</li>
          <li id="historySize"><strong>historySize [number]</strong> &mdash; size of the history (default 60) if you pass falsy value it will be not restricted.</li>
          <li id="keypress"><strong>keypress [function(event, terminal)]</strong> &mdash; function called on keypress event if you return false it will not execute default actions (keypress event is called when you type printable characters and PAGE UP, PAGE DOWN and CTRL+D).</li>
          <li id="keydown"><strong>keydown [function(event, terminal)]</strong> &mdash; function called on keydown event if you return false it will not execute default actions (keydown event is use for the rest of shortcuts).</li>
        </ul>
      </article>
      <article>
        <header><h2>Terminal object</h2></header>
        <p>You will have access to terminal object in <strong>this</strong> object when you put object as first argument. In second argument if you put a function. That object is also returned by the plugin itself. The terminal is created only once so you can call that plugin multiple times. The terminal object is jQuery object extended by methods listed below.</p>
      </article>
      <article id="instance_methods">
        <header><h2>Instance Methods</h2></header>
        <p>This is list of available methods (you can also use jQuery methods):</p>
        <ul>
          <li id="clear"><strong>clear()</strong> &mdash; clear terminal</li>
          <li id="pause_resume"><strong>pause()/resume()</strong> &mdash; if your command will take some time to compute (like in AJAX call) you can pause terminal (terminal will be disable and command line will be hidden) and resume it in AJAX response is called.</li>
          <li id="paused"><strong>paused()</strong> &mdash; return if terminal is paused.</li>
          <li id="echo"><strong>echo([string|function], [options])</strong> &mdash; display string on terminal &mdash; (additionally if you can call this function with a function as argument it will call that function and print the result, this function will be called every time you resize the terminal or browser). There are three options <strong>raw</strong> &mdash; it will allow to display raw html, <strong>finalize</strong> &mdash; which is callback function with one argument the div container and <strong>flush</strong> &mdash; default is true, if it's false it will not print echo text to terminal until you call <strong><a href="#flush">flush</a></strong> method. You can also use basic text formating using syntax as folow: <strong>[[guib;&lt;COLOR&gt;;&lt;BACKGROUND&gt;]some text]</strong> will display <span style="color:#000;background-color:#00ee11;text-decoration:underline;font-style:italic;font-weight:bold">some text</span>:
            <ul>
              <li><strong>[[</strong> &mdash; open formating</li>
              <li><strong>u</strong> &mdash; underline</li>
              <li><strong>s</strong> &mdash; strike</li>
              <li><strong>o</strong> &mdash; overline</li>
              <li><strong>i</strong> &mdash; italic</li>
              <li><strong>b</strong> &mdash; bold</li>
              <li><strong>g</strong> &mdash; glow (using css text-shadow)</li>
              <li><strong>;</strong> &mdash; separator</li>
              <li><strong>color</strong> &mdash; color of text (hex, short hex or html name of the color)</li>
              <li><strong>;</strong> &mdash; separator</li>
              <li><strong>color</strong> &mdash; background color (hex, short hex or html name of the color)</li>
              <li><strong>;</strong> &mdash; separator [optional]</li>
              <li><strong>class</strong> &mdash; class adeed to format span element [optional]</li>
              <li><strong>]</strong> &mdash; end of format specification</li>
              <li><strong>text</strong> &mdash; text that will be formated (most of the time for internal use, when you format text that's wrap in more then one line you'll get full text in data-text attribute)</li>
              <li><strong>]</strong> &mdash; end of formating</li>
            </ul>
            <p>From version 0.4.19 terminal support <a href="https://en.wikipedia.org/wiki/ANSI_escape_code">ANSI formatting</a> like \x1b[1;31mhello[0m will produce red color hello. Here is <a href="http://ascii-table.com/ansi-escape-sequences.php">shorter description of ansi escape codes</a>.</p>
            <p>From version 0.7.3 it also support Xterm 8bit (256) colors (you can test using this <a href="https://www.gnu.org/graphics/agnuheadterm-xterm.txt">GNU Head</a>) and formatting output from <strong>man</strong> command (overtyping).</p>
            <p>From version 0.8.0 it support html colors like blue, navy or red</p>
          </li>
          <li id="error"><strong>error([string|function])</strong> &mdash; it display string in in red.</li>
          <li id="exception"><strong>exception(Error, [Label])</strong> &mdash; display exception with stack trace on terminal (second paramter is optional is used by terminal to show who throw the exception)</li>
		  <li id="level"><strong>level()</strong> &mdash; return how deeply nested in interpreters you correctly in.</li>
          <li id="login"><strong>login([function, boolean])</strong> &mdash; execute login function the same as login option but first argument need to be a function. The function will be called with 3 arguments, user, password and a function that need to be called with truthy value that will be stored as token. Each interpreter can have it's own login function (you will need call <Strong><a href="#">push</a></strong> function and then login. The token will be stored localy, you can get it passing true to token function.</li>
          <li id="exec"><strong>exec([string, bool])</strong> &mdash; Execute command that like you where type it into terminal (it will execute user defined function). Second argument is optional if set to true, it will not display prompt and command that you execute. If you want to have proper timing of executed function when commands are asynchronous (use ajax) then you need to call pause and resume (make sure that you call <strong>pause</strong> before ajax call and <strong>resume</strong> as last in ajax response).</li>
          <li id="scroll"><strong>scroll([number])</strong> &mdash; you can use this method to scroll manually terminal (you can pass positive or negative value).</li>
          <li id="logout"><strong>logout()</strong> &mdash; if you use authentication if will logout from terminal (it will clear cookies if cookie option is true). If you don't set login option this function will throw exception.</li>
		  <li id="flush"><strong>flush()</strong> &mdash; if you echo using <code>flush: false</code> (it will not display text immediately) then you can send that text to the terminal output using this function</li>
          <li id="token"><strong>token([boolean])</strong> &mdash; return token which was set in authentication process or by calling login function. This is set to null if there is no login option. If you pass true as an argument you will have local token for the interpreter (created using <a href="#push">push</a> function) it will return null if that interpreter don't have token.</li>
          <li id="login_name"><strong>login_name()</strong> &mdash; return login name which was use in authentication. This is set to null if there is no login option.</li>
          <li id="set_prompt"><strong>set_prompt([string|function])</strong> &mdash; change the prompt.</li>
          <li id="next"><strong>next()</strong> &mdash; if you have more then one terminal instance it will switch to next terminal (in order of creation) and return reference to that terminal.</li>
          <li id="cols_rows"><strong>cols()/rows()</strong> &mdash; returns number of characters and number of lines of the terminal.</li>
          <li id="history"><strong>history()</strong> &mdash; return command line History object (need documentation - for now you can check the source code)</li>
          <li id="name"><strong>name()</strong> &mdash; return name of terminal</li>
          <li id="push"><strong>push([string|function], {object})</strong> &mdash; push next interpreter on the stack and call that interpreter. First argument is new interpreter (<strong>the same</strong> as first argument to <strong>terminal</strong>). The second argument is a list of options as folow:
            <ul>
              <li><strong>name</strong> &mdash; to distinguish interpreters using command line history.</li>
              <li><strong>prompt</strong> &mdash; new prompt for this terminal.</li>
              <li><strong>onExit</strong> &mdash; callback function called on Exit</li>
              <li><strong>onStart</strong> &mdash; callback function called on Start</li>
              <li><strong>keydown</strong> &mdash; interpreter keydown event</li>
              <li><strike><strong>historyFilter</strong> &mdash; the same as in terminal</strike> in next version.</li>
              <li><strong>completion</strong> &mdash; the same as in terminal</li>
              <li><strong>login</strong> &mdash; same as <a href="#login">login</a> main option</li>
            </ul>
            <p>Additionally everything that is passed as within the object will be stored with interpreter on the stack &mdash; so it can be <strong>pop</strong> later. See also <a href="http://terminal.jcubic.pl/examples.php#multiple_interpreters">Multiple intepreters example</a></p>
          </li>
          <li id="pop"><strong>pop()</strong> &mdash; remove current interpreter from the stack and run previous one.</li>
          <li id="focus"><strong>focus([bool])</strong> &mdash; it will activate next terminal if argument is false or disable previous terminal and activate current one. You you have only one terminal instance it act the same as disable/enable.</li>
          <li id="enable_disable"><strong>enable()/disable()</strong> &mdash; as names says it enable or disable terminal.</li>
		  <li id="destroy"><strong>destroy()</strong> &mdash; remove everything created by terminal. It will not touch local storage, if you want to remove it as weel use purge.</li>
		  <li id="purge"><strong>purge()</strong> &mdash; remove all local storage left by terminal. It will act like logout because it will remove login and token from local storage but you will not be logout until you refresh the page.</li>
          <li id="resize"><strong>resize([number, number]</strong> &mdash; change size of terminal if is called with two arguments (width,height) it will resize using this values. If is called without arguments it will act like refreash and use current size of element (you can use this if you set size in some other way).</li>
          <li id="signature"><strong>signature()</strong> &mdash; return JQuery Singature depending on size of terminal</li>
          <li id="get_command"><strong>get_command()</strong> &mdash; return current command</li>
          <li id="insert"><strong>insert(string)</strong> &mdash; insert text in cursor position</li>
          <li id="export_view"><strong>export_view()</strong> &mdash; return object that can be use to restore the view using <a href="#import_view">import_view</a>.</li>
          <li id="import_view"><strong>import_view([view])</strong> &mdash; restore the view of the terminal using object returned prevoiusly by <a href="#export_view">export_view</a>.</li>
          <li id="set_prompt"><strong>set_prompt([string|function])</strong> &mdash; set prompt.</li>
          <li id="set_command"><strong>set_command(string)</strong> &mdash; set command using string.</li>
          <li id="set_mask"><strong>set_mask([bool])</strong> &mdash; toogle mask of command line.</li>
          <li id="get_output"><strong>get_output()</strong> &mdash; return string contains whatever was print on terminal</li>
        </ul>
      </article>
      <article id="terminal_utilites">
        <header><h2>Terminal Utilites</h2></header>
        <p>Object <strong><abbr title="jQuery">$</abbr>.terminal</strong> contain bunch of utilities use by terminal, but they can also be used by user code.</p>
        <ul>
          <li id="split_equal"><strong>split_equal([string], [number])</strong> &mdash; return array. It split text into equal length lines and keep terminal formatting in place for displaying each line separately.</li>
          <li id="encode"><strong>encode([string])</strong> &mdash; encode &amp;, new line, space, tabs, &lt; and &gt; with entities.</li>
          <li id="format"><strong>format([string]</strong> &mdash; create html &lt;span&gt; elements from terminal formattings. It also convert urls and email to links (a tags).</li>
          <li id="format_split"><strong>format_split([string])</strong> &mdash; return array of formatting and text between them</li>
          <li id="escape_brackets"><strong>escape_brackets([string])</strong> &mdash; replace [ and ] with number entities.</li>
          <li id="escape_regex"><strong>escape_regex([string])</strong> &mdash; covert string that can be use in regex (RegExp constructor) literally.</li>
          <li id="have_formatting"><strong>have_formatting([string])</strong> &mdash; test of string have terminal formatting inside.</li>
          <li id="is_formatting"><strong>is_formatting([string])</strong> &mdash; test it string is full formatting (contain only one formatted text and nothing else).</li>
          <li id="strip"><strong>strip([string])</strong> &mdash; remove formatting from text.</li>
          <li id="active"><strong>active()</strong> &mdash; return selected terminal.</li>
          <li id="ansi_colors"><strong>ansi_colors</strong> &mdash; object contain 4 objects normal, fainted, bold and pallete (8bit colors) that contains hex colors for ansi formatting (taken from linux terminal emulator).</li>
		  <li id="overtyping"><strong>overtyping([string])</strong> &mdash; convert string containing formatting from <strong>man</strong> command (<i>overtyping</i>) to terminal formatting. If used with format it will produce html from <strong>man</strong>.</li>
          <li id="from_ansi"><strong>from_ansi([string])</strong> &mdash; convert ANSI encoding to terminal encoding. If used with format it will produce html from ANSI encoding.</li>
          <li id="parseArguments"><strong>parseArguments([string])</strong> &mdash; return array from command line string. It process number (integer and floats) and regexes, it also convert escaped \x \0 to real characters when inside double quote. It remove enclosing quotes from strings.</li>
          <li id="splitArguments"><strong>splitArguments([string])</strong> &mdash; similar to <strong>parseArguments</strong> but convert only escape space to space and remove enclosing quotes from strings.</li>
          <li id="parseCommand"><strong>parseCommand([string])</strong> &mdash; return object with keys: <strong>name</strong>, <strong>args</strong> and <strong>rest</strong> that contain name of the command, it's arguments and string without command name. It use <strong>parseArguments</strong> function.</li>
          <li id="splitCommand"><strong>splitCommand([string])</strong> &mdash; similar to <strong>parseCommand</strong> but use <strong>splitArguments</strong>.</li>
          <li id="ansi_colors"><strong>object</strong> &mdash; property that have all colors used in processing ANSI escapes, check the source code for details.</li>
          <li id="defaults"><strong>defaults</strong> &mdash; contain all default options used by terminal plugin. All strings are in <strong>defaults.strings</strong> and can be translated.</li>
          <li id="test"><strong>test()</strong> &mdash; create terminal and run test on terminal utilites. It display result in that terminal.</li>
		</ul>
      </article>
      <article>
        <header id="cmd"><h2>Command Line</h2></header>
        <p>Command Line is created as separate plugin, so you can create instance of it (if you don't want whole terminal)</p>
        <pre class="javascript">
$('#some_id').cmd({
    prompt: '$&gt;',
    width: '100%',
    commands: function(command) {
        //process user commands
    }
});</pre>
        <p>Command Line options: name, keypress, keydown, mask, enabled, width, prompt, commands</p>
      </article>
      <article>
        <header><h2>Command Line Methods</h2></header>
        <p>This is a list of methods if you are what to use only command line.</p>
        <ul>
          <li><strong>name([string])</strong> &mdash; if you pass string it will set name of the command line (name is use for tracking command line histor) or if you call without argument it will return name</li>
          <li><strong>history()</strong> &mdash; returns instance of history object</li>
          <li><strong>set(string, [bool])</strong> &mdash; set command line (optional parameter is is set to true will not change cursor position)</li>
          <li><strong>insert(string, [bool])</strong> &mdash; insert string to command line in place of the cursor if second argument is set to true it will not change position of the cursor</li>
          <li><strong>get()</strong> &mdash; return current command</li>
          <li><strong>commands([function])</strong> &mdash; set or get function that will be called when user hit enter</li>
          <li><strong>destroy()</strong> &mdash; remove plugin</li>
          <li><strong>prompt([string|function])</strong> &mdash; set prompt to function or string &mdash; if called without argument it will return current prompt</li>
          <li><strong>position([number])</strong> &mdash; set or get position of the cursor</li>
          <li><strong>resize([number])</strong> &mdash; set numbers of characters &mdash; if called with number it will set number of character if call without argument it will recalculate the number of characters depending on actual size</li>
          <li><strong>enable/disable/isenabled</strong> &mdash; guess what they do</li>
          <li><strong>mask([bool])</strong> &mdash; if argument is true it will mask all typed characters (with asterisk)</li>
        </ul>
      </article>
      <article>
        <header><h2>Keyboard shortcuts</h2></header>
        <p>This is list of keyboard shortcuts (mostly taken from bash)</p>
        <ul>
          <li><strong>TAB</strong> &mdash; tab completion is available or tab character</li>
          <li><strong>Shift+Enter</strong> &mdash; insert new line</li>
          <li><strong>Up Arrow/CTRL+P</strong> &mdash; show previous command from history</li>
          <li><strong>Down Arrow/CTRL+N</strong> &mdash; show next command from history</li>
          <li><strong>CTRL+R</strong> &mdash; Reverse Search through command line history</li>
          <li><strong>CTRL+G</strong> &mdash; Cancel Reverse Search</li>
          <li><strong>CTRL+L</strong> &mdash; Clear terminal</li>
          <li><strong>CTRL+Y</strong> &mdash; Paste text from kill area</li>
          <li><strong>Delete/backspace</strong> &mdash; remove one character from right/left to the cursor</li>
          <li><strong>Left Arrow/CTRL+B</strong> &mdash; move left</li>
          <li><strong>CTRL+TAB</strong> &mdash; swich to next terminal (use scrolling with animation) &mdash; don't work in Chrome</li>
          <li><strong>Right Arrow/CTRL+F</strong> &mdash; move right</li>
          <li><strong>CTRL+Left Arrow</strong> &mdash; move one word to the left</li>
          <li><strong>CTRL+Right Arrow</strong> &mdash; move one word to the right</li>
          <li><strong>CTRL+A/Home</strong> &mdash; move to beginning of the line</li>
          <li><strong>CTRL+E/End</strong> &mdash; move to end of the line</li>
          <li><strong>CTRL+K</strong> &mdash; remove the text after the cursor and save it in kill area</li>
          <li><strong>CTRL+U</strong> &mdash; remove the text before the cursor and save it in kill area</li>
          <li><strong>CTRL+V/SHIFT+Insert</strong> &mdash; insert text from system clipboard</li>
          <li><strong>CTRL+W</strong> &mdash; remove text to the begining of the work (don't work in Chrome)</li>
          <li><strong>CTRL+H</strong> &mdash; remove text to the end of the line</li>
          <li><strong>ALT+D</strong> &mdash; remove one word after the cursor &mdash; don't work in IE</li>
          <li><strong>PAGE UP</strong> &mdash; scroll up &mdash; don't work in Chrome</li>
          <li><strong>PAGE DOWN</strong> &mdash; stroll down &mdash; don't work in Chrome</li>
          <li><strong>CTRL+D</strong> &mdash; run previous interpreter from the stack or call logout (if terminal is using authentication and current interpreter is the first one). It also cancel all ajax call, if terminal is paused, and resume it.</li>
        </ul>
      </article>
      <article>
        <header><h2>Additional terminal controls</h2></header>
        <p>All interpreters have attached <strong>mousewheel</strong> event so you can stroll them using mouse. To swich between terminals you can just <strong>click on terminal</strong> that you want to <strong>activate</strong> (you can also use <a href="#focus">focus</a> method).</p>
        <p>If you select text using mouse you can paste it using middle mouse button (from version 0.8.0)</p>
      </article>
      <article>
        <header><h2>Changing Colors</h2></header>
        <p>To change color of terminal simply modify "jquery.terminal.css" file it's really short and not complicated, but you should set inverted class background-color to be the same as color of text.</p>
        <p>To change color of one line you can call css jquery method in finalize function passed to echo function.</p>
        <pre class="javascript">terminal.echo("hello blue", {
    finalize: function(div) {
        div.css("color", "blue");
    }
});</pre>
        <p>You can also use <a href="#echo">formating using echo</a> function</p>
      </article>
      <article>
        <header><h2>Error Handling</h2></header>
        <p>All exceptions in user functions (interpreter, prompt, and greetings) are catch ad proper error is displayed on terminal.</p>
      </article>
      <article>
        <header><h2>Style</h2></header>
        <p>From version 0.8.0 blinking cursor is created using CSS3 animations (if available) so you can change that animation anyway you like, just look at <a href="/css/jquery.terminal.css">jquery.terminal.css</a> file. If browser don't support CSS3 animation blinking is created using JavaScript.</p>
      </article>
      <article>
        <header><h2>Authentication</h2></header>
        <p>You can provide your authentication function which will be called when user enter login and password. Function must have 3 arguments first is <strong>user name</strong>, second his <strong>password</strong> and third is <strong>callback function</strong> which must be called with token or null if user enter wrong user and password. (You should call server via AJAX to authenticate the user)</p>
        <p>You can retrieve token from terminal using token method on terminal instance. You can pass this token to functions on the server as first parameter and check if it valid token.</p>
        <p>If you set interpreter to string (it will use this string as URI for JSON-RPC service) you can set login function to string (to call custom method on service passed as interpreter) or true (it will call login method).</p>
        <p>If you set URI of JSON-RPC service and login to true or string, it will always pass token as first argument to every JSON-RPC method.</p>
      </article>
      <article>
        <header id="3rd"><h2>Thrid party code and additional plugis</h2></header>
        <p>Terminal include this 3rd party libraries:</p>
        <ul>
          <li>Storage plugin by Dave Schindler</li>
          <li><a href="http://jquery.offput.ca/timers/">jQuery Timers</a></li>
          <li>Cross-Browser Split 1.1.1 by Steven Levithan</li>
          <li>jQuery Caret by Gideon Sireling</li>
          <li>sprintf.js by Alexandru Marasteanu</li>
        </ul>
        <p>terminal also define 3 helper functions:</p>
        <ul>
          <li>$.jrpc - JSON-RPC helper function</li>
          <li>$.omap - version of map that handle objects</li>
          <li>$.json_stringify - terminal own JSON stringify, because prototype library used by biwascheme messed up JSON.stringify</li>
        </ul>
      </article>
    </section>
    <footer>
      <p id="copy">Copyright (c) 2010-<?php  echo date('Y'); ?> <a title="Projektownie stron i aplikacji internetowych" href="http://jcubic.pl/jakub-jankiewicz">Jakub Jankiewicz</a><span style="display:none"><a href="https://plus.google.com/104010221373218601154?rel=author">g+</a></span></p>
    </footer>
    <script>
jQuery(function($, undefined) {
    $('pre.javascript').syntax("javascript");

});
    </script>
    <? if ($_SERVER["HTTP_HOST"] != "localhost" && !isset($_GET['track'])): ?>
    <!-- Piwik -->
    <script type="text/javascript">
      var _paq = _paq || [];
      _paq.push(['trackPageView']);
      _paq.push(['enableLinkTracking']);
      (function() {
        var u=(("https:" == document.location.protocol) ? "https" : "http") + "://piwik.jcubic.pl/";
        _paq.push(['setTrackerUrl', u+'piwik.php']);
        _paq.push(['setSiteId', 1]);
        var d=document, g=d.createElement('script'), s=d.getElementsByTagName('script')[0]; g.type='text/javascript';
        g.defer=true; g.async=true; g.src=u+'piwik.js'; s.parentNode.insertBefore(g,s);
      })();

    </script>
    <noscript><p><img src="http://piwik.jcubic.pl/piwik.php?idsite=1" style="border:0;" alt="" /></p></noscript>
    <!-- End Piwik Code -->
    <? endif; ?>
  </body>
</html>