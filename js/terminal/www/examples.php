<?php // -*- mode: nxml -*-
header("X-Powered-By: ");
?>
<!DOCTYPE HTML>
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <meta charset="utf-8" />
    <title>Examples for JQuery Terminal Emulator Plugin</title>
    <link rel="canonical" href="http://terminal.jcubic.pl/examples.php"/>
    <meta name="author" content="Jakub Jankiewicz - jcubic&#64;onet.pl"/>
    <meta name="Description" content="This is a bunch of usefull things that you can do with jQuery Terminal Emulator plugin. Live demos and source code likewise."/>
    <meta name="keywords" content="jquery,terminal,interpreter,console,bash,history,authentication,ajax,server,client"/>
    <link rel="shortcut icon" href="favicon.ico"/>
    <link rel="alternate" type="application/rss+xml" title="Notification RSS" href="http://terminal.jcubic.pl/notification.rss"/>
    <link href="http://fonts.googleapis.com/css?family=Droid+Sans+Mono" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" href="css/style.css"/>
    <script src="js/jquery-1.5.min.js"></script>
    <!-- biwascheme use prototype -->
    <script>jQuery.noConflict();</script>
    <!-- Terminal Files -->
    <script src="js/jquery.mousewheel-min.js"></script>
    <script src="js/jquery.terminal-min.js"></script>
    <link href="css/jquery.terminal.css" rel="stylesheet"/>
    <!-- Other files -->
    <link href="css/jquery-ui-1.8.7.custom.css" rel="stylesheet"/>
    <script src="js/jquery-ui-1.8.7.custom.min.js"></script>
    <script src="js/biwascheme.min.js"></script>
    <script src="js/biwascheme.func.js"></script>
    <script src="js/dterm.js"></script>
    <script src="js/code.js"></script>
    <script src="js/jqbiwa.js"></script>
    <script src="js/star_wars.js"></script>
    <!--[if IE]>
    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
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
      <article>
        <header id="examples"><h1>Examples</h1></header>
        <ul>
          <li><a href="#json_rpc_demo">JSON-RPC with authentication</a></li>
          <li><a href="#tilda">Quake like terminal</a></li>
          <li><a href="#dterm">Terminal in jQuery UI Dialog</a></li>
          <li><a href="#multiple_interpreters">Multiple interpreters</a></li>
          <li><a href="#starwars">Star Wars Animation</a></li>
          <li><a href="#ask">Ask before executing a command</a></li>
          <li><a href="#user-typing">Animation that emulate user typing</a></li>
          <li><a href="#less">Less bash command</a></li>
          <li><a href="#css-cursor">Smooth CSS3 cursor animation</a></li>
          <li><a href="#virtual">Virtual Keyboard with Terminal</a></li>
          <li><a href="#history">History API for commands</a></li>
          <li><a href="#shell">Shell</a></li>
          <li><a href="#c64">Commodore 64</a></li>
          <li><a href="#wild">In the wild</a></li>
        </ul>
      </article>
      <article id="json_rpc_demo">
        <header><h2>JSON-RPC with authentication</h2></header>
        <p>See <a title="JSON-RPC demo" href="rpc-demo.html">demo in action</a>. (If you want to copy code from examples click &ldquo;toogle highlight&rdquo; first)</p>
        <p>Javascript code:</p>
        <pre class="javascript">jQuery(function($) {
    $('#term').terminal("json-rpc-service-demo.php", {
        login: true,
        greetings: "You are authenticated"});
});</pre>
        <p>PHP code (in rpc_demo.php):</p>
        <pre class="php">&lt;?php
