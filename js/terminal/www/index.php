<?php // -*- mode: javascript -*-
header("X-Powered-By: ");
?>
<!DOCTYPE HTML>
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <meta charset="utf-8" />
    <title>JQuery Terminal Emulator Plugin</title>
    <link rel="canonical" href="http://terminal.jcubic.pl"/>
    <meta name="author" content="Jakub Jankiewicz - jcubic&#64;jcubic.pl"/>
    <meta name="Description" content="jQuery plugin for Command Line applications. Automatic JSON-RPC, custom object or a function. History, Authentication, Bash Shortcuts. Tab completion."/>
    <meta property="fb:admins" content="100000949516439" />
    <link rel="sitemap" type="application/xml" title="Sitemap" href="/sitemap.xml"/>
    <meta name="keywords" content="jquery,terminal,interpreter,console,bash,history,authentication,ajax,server,client"/>
    <link rel="shortcut icon" href="favicon.ico"/>
    <link rel="alternate" type="application/rss+xml" title="Comments RSS" href="http://terminal.jcubic.pl/comments-rss.php"/>
    <link rel="stylesheet" href="css/style.css"/>
    <link href="http://fonts.googleapis.com/css?family=Droid+Sans+Mono" rel="stylesheet" type="text/css"/>
    <link href="css/jquery.terminal.css" rel="stylesheet"/>
    <!--[if IE]>
    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
  </head>
  <body>
    <header id="main"><h1>JQuery Terminal Emulator Plugin</h1>
    <a href="#summary" class="skip">Skip to Content</a>
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
        <li><a href="#demo">Demo</a></li>
        <li><a href="api_reference.php">API Reference</a></li>
        <li><a href="examples.php">Examples</a></li>
        <li><a href="http://stackoverflow.com/questions/tagged/jquery-terminal">Q&amp;A</a></li>
        <li><a href="#download">Download</a></li>
        <li><a href="#comments">Comments</a></li>
        <li><a href="https://gitter.im/jcubic/jquery.terminal">Chat</a></li>
      </ul>
    </nav>
    <a href="https://github.com/jcubic/jquery.terminal" style="position: fixed; top: 0; left: 0; z-index:1000"><img style="border: 0;" src="https://s3.amazonaws.com/github/ribbons/forkme_left_darkblue_121621.png" alt="Fork JQuery Terminal Emulator on GitHub"></a>
    <section>
      <article>
        <header id="summary"><h2>Summary</h2></header>
    <p>JQuery Terminal Emulator is a plugin for creating command line interpreters in your applications. It can automatically call JSON-RPC service when user type commands or you can provide an object with methods, each method will be invoke on user command. Object can have nested objects which will create nested interpreter. You can also use a function in which you can parse user command by your own. It&prime;s ideal if you want to provide <strong>additional functionality for power users</strong>. It can also be used as debuging tool.</p>
      </article>
      <article>
        <header><h2>Features</h2></header>
        <ul>
          <li>You can create interpreter for your JSON-RPC service with <strong>one line of code</strong>.</li>
          <li>Support for <strong>authentication</strong> (you can provide function when user enter login and password or if you use <strong>JSON-RPC</strong> it can <strong>automatically call login function</strong> on the server and pass token to all functions)</li>
          <li>Stack of interpreters - you can create commands that trigger additional interpreters (eg. you can use couple of JSON-RPC service and run them when user type command)</li>
          <li>Command Tree - you can use nested objects each command will invoke a function if the value is an object it will create new interpreter and use function from that object as commands. You can use as much nested commands as you like. if the value is a string it will create JSON-RPC service.</li>
          <li>Tab completion with TAB key.</li>
          <li>Support for command line history (it use Local Storage if posible or cookies)</li>
          <li>Include <strong>keyboard</strong> shortcut from <strong>bash</strong> like CTRL+A, CTRL+D, CTRL+E etc.</li>
          <li><strong>Multiple terminals</strong> on one page (every terminal can have different command, it&prime;s own authentication function and it&prime;s own command history) - you can swich between them with CTRL+TAB</li>
          <li>It catch all exceptions and display error messages in terminal (you can see errors in your javascript and php code in terminal if they are in interpreter function)</li>
          <li>Support for basic text formating (color, background, underline, bold, italic) inside echo function</li>
          <li>You can create and overwrite existing keyboard shortcuts</li>
        </ul>
      </article>
       <article>
        <header id="demo"><h2>Demo</h2></header>
        <p>This is simple demo using javascript interpreter. (If cursor is not blinking - click on terminal to activate it) You can type any javascript expression, there are two debug function dir (like in python).</p>
        <p>You can use JQuery &lsquo;$&rsquo; function to manipulate the page. You also have access to this terminal in &lsquo;term&rsquo; variable. Try &lsquo;dir(term)&rsquo; or &lsquo;term.signature()&rsquo;.</p>
        <div id="term_demo"></div>
        <p>Javascript code:</p>
        <pre class="javascript">jQuery(function($, undefined) {
    $('#term_demo').terminal(function(command, term) {
        if (command !== '') {
            try {
                var result = window.eval(command);
                if (result !== undefined) {
                    term.echo(new String(result));
                }
            } catch(e) {
                term.error(new String(e));
            }
        } else {
           term.echo('');
        }
    }, {
        greetings: 'Javascript Interpreter',
        name: 'js_demo',
        height: 200,
        prompt: 'js> '});
});</pre>
      </article>
      <article>
        <header id="download"><h2>Download</h2></header>
        <p>Complete source with examples from <a href="https://github.com/jcubic/jquery.terminal">github</a></p>
        <ul>
          <li><a href="https://github.com/jcubic/jquery.terminal/tarball/master">tar.gz archive</a></li>
          <li><a href="https://github.com/jcubic/jquery.terminal/zipball/master">zip archive</a></li>
        </ul>
        <p>Or just the files:</p>
        <ul>
          <li><a href="js/jquery.terminal-0.9.1.js">jquery.terminal-0.9.1.js</a> - source [228KB]</li>
          <li><a href="js/jquery.terminal-0.9.1.min.js">jquery.terminal-0.9.1.min.js</a> - minified version [84KB]</li>
          <li><a href="js/unix_formatting.js">unix_formatting.js</a> - formatting for ANSI code and overtyping [16KB]</li>
          <li><a href="css/jquery.terminal-0.9.1.css">jquery.terminal-0.9.1.css</a> - stylesheet [8,0KB]</li>
          <li><a href="https://github.com/brandonaaron/jquery-mousewheel">jquery-mousewheel</a> - you may also want mousewheel plugin</li>
        </ul>
      </article>
      <article>
        <header id="license"><h2>License</h2></header>
        <p>JQuery Terminal Emulator plugin is released under <a href="http://www.gnu.org/licenses/lgpl.html">GNU LGPL3</a> license.</p>
        <p>It contains:</p>
        <ul>
          <li>Storage plugin Distributed under the MIT License &mdash; (c) 2010 Dave Schindler</li>
          <li>jQuery Timers licenced with the <a href="http://sam.zoy.org/wtfpl">WTFPL</a> — <a href="http://jquery.offput.ca/every/">plugin page</a></li>
          <li>Cross-Browser Split under the MIT License Copyright 2007-2012 Steven Levithan <a href="http://stevenlevithan.com">stevenlevithan.com</a></li>
        </ul>
      </article>
      <article>
        <header id="comments"><h2>Comments</h2></header>
        <p>Use terminal to leave a comment. Click to active. If you have a question you can create an <a href="https://github.com/jcubic/jquery.terminal/issues/new">issue on github</a>, ask on <a href="http://stackoverflow.com/questions/ask">stackoverflow</a> (you can use jquery-terminal tag) or send email to <a rel="email">jcubic&#64;jcubic.pl</a>. You can also send email with SO question or jump to <a href="https://gitter.im/jcubic/jquery.terminal">the chat</a>.</p>
        
        <p style="color:#1687E9">If you have feature request you can also <a href="https://github.com/jcubic/jquery.terminal/issues/new">add GitHub issue</a>.</p>
        <div id="term_comment"></div>
        <div id="share">
        <div id="wrapper">
          <div class="g-plusone" data-size="tall" data-count="true"></div>
          <script src="https://apis.google.com/js/plusone.js"></script>
          <a href="http://twitter.com/share" class="twitter-share-button" data-url="http://terminal.jcubic.pl" data-text="Create your own Command Line #app in #JavaScript using #JQuery plugin #CLI" data-count="vertical" data-via="jcubic">Tweet</a><script type="text/javascript" src="http://platform.twitter.com/widgets.js"></script>
          <!--<a class="DiggThisButton DiggMedium"></a>
          <script src="http://widgets.digg.com/buttons.js" async="true"></script>-->
          <!-- Place this tag where you want the su badge to render -->
          <su:badge layout="5" location="http://terminal.jcubic.pl"></su:badge>

          <!-- Place this snippet wherever appropriate -->
          <script type="text/javascript">
          (function() {
            var li = document.createElement('script'); li.type = 'text/javascript'; li.async = true;
            li.src = ('https:' == document.location.protocol ? 'https:' : 'http:') + '//platform.stumbleupon.com/1/widgets.js';
            var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(li, s);
          })();
          </script>
          <iframe src="http://www.facebook.com/plugins/like.php?href=http%3A%2F%2Fterminal.jcubic.pl%2F&amp;layout=box_count&amp;show_faces=true&amp;width=80&amp;action=like&amp;colorscheme=light&amp;height=65" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:80px; height:65px;" allowTransparency="true"></iframe>
          </div>
        </div>
        <div id="user_comments" style="clear:both"></div>
      </article>
    </section>
    <footer>
        <p id="copy">Copyright (c) 2010-<?php  echo date('Y'); ?> <a href="http://jcubic.pl/jakub-jankiewicz">Jakub Jankiewicz</a><span style="display:none"><a href="https://plus.google.com/104010221373218601154?rel=author">g+</a></span></p>
    </footer>
    <script src="http://code.jquery.com/jquery-1.7.2.min.js"></script>
    <script src="js/jquery.mousewheel-min.js"></script>
    <script src="js/jquery.terminal-min.js"></script>
    <script src="js/code.js"></script>
    <script>

