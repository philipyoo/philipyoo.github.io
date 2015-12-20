$(document).foundation();

$(document).ready(function() {
  jQuery(function($, undefined) {
    $('#philips-term').terminal(function(command, term) {
      if (command === "test") {
        term.echo("you just typed test");
      } else {
        term.echo("Unknown command")
      }

    }, {
        greetings: "Welcome to Philip Yoo's Computer\n"+
                   "Use `help` for a list of commands",
        name: "Philip's Terminal",
        height: 300,
        width: 500,
        prompt: 'philipyoo> '
    });
  });
})

//
// $(function() {
//     var frames = [];
//     var LINES_PER_FRAME = 14;
//     var DELAY = 67;
//     //star_wars is array of lines from 'js/star_wars.js'
//     var lines = star_wars.length;
//     for (var i=0; i<lines; i+=LINES_PER_FRAME) {
//         frames.push(star_wars.slice(i, i+LINES_PER_FRAME));
//     }
//     var stop = false;
//     //to show greetings after clearing the terminal
//     function greetings(term) {
//         term.echo('STAR WARS ASCIIMACTION\n'+
//                   'Simon Jansen (C) 1997 - 2008\n'+
//                   'www.asciimation.co.nz\n\n'+
//                   'type "play" to start animation, '+
//                   'press CTRL+D to stop');
//     }
//     function play(term, delay) {
//         var i = 0;
//         var next_delay;
//         if (delay == undefined) {
//             delay = DELAY;
//         }
//         function display() {
//             if (i == frames.length) {
//                 i = 0;
//             }
//             term.clear();
//             if (frames[i][0].match(/[0-9]+/)) {
//                 next_delay = frames[i][0] * delay;
//             } else {
//                 next_delay = delay;
//             }
//             term.echo(frames[i++].slice(1).join('\n')+'\n');
//             if (!stop) {
//                 setTimeout(display, next_delay);
//             } else {
//                 term.clear();
//                 greetings(term);
//                 i = 0;
//             }
//         }
//         display();
//     }
//     $('#starwarsterm').terminal(function(command, term){
//         if (command == 'play') {
//             term.pause();
//             stop = false;
//             play(term);
//         }
//     }, {
//         width: 500,
//         height: 230,
//         prompt: 'starwars> ',
//         greetings: null,
//         onInit: function(term) {
//             greetings(term);
//         },
//         keypress: function(e, term) {
//             if (e.which == 100 && e.ctrlKey) {
//                 stop = true;
//                 term.resume();
//                 return false;
//             }
//         }
//     });
// });