require('json_rpc.php');
&nbsp;
class Demo {
  static $login_documentation = "return auth token";
  public function login($user, $passwd) {
    if (strcmp($user, 'demo') == 0 &&
        strcmp($passwd, 'demo') == 0) {
      // If you need to handle more than one user you can
      // create new token and save it in database
      return md5($user . ":" . $passwd);
    } else {
      throw new Exception("Wrong Password");
    }
  }
&nbsp;
  static $ls_documentation = "list directory if token is" .
     " valid";
  public function ls($token, $path) {
    if (strcmp(md5("demo:demo"), $token) == 0) {
      if (preg_match("/\.\./", $path)) {
        throw new Exception("No directory traversal Dude");
      }
      $base = preg_replace("/(.*\/).*/", "$1",
                           $_SERVER["SCRIPT_FILENAME"]);
      $path = $base . ($path[0] != '/' ? "/" : "") . $path;
      $dir = opendir($path);
      while($name = readdir($dir)) {
        $fname = $path."/".$name;
        if (!is_dir($name) && !is_dir($fname)) {
          $list[] = $name;
        }
      }
      closedir($dir);
      return $list;
    } else {
      throw new Exception("Access Denied");
    }
  }
&nbsp;
  static $whoami_documentation = "return user information";
  public function whoami() {
    return array(
        "user-agent" => $_SERVER["HTTP_USER_AGENT"],
        "your ip" => $_SERVER['REMOTE_ADDR'],
        "referer" => $_SERVER["HTTP_REFERER"],
        "request uri" => $_SERVER["REQUEST_URI"]);
  }
}
&nbsp;
handle_json_rpc(new Demo());
?&gt;</pre>
        <p><strong>NOTE:</strong> If you use json_rpc.php file (which handle json-rpc) from the <a href="/#download">package</a> you have always help function which display all methods or documentation strings if you provide them.</p>
        <p>If you want secure login you should generate random token in login JSON-RPC function, and store it in database.<br/>For example: md5(time()). You can also use <a href="http://en.wikipedia.org/wiki/Secure_Sockets_Layer">SSL</a>.</p>
        <p>See <a title="JSON-RPC demo" href="rpc-demo.html">demo in action</a>. login is "demo" and password is "demo". Available command are "ls", "whoami", "help" and "help [rpc-method]"</p>
        <p><strong>Hint:</strong> if you want full access to the shell you can pass all commands (through AJAX/JSON-RPC) to php passthru function or create CGI script that will call the shell (Some hosting services block access to the shell from php but not from cgi script). You can also implement "cd" bash functionality by storing current path in variable and pass that variable with every command send to the server, you can implement dynamic prompt using the same variable.</p>
      </article>
      <article id="tilda">
        <header><h2>Quake like terminal</h2></header>
        <p>See <a href="tilda-demo.html">demo</a>.</p>
        <p>Below is code for small plugin called tilda.</p>
        <pre class="javascript">(function($) {
    $.fn.tilda = function(eval, options) {
        if ($('body').data('tilda')) {
            return $('body').data('tilda').terminal;
        }
        this.addClass('tilda');
        options = options || {};
        eval = eval || function(command, term) {
            term.echo("you don't set eval for tilda");
        };
        var settings = {
            prompt: 'tilda> ',
            name: 'tilda',
            height: 100,
            enabled: false,
            greetings: 'Quake like console',
            keypress: function(e) {
                if (e.which == 96) {
                    return false;
                }
            }
        };
        if (options) {
            $.extend(settings, options);
        }
        this.append('&lt;div class="td"&gt;&lt;/div&gt;');
        var self = this;
        self.terminal = this.find('.td').terminal(eval,
                                               settings);
        var focus = false;
        $(document.documentElement).keypress(function(e) {
            if (e.charCode == 96) {
                self.slideToggle('fast');
                self.terminal.command_line.set('');
                self.terminal.focus(focus = !focus);
            }
        });
        $('body').data('tilda', this);
        this.hide();
        return self;
    };
})(jQuery);</pre>
        <p>See <a href="tilda-demo.html">demo</a>.</p>
      </article>
      <article>
        <header id="dterm"><h2>Terminal in jQuery UI Dialog</h2></header>
        <p>Bellow is small plugin dterm.</p>
        <pre class="javascript">(function($) {
    $.extend_if_has = function(desc, source, array) {
        for (var i=array.length;i--;) {
            if (typeof source[array[i]] != 'undefined') {
                desc[array[i]] = source[array[i]];
            }
        }
        return desc;
    };
    $.fn.dterm = function(eval, options) {
        var op = $.extend_if_has({}, options,
                                   ['greetings', 'prompt',
                                    'history', 'clear',
                                    'exit', 'login',
                                    'name', 'keypress',
                                    'keydown', 'onExit',
                                    'onInit']);
&nbsp;
        var term = this.append('&lt;div/&gt;').
              terminal(eval,op);
        if (!options.title) {
            options.title = 'JQuery Terminal Emulator';
        }
        if (options.logoutOnClose) {
            options.close = function(e, ui) {
                term.logout();
                term.clear();
            };
        } else {
            options.close = function(e, ui) {
                term.focus(false);
            };
        }
        var self = this;
        var dialog = this.dialog($.extend(options, {
            resize: function(e, ui) {
                var c = self.find('.ui-dialog-content');
                term.resize(c.width(), c.height());
            },
            open: function(e, ui) {
                term.focus();
            },
            closeOnEscape: false
        }));
        this.terminal = term;
        return this;
    };
})(jQuery);</pre>
        <p id="biwascheme"><strong>Demo Scheme interpreter inside JQuery UI Dialog.</strong></p>
        <p>Click on button to <button id="open_term">open dialog</button> with scheme interpreter inside UI Dialog.</p>
        <p><strong>Hint:</strong> you can use JQuery from scheme. There is defined $ function and functions for all jquery object methods, they names start with coma and they always return jquery object so you can do chaining.</p>
        <p>Interpreter allow to use <strong>multiline expressions</strong>. When you type not finished S-Expresion it change the prompt with set_prompt, contatenate current command with previous not finished expression and when you close last parentises end press enter it evaluate whole expression.</p>
        <p>If you want to call:</p>
        <pre class="javascript">$("body").css("background-color", "black");</pre>
        <p>use</p>
        <!-- only for syntax highlight -->
        <pre class="javascript">(.css ($ "body") "background-color" "black")</pre>
        <p>To attach event you can use lambda expressions.</p>
        <pre class="javascript">(.click ($ ".terminal") (lambda () (display "click")))</pre>
        <p>this will attach click event to terminal.</p>
        <div id="dialogterm"></div>
      </article>
      <article id="multiple_interpreters">
        <header><h2>Multiple interpreters</h2></header>
        <p>All interpreters are stored on the stack which which you can manipulate with terminal methods pop an push.</p>
        <p>See <a title="JQuery Terminal Emulator Demo" href="multiply-interpreters-demo.html">demo</a>.</p>
        <p>In belowed code there are defied three commands:</p>
        <ul>
          <li>js - which run javascript interpreter</li>
          <li>mysql - which call json-rpc service to execute mysql commands</li>
          <li>test - it display "pong" if you type "ping" </li>
        </ul>
        <pre class="javascript">jQuery(function($) {
  $('html').terminal(function(cmd, term) {
    if (cmd == 'help') {
      term.echo("available commands are mysql, js, test");
    } else if (cmd == 'test'){
      term.push(function(cmd, term) {
        if (command == 'help') {
          term.echo('type "ping" it will display "pong"');
        } else if (cmd == 'ping') {
          term.echo('pong');
        } else {
          term.echo('unknown command "' + cmd + '"');
        }
      }, {
        prompt: 'test&gt; ',
        name: 'test'});
    } else if (command == "js") {
      term.push(function(command, term) {
        var result = window.eval(command);
        if (result != undefined) {
          term.echo(String(result));
        }
      }, {
        name: 'js',
        prompt: 'js&gt; '});
      } else if (command == 'mysql') {
        term.push(function(command, term) {
          term.pause();
          //$.jrpc is helper function which
          //creates json-rpc request
          $.jrpc("mysql-rpc-demo.php",
            "query",
            [command],
            function(data) {
              term.resume();
              if (data.error) {
                term.error(data.error.message);
              } else {
                if (typeof data.result == 'boolean') {
                  term.echo(data.result ?
                            'success' :
                            'fail');
                } else {
                  var len = data.result.length;
                  for(var i=0;i&lt;len; ++i) {
                    term.echo(data.result[i].join(' | '));
                  }
                }
              }
            },
            function(xhr, status, error) {
              term.error('[AJAX] ' + status +
                         ' - Server reponse is: \n' +
                         xhr.responseText);
                         term.resume();
                   }); // rpc call
          }, {
            greetings: "This is example of using mysql"+
              " from terminal\n you are allowed to exe"+
              "cute: select, insert, update and delete"+
              " from/to table:\n   table test(integer_"+
              "value integer, varchar_value varchar(255))",
            prompt: "mysql&gt; "});
          } else {
            term.echo("unknow command " + command);
          }
        }, {
          greetings: "multiply terminals demo use help"+
                " to see available commands"
       });});</pre>
        <p>PHP code for mysql service: </p>
        <pre class="php">&lt;?php