jQuery(function($, undefined) {
    $('a[rel=email]').each(function() {
        var self = $(this);
        self.attr('href', 'mailto:' + self.text().replace('&#64;', '@'));
    });
    $('.donate').mouseover(function() {
        $(this).stop().animate({'margin-right': -30}, 300);
    }).mouseout(function() {
        $(this).stop().animate({'margin-right': -256});
    });
    // global to access from js terminal
    term = $('#term_demo').terminal(function(command, term) {
        if (command !== '') {
            try {
                var result = window.eval(command);
                if (result !== undefined) {
                    term.echo(new String(result));
                }
            } catch(e) {
                term.error(new String(e));
            }
        } else {
           term.echo('');
        }
    }, {
        greetings: 'Javascript Interpreter',
        name: 'js_demo',
        height: 200,
        prompt: 'js> '
    });
    // ----------------------------------------------------------------
    // COMMENTS
    function now() {
        var d = new Date();
        return d.getDate() + '-' + (d.getMonth()+1) + '-' + d.getFullYear();
    }
    function add_comment(date, name, img, www, comment) {
        name = name || 'Anonymous';
        if (www && www.match(/http:\/\/.*\..*/)) {
            name =  '<a href="' +www + '" target="blank">' + name + '</a>';
        }
        if (comment == '') {
            comment = '&nbsp;';
        }
        comment = comment.replace(/\n/g, "<br/>");
        $('#user_comments').append('<div class="comment"><img src="' + img +
                                   '"/><ul><li>' + name + '</li><li>' + date +
                                   '</li>' +'</ul><p>' +
                                   comment + '</p></div>');
    }
    var process = 1;
    var prompts = ['name', 'email', 'www', 'comment'];
    var comment = [];
    var count = 1;
    $('#term_comment').terminal(function(command, term) {
        var idx = count++ % 4;
        if (idx < 3) {
            if (prompts[idx] == 'email') {
                term.echo('[[;#C6AD00;]&#91;!&#93; email is only for avatar,' +
                          ' I may also send email if you ask question]');
            }
            comment.push(command); //push the same function with diffrent prompt
            term.push(arguments.callee, {prompt: prompts[idx] + ': '});
        } else {
            var comment_string = '';
            term.echo("[[;#0a0;;]enter your comment and put single period '.' at the end.]");
            comment.push(command);
            term.push(function(command, term) {
                if (command == '.') {
                    comment.push($.trim(comment_string));
                    count++;
                    term.pop().pop().pop();
                    term.pause();
                    $.jrpc("service.php", 'add_comment', comment, function(data) {
                        term.resume().clear();
                        if (data && data.result) {
                            comment[1] = data.result;
                            add_comment.apply(null, [now()].concat(comment));
                            term.echo("Thanks you for your comment");
                        } else if (data.error) {
                            term.error("[RPC] " + data.error.message);
                        } else {
                            term.echo("Sorry but something wicked happen on the server");
                        }
                        comment = [];
                    }, function(xhr, status, error) {
                        term.resume();
                        term.error('[AJAX] Response: ' +
                                   status + '\n' +
                                   xhr.responseText);
                        comment = [];
                    });
                } else {
                    term.set_prompt('...');
                    comment_string += command + '\n';
                }
            }, {prompt: '...'}); // last interpreter
        }
    }, {
        greetings: false,
        height: 100,
        history: false,
        prompt: prompts[0] + ': ',
        enabled: false
    });
    // fetch comments
    $('#user_comments').addClass('load');

    // ------------------------------------------------------------
    $('pre.javascript').syntax('javascript');

    $('nav li a').click(function() {
        var href = $(this).attr('href');
        if (href[0] == '#') {
            $('html,body').animate({
                scrollTop: $(href).offset().top - 50
            }, 500);
        }
    });

    $.jrpc("service.php", 'get_comments', [], function(data) {
        if (data.error) {
            $('#user_comments').append('<p>Error Loading Comments: ' +
                                       data.error.message +
                                       '</p>');
        } else {
            $.each(data.result, function(i, comment) {
                add_comment.apply(null, comment);
            });
            $('#user_comments').removeClass('load');
        }
    }, function(xhr, status, error) {
        $('#user_comments').removeClass('load').
           append('<p>Error Loading Comments</p>');
    });


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