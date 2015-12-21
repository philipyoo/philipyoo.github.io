$(document).foundation();

// TODO: move to separate files and invoke
$(document).ready(function() {
  jQuery(function($, undefined) {
    $('#philips-term').terminal(function(command, term) {
      if (command === "test") {
        term.echo("Email: philipyoo10@gmail.com");
      } else {
        term.echo("Unknown command")
      }

    }, {
        greetings: "Welcome to Philip Yoo's Computer\n"+
                   "Use `[[guib;<blue>]help]` for a list of commands",
        name: "Philip's Terminal",
        height: 300,
        width: 500,
        prompt: 'philipyoo> '
    });
  });
})