require('json_rpc.php');
&nbsp;
$conn = mysql_connect('localhost', 'user', 'password');
mysql_select_db('database');
&nbsp;
class MysqlDemo {
  public function query($query) {
    if (preg_match("/create|drop/", $query)) {
      throw new Exception("Sorry you are not allowed to ".
                          "execute '" . $query . "'");
    }
    if (!preg_match("/(select.*from *test|insert *into *".
                    "test.*|delete *from *test|update *t".
                    "est)/", $query)) {
      throw new Exception("Sorry you can't execute '" .
                          $query . "' you are only allow".
                          "ed to select, insert, delete ".
                          "or update 'test' table");
    }
    if ($res = mysql_query($query)) {
      if ($res === true) {
        return true;
      }
      if (mysql_num_rows($res) > 0) {
        while ($row = mysql_fetch_row($res)) {
          $result[] = $row;
        }
        return $result;
      } else {
        return array();
      }
    } else {
      throw new Exception("MySQL Error: ".mysql_error());
    }
  }
}
&nbsp;
handle_json_rpc(new MysqlDemo());
?&gt;</pre>
      <p>See <a title="JQuery Terminal Emulator Demo" href="multiply-interpreters-demo.html">demo</a>.</p>
      </article>
      <article id="starwars">
        <header><h2>Star Wars Animation</h2></header>
        <p>This is Star Wars ASCIIMation created by Simon Jansen <br/><a href="http://www.asciimation.co.nz/">http://www.asciimation.co.nz/</a></p>
        <div id="starwarsterm"></div>
        <pre class="javascript">$(function() {
    var frames = [];
    var LINES_PER_FRAME = 14;
    var DELAY = 67;
    //star_wars is array of lines from 'js/star_wars.js'
    var lines = star_wars.length;
    for (var i=0; i&lt;lines; i+=LINES_PER_FRAME) {
        frames.push(star_wars.slice(i, i+LINES_PER_FRAME));
    }
    var stop = false;
    //to show greetings after clearing the terminal
    function greetings(term) {
        term.echo('STAR WARS ASCIIMACTION\n'+
                  'Simon Jansen (C) 1997 - 2008\n'+
                  'www.asciimation.co.nz\n\n'+
                  'type "play" to start animation, '+
                  'press CTRL+D to stop');
    }
    function play(term, delay) {
        var i = 0;
        var next_delay;
        if (delay == undefined) {
            delay = DELAY;
        }
        function display() {
            if (i == frames.length) {
                i = 0;
            }
            term.clear();
            if (frames[i][0].match(/[0-9]+/)) {
                next_delay = frames[i][0] * delay;
            } else {
                next_delay = delay;
            }
            term.echo(frames[i++].slice(1).join('\n')+'\n');
            if (!stop) {
                setTimeout(display, next_delay);
            } else {
                term.clear();
                greetings(term);
                i = 0;
            }
        }
        display();
    }

    $('#starwarsterm').terminal(function(command, term){
        if (command == 'play') {
            term.pause();
            stop = false;
            play(term);
        }
    }, {
        width: 500,
        height: 230,
        prompt: 'starwars> ',
        greetings: null,
        onInit: function(term) {
            greetings(term);
        },
        keypress: function(e, term) {
            if (e.which == 100 &amp;&amp; e.ctrlKey) {
                stop = true;
                term.resume();
                return false;
            }
        }
    });
});</pre>
      </article>
      <article id="ask">
        <header><h2>Ask before executing a command</h2></header>
        <p>Someone ask me how to create, command that ask users before executing, and here is the code, it will keep asking until eather yes or no will be entered (or short y/n).</p>
        <pre class="javascript">$('#term').terminal(function(command, term) {
    if (command == 'foo') {
        term.push(function(command) {
            if (command.match(/y|yes/i)) {
                term.echo('execute your command here');
                term.pop();
            } else if (command.match(/n|no/i)) {
                term.pop();
            }
        }, {
            prompt: 'Are you sure? '
        });
    }
});</pre>
      </article>
      <article id="user-typing">
        <header><h2>Animation that emulate user typing</h2></header>
        <p>Someone else aks if it's posible to create animation like user typing. Here is the code that emulate user typing on initialization of the terminal and before every ajax call, which can finish after animation.</p>
        <pre class="javascript">$(function() {
    var anim = false;
    function typed(finish_typing) {
        return function(term, message, delay, finish) {
            anim = true;
            var prompt = term.get_prompt();
            var c = 0;
            if (message.length > 0) {
                term.set_prompt('');
                var interval = setInterval(function() {
                    term.insert(message[c++]);
                    if (c == message.length) {
                        clearInterval(interval);
                        // execute in next interval
                        setTimeout(function() {
                            // swap command with prompt
                            finish_typing(term, message, prompt);
                            anim = false
                            finish &amp;&amp; finish();
                        }, delay);
                    }
                }, delay);
            }
        };
    }
    var typed_prompt = typed(function(term, message, prompt) {
        // swap command with prompt
        term.set_command('');
        term.set_prompt(message + ' ');
    });
    var typed_message = typed(function(term, message, prompt) {
        term.set_command('');
        term.echo(message)
        term.set_prompt(prompt);
    });

    $('body').terminal(function(cmd, term) {
        var finish = false;
        var msg = "Wait I'm executing ajax call";
        term.set_prompt('> ');
        typed_message(term, msg, 200, function() {
            finish = true;
        });
        var args = {command: cmd};
        $.get('commands.php', args, function(result) {
            (function wait() {
                if (finish) {
                    term.echo(result);
                } else {
                    setTimeout(wait, 500);
                }
            })();
        });
    }, {
        name: 'xxx',
        greetings: null,
        width: 500,
        height: 300,
        onInit: function(term) {
            // first question
            var msg = "Wellcome to my terminal";
            typed_message(term, msg, 200, function() {
                typed_prompt(term, "what's your name:", 100);
            });
        },
        keydown: function(e) {
            //disable keyboard when animating
            if (anim) {
                return false;
            }
        }
    });
});</pre>
      </article>
      <!--
      TODO:
      <article>
        http://labs.funkhausdesign.com/examples/terminal/cmd_controlled_terminal.html
      </article>
      -->
      <article id="less">
        <header><h2>Less bash command</h2></header>
        <p>Here is implementation of bash less command (not all commands implemented)</p>
        <pre class="javascript">var resize = [];
$('&lt;SELECTOR&gt;').terminal(function(command, term) {
  if (command.match(/ *less +[^ ]+/)) {
    term.pause();
    $.ajax({
      // leading and trailing spaces and keep those inside argument
      url: command.replace(/^\s+|\s+$/g, '').
        replace(/^ */, '').split(/(\s+)/).slice(2).join(''),
      method: 'GET',
      dataType: 'text',
      success: function(source) {
        term.resume();
        var export_data = term.export_view();
        var less = true;
        source = source.replace(/&/g, '&amp;amp;').
          replace(/\[/g, '&amp;#91;').
          replace(/\]/g, '&amp;#93;');
        var cols = term.cols();
        var rows = term.rows();
        resize = [];
        var lines = source.split('\n');
        resize.push(function() {
          if (less) {
            cols = term.cols();
            rows = term.rows();
            print();
          }
        });
        var pos = 0;
        function print() {
          term.clear();
          term.echo(lines.slice(pos, pos+rows-1).join('\n'));
        }
        print();
        term.push($.noop, {
          keydown: function(e) {
            if (term.get_prompt() !== '/') {
              if (e.which == 191) {
                term.set_prompt('/');
              } else if (e.which === 38) { //up
                if (pos > 0) {
                  --pos;
                  print();
                }
              } else if (e.which === 40) { //down
                if (pos &lt; lines.length-1) {
                  ++pos;
                  print();
                }
              } else if (e.which === 34) { // Page up
                pos += rows;
                if (pos > lines.length-1-rows) {
                  pos = lines.length-1-rows;
                }
                print();
              } else if (e.which === 33) { // page down
                pos -= rows;
                if (pos &lt; 0) {
                  pos = 0;
                }
                print();
              } else if (e.which == 81) { //Q
                less = false;
                term.pop().import_view(export_data);
              }
              return false;
            } else {
              if (e.which === 8 &amp;&amp; term.get_command() === '') {
                term.set_prompt(':');
              } else if (e.which == 13) {
                var command = term.get_command();
                // basic search find only first
                // instance and don't mark the result
                if (command.length &gt; 0) {
                  var regex = new RegExp(command);
                  for (var i=0; i&lt;lines.length; ++i) {
                    if (regex.test(lines[i])) {
                      pos = i;
                      print();
                      term.set_command('');
                      break;
                    }
                  }
                  term.set_command('');
                  term.set_prompt(':');
                }
                return false;
              }
            }
          },
          prompt: ':'
        });
      }
    });
  }
}, {
  onResize: function(term) {
    for (var i=resize.length;i--;) {
      resize[i](term);
    }
  }
});</pre>
      </article>
      <style type="text/css">
        @keyframes blink {
          0% { opacity: 1; }
          25% { opacity: 0; }
          50% { opacity: 0; }
          100% { opacity: 1; }
        }
        @-webkit-keyframes blink {
          0% { opacity: 1; }
          25% { opacity: 0; }
          50% { opacity: 0; }
          100% { opacity: 1; }
        }
        @-ms-keyframes blink {
          0% { opacity: 1; }
          25% { opacity: 0; }
          50% { opacity: 0; }
          100% { opacity: 1; }
        }
        @-moz-keyframes blink {
          0% { opacity: 1; }
          25% { opacity: 0; }
          50% { opacity: 0; }
          100% { opacity: 1; }
        }
        #css-cursor .prompt, #css-cursor .command {
          color: #0c0;
          text-shadow: 0 0 3px rgba(0,100,0,50);
        }
        #css-cursor .cursor {
          background: #0c0;
          animation: blink 1s linear infinite;
          -webkit-animation: blink 1s infinite linear;
          -ms-animation: blink 1s infinite linear;
          -moz-animation: blink 1s infinite linear;
          -webkit-box-shadow: 0 0 5px rgba(0,100,0,50);
          -moz-box-shadow: 0 0 5px rgba(0,100,0,50);
          -ms-box-shadow: 0 0 5px rgba(0,100,0,50);
          -o-box-shadow: 0 0 5px rgba(0,100,0,50);
          box-shadow: 0 0 5px rgba(0,100,0,50);
        }
      </style>
      <article id="css-cursor">
        <header><h2>Smooth CSS3 cursor animation</h2></header>
        <p>From version 0.8 terminal use CSS animation for blinking so you can change it without touching JavaScript code.</p>
        <p>Here is different looking cursor blinking animation that can be use with terminal.</p>
        <div class="terminal">
            <span class="prompt">repl&gt;&nbsp;</span><span class="cursor">&nbsp;</span>
        </div>
        <div class="wrapper"><pre class="css">@keyframes blink {
  0% { opacity: 1; }
  25% { opacity: 0; }
  50% { opacity: 0; }
  100% { opacity: 1; }
}
@-webkit-keyframes blink {
  0% { opacity: 1; }
  25% { opacity: 0; }
  50% { opacity: 0; }
  100% { opacity: 1; }
}
@-ms-keyframes blink {
  0% { opacity: 1; }
  25% { opacity: 0; }
  50% { opacity: 0; }
  100% { opacity: 1; }
}
@-moz-keyframes blink {
  0% { opacity: 1; }
  25% { opacity: 0; }
  50% { opacity: 0; }
  100% { opacity: 1; }
}
.prompt, .command {
  color: #0c0;
  text-shadow: 0 0 3px rgba(0,100,0,50);
}
.cursor {
  background: #0c0;
  animation: blink 1s linear infinite;
  -webkit-animation: blink 1s infinite linear;
  -ms-animation: blink 1s infinite linear;
  -moz-animation: blink 1s infinite linear;
  -webkit-box-shadow: 0 0 5px rgba(0,100,0,50);
  -moz-box-shadow: 0 0 5px rgba(0,100,0,50);
  -ms-box-shadow: 0 0 5px rgba(0,100,0,50);
  -o-box-shadow: 0 0 5px rgba(0,100,0,50);
  box-shadow: 0 0 5px rgba(0,100,0,50);
}</pre></div>
      </article>
      <article id="virtual">
        <header><h2>Using Virtual Keyboard with Terminal</h2></header>
        <p>There are problems with terminal on touch devices. I've found a project <a href="https://github.com/Mottie/Keyboard">Keyboard</a> that create virtual keyboard using jQuery UI. I've created a demo of working terminal with keyboard. The code still need tweeks to work full screen.</p>
        <p>See <a href="/virtualKeyboard.html">demo</a></p>
      </article>
      <article id="history">
        <header><h2>Using History API for commands</h2></header>
        <p>As a response for this <a href="https://github.com/jcubic/jquery.terminal/issues/148">issue on github</a> I came up with a way to keep every command response in history using HTML5 History API, so you can click back and forward buttons and it will show you previous and next commands.</p>
        <pre class="javascript">$(function() {
    var save_state = [];
    var terminal = $('#term').terminal(function(command, term) {
        var cmd = $.terminal.splitCommand(command);
        var url;
        if (cmd.name == 'open') {
            term.pause();
            // open html and display it on terminal as it is
            url = cmd.args[0];
            $.get(url, function(result) {
                term.echo(result, {raw:true}).resume();
                save_state.push(term.export_view());
                history.pushState(save_state.length-1, null, url);
            }, 'text');
        } else {
            // store all other commands
            save_state.push(term.export_view());
            url = '/' + cmd.name + '/' + cmd.args.join('/');
            history.pushState(save_state.length-1, null, url);
        }
    });
    save_state.push(terminal.export_view()); // save initial state
    $(window).on('popstate', function(e) {
        if (save_state.length) {
            terminal.import_view(save_state[history.state || 0]);
        }
    });
});</pre>
        <p>Each command after it finish need to call this:
        <pre class="javascript">save_state.push(term.export_view());
history.pushState(save_state.length-1, null, '&lt;NEW URL&gt;');</pre>
        <p>So it keep current view of the terminal (after the command finishes) in <code>save_state</code> array and index in push state (I've try to put whole view in <code>history.state</code> but it didn't work). On back/forward buttons click it will get that value from array and restore the view of the terminal.</p>
        <p>Version 0.9.0 may introduce API for that as I mention in a comment for that issue.</p>
      </article>
      <article id="shell">
        <header><h2>Shell</h2></header>
        <p>You can also check my project <a href="http://leash.jcubic.pl">LEASH - Browser Shell</a> you will have shell without need to install anything on the server (so you don't need root access), it use lot of features of jQuery terminal, like better <a href="#less">less command</a> or python interpreter.</p>
      </article>
      <article id="c64">
        <header><h2>Commodore 64</h2></header>
        <p>You can check <a href="/commodore64">Commodore64 Demo inside vintage monitor</a></p>
      </article>
      <article id="wild">
        <header><h2>In the wild</h2></header>
        <ul>
          <li>Interpreters, interfaces, Tools, APIs
            <ul>
              <li><a href="http://warlab.info/">Tools for webmasters and geeks by warlab.info.</a></li>
              <li><a href="http://biwascheme.org">BiwaScheme</a> &mdash; use the same code as in example.</li>
              <li><a href="https://npmjs.org/package/node-web-repl">node-web-repl</a> &mdash; Add a web-based read/eval/print/loop to your Node.js app.</li>
              <li><a href="http://niutech.github.io/typescript-interpret/">Typescript Interpreter</a>.</li>
              <li><a href="https://github.com/bearstech/PloneTerminal">PloneTerminal</a> &mdash; terminal for plone.</li>
              <li><a href="http://www.cixtor.com/phpshell">PHP-Shell Generator</a>.</li>
              <li><a href="https://www.docker.io/gettingstarted/">Docker</a> &mdash; Docker.io use terminal in it's interactive tutorial.</li>
              <li><a href="https://github.com/glejeune/ews">Elixir Web Shell</a>.</li>
              <li><a href="http://apps.splunk.com/app/1607/">Web Terminal for Splunk</a>.</li>
              <li><a href="http://isay.monogra.fi/manhole/">Manhole</a> &mdash; A simple REPL into a running aspnet application.</li>
              <li><a href="http://leash.jcubic.pl">leash</a> &mdash; unix shell from the browser, lot of features of terminal.</li>
              <li><a href="http://toretto.x10.mx/terminal.html">simple use of terminal.</a></li>
              <li><a href="https://github.com/avalanche123/node-console">node-console</a> &mdash; using of socket IO that respond to events.</li>
              <li><a href="http://try-groonga.herokuapp.com/">Try Groonga</a> &mdash; Groonga is an open-source fulltext search engine and column store. It lets you write high-performance applications that requires fulltext search.</li>
              <li><a href="http://agnostic.housegordon.org/">AGNOSTIC</a> &mdash; UNIX Shell Javascript Emulation</li>
              <li><a href="http://the-james-burton.github.io/sshw/">sshw</a> &mdash; SSH client in a browser, via a JEE webapp.</li>
              <li><a href="http://calc.nutpan.com/">Online calculator</a>.</li>
              <li><a href="http://www.kvstore.io/">kvstore.io</a> &mdash; The Simple &lt;key,value&gt; Storage Service.</li>
              <li><a href="http://www.web-console.org/">web-console</a> &mdash; Web Console is a web-based application that allows to execute shell commands on a server directly from a browser (web-based SSH).</li>
              <li><a href="http://samy.pl/keysweeper/">KeySweeper</a> &mdash; use terminal to show live keyboard keystrokes logged.</li>
              <li><a href="http://jasonb.io/redditshell/">redditshell</a> &mdash; Reddit shell.</li>
              <li><a href="http://jobfeeds.info/devops/">devops jobs</a>.</li>
              <li><a href="https://github.com/AlexNisnevich/ECMAchine">ECMAchine</a> &mdash; Lisp-based in-browser toy operating system.</li>
            </ul>
          </li>
          <li>Home Pages
            <ul>
              <li><a href="http://dhruvbird.com/">Dhruv Matani</a> &mdash; use tilda for navigation.</li>
              <li><a href="http://www.hacklover.net/">hackLover</a> use hidden terminal on the button under the logo.</li>
              <li><a href="http://kidsoftheapocalypse.org/">Kids of the Apocalypse</a> &mdash; use of overlay on top of terminal that give vintage look.</li>
              <li><a href="http://huy.im/">Huy Doan</a> &mdash; black/green fullscreen.</li>
              <li><a href="http://awaxman.com/">Adam Waxman</a> &mdash; part of the site, stylized window, custom style.</li>
              <li><a href="http://adva.io/">Nicolò Paternoster</a> &mdash; black/green fullscreen.</li>
              <li><a href="http://butchewing.com/">Butch Ewing</a> &mdash; black/grey fullscreen.</li>
              <li><a href="http://jesperdahlback.com/">jesperdahlback.com</a> &mdash; full screen with ASCII art.</li>
              <li><a href="http://projects.stashcat.me/">projects.stashcat.me</a> &mdash; commodore 64 themed home page.</li>
              <li><a href="http://www.ohmycode.fr/">ohmycode.fr</a> &mdash; fullscreen with colors. Try command <strong>team</strong> that show ASCII art for each author.</li>
              <li><a href="http://vermillion.ws/">vermillion.ws</a> &mdash; fullscreen terminal.</li>
              <li><a href="http://www.madhuakula.com/">madhuakula.com</a> &mdash; fullscreen green text, fake filesystem using GitHub API (cd,ls,cat) as resume.</li>
              <li><a href="https://github.com/bbody/CMD-Resume">CMD-Resume</a> &mdash; Resume build with terminal.</li>
              <li><a href="http://www.hacklover.net/">hacklover.net</a> &mdash; use terminal inside draggable window.</li>
              <li><a href="http://www.ronniepyne.com/">ronniepyne.com</a> &mdash; full sreen terminal.</li>
              <li><a href="http://kunhernowoputra.com/">kunhernowoputra.com</a> &mdash; full screen terminal.</li>
              <li><a href="http://www.ronniepyne.com/">www.ronniepyne.com</a> &mdash; full screen terminal.</li>
              <li><a href="http://keon.io/">keon.io</a> &mdash; full screen terminal.</li>
              <li><a href="http://robertqualls.com/">Robert Qualls</a> &mdash; terminal that stick in the header of the page.</li>
              <li><a href="http://nbau21.github.io/">Noel Bautista</a> &mdash; full screen terminal with colors.</li>
              <li><a href="http://www.masraniglobal.com/terminal/system/desktop.html">masraniglobal</a> &mdash; Jurassic world themed terminal in dialog box.</li>
            </ul>
          </li>
          <li>Unusual use of terminal
            <ul>
              <li><a href="https://duckduckgo.com/tty/">Duck Duck Go</a> &mdash; use terminal as search interface.</li>
              <li><a href="http://rdebath.github.io/LostKingdom/">LostKingdom</a> &mdash; text based game.</li>
              <li><a href="http://thedirectorsbureau.com">Directors Bureau</a> &mdash; interface of this portfolio like site is exhanded by terminal</li>
              <li><a href="http://color64.com/">color64.com</a> &mdash; Color64 BBS Homepage.</li>
              <li><a href="http://m26.node-42.rv4a3.org/">ArmA 3 <abbr title="Alternate Reality Game">ARG</abbr></a> &mdash; more info about it <a href="http://www.gamebreaker.tv/pc-games/new-arma-3-arg/">here</a>.</li>
              <li><a href="http://cmd.fm/">cmd.fm</a> &mdash; command-line radio player for computer geeks.</li>
              <li><a href="http://wedding.jai.im/">wedding.jai.im</a> &mdash; use terminal to make OSX like terminal as invitation for a wedding.</li>
              <li><a href="http://premjith.in/">premjith.in</a> &mdash; Another wedding invitation using Ubuntu command line.</li>
              <li><a href="http://gfc.albertocongiu.com/thelab/">The Lab</a> &mdash; game where you code in javascript</li>
            </ul>
          </li>
          <li>Inside biger chunk of code
            <ul>
              <li><a href="http://code.google.com/p/os2online/">os2online</a> &mdash; Web based simulation of OS/2 Warp 3.0 operating system use jquery terminal.</li>
              <li><a href="https://code.google.com/p/orongocms/">OrongoCMS</a>.</li>
              <!-- <li><a href="http://realhub.org/dev/apps/default/?node=central">WISDM</a> &mdash; Web-Interactive Scientific Data Manager</li> -->
              <li><a href="http://alessandrorosa.altervista.org/complex/circles/">Circles</a> &mdash; ploting app for <a href="https://en.wikipedia.org/wiki/Kleinian_groups">Kleinian groups</a> - it have terminal as a tool.</li>
            </ul>
          </li>
          <!--<li><a href="http://plusmineus.com/">PlusMineus</a> &mdash; a Survival Roleplay Minecraft Server</li>-->
        </ul>
      </article>
    </section>
    <footer>
      <p id="copy">Copyright (c) 2010-<?php echo date('Y'); ?> <a href="http://jcubic.pl/jakub-jankiewicz">Jakub Jankiewicz</a><span style="display:none"><a href="https://plus.google.com/104010221373218601154?rel=author">g+</a></span></p>
    </footer>
    <script>//<![CDATA[

function unbalanced_parentheses(text_code) {
    var tokens = (new BiwaScheme.Parser(text_code)).tokens;
    var parentheses = 0;
    var brakets = 0;
    for(var i=0; i<tokens.length; ++i) {
        switch(tokens[i]) {
            case "[": ++brakets; break;
            case "]": --brakets; break;
            case "(": ++parentheses; break;
            case ")": --parentheses; break;
        }
    }
    return parentheses != 0 || brakets != 0;
}

jQuery(function($, undefined) {
    var bscheme = new BiwaScheme.Interpreter(function(e, state) {

        dterm.terminal.error(e.message);
    });
    var trace = false;

    puts = function(string) {
        dterm.terminal.echo(string);
    };
    var code_to_evaluate = '';
    var dterm = $('#dialogterm').dterm(function(command, term) {
        code_to_evaluate += ' ' + command;
        if (!unbalanced_parentheses(code_to_evaluate)) {
            try {
                bscheme.evaluate(code_to_evaluate, function(result) {
                    if (result !== undefined && result !== BiwaScheme.undef) {
                        if (result instanceof $.fn.init) {
                            term.echo('=> ' + '#<object $("' + result.selector + '")>');
                        } else if (typeof result == 'boolean') {
                            term.echo('=> ' + (result ? 'true' : 'false'));
                        } else {
                            term.echo('=> ' + BiwaScheme.to_write(result));
                        }
                    }
                });
            } catch(e) {
                term.error(e.message);
                throw(e);
            }
            term.set_prompt('scheme> ');
            code_to_evaluate = '';
        } else {
            term.set_prompt('... ');

        }
    }, {
        greetings: false,
        onInit: function(terminal) {
            terminal.echo('BiwaScheme Interpreter version ' +
                          BiwaScheme.Version +
                          '\nCopyright (C) 2007-2009 Yutaka HARA and ' +
                          'the BiwaScheme team\n');
        },
        width: 480,
        height: 320,
        exit: false,
        autoOpen: false,
        name: 'biwa',
        prompt: 'scheme> '
    });
    // redefine sleep it should pause terminal
    BiwaScheme.define_libfunc("sleep", 1, 1, function(ar){
        var sec = ar[0];
        assert_real(sec);
        dterm.terminal.pause();
        return new BiwaScheme.Pause(function(pause){
            setTimeout(function(){
                dterm.terminal.resume();
                pause.resume(BiwaScheme.nil);
            }, sec * 1000);
        });
    });
    // clear terminal
    BiwaScheme.define_libfunc('clear', 0, 0, function(args) {
        dterm.terminal.clear();
        return BiwaScheme.undef;
    });
    $('#open_term').click(function() {
        dterm.dialog('open');
    });
    //install library functions
    $.jqbiwa();
    // END BIWASCHEME
    // ------------------------------------------------------------
    // syntax highlight
    $('pre.javascript, pre.php').each(function() {
        var self=$(this);
        self.syntax(self.attr('class'));
    });
    // ------------------------------------------------------------
    // STARWARS
    // ------------------------------------------------------------
    var frames = [];
    var LINES_PER_FRAME = 14;
    var DELAY = 67;
    var lines = star_wars.length;
    for (var i=0; i<lines; i+=LINES_PER_FRAME) {
        frames.push(star_wars.slice(i, i+LINES_PER_FRAME));
    }
    var stop = false;
    function greetings(term) {
        term.echo('STAR WARS ASCIIMACTION\n'+
                  'Simon Jansen (C) 1997 - 2008\n'+
                  'www.asciimation.co.nz\n\n'+
                  'type "play" to start animation, press CTRL+D to stop');
    }
    function play(term, delay) {
        var i = 0;
        var next_delay;
        if (delay == undefined) {
            delay = DELAY;
        }
        function display() {
            if (!stop) {
                if (i == frames.length) {
                    i = 0;
                }
                term.clear();
                if (frames[i][0].match(/[0-9]+/)) {
                    next_delay = frames[i][0] * delay;
                } else {
                    next_delay = delay;
                }
                term.echo(frames[i++].slice(1).join('\n')+'\n');
                setTimeout(display, next_delay);
            } else {
                i = 0;
            }
        }
        display();
    }

    $('#starwarsterm').terminal(function(command, term){
        if (command == 'play') {
            term.pause();
            stop = false;
            play(term);
        }
    }, {
        width: 500,
        height: 230,
        prompt: 'starwars> ',
        greetings: null,
        onInit: function(term) {
            greetings(term);
        },
        keydown: function(e, term) {
            if (e.which == 68 && e.ctrlKey) {
                stop = true;
                term.resume();
                term.clear();
                greetings(term);
                return false;
            }
        }
    });
});
  //]]></script>
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
