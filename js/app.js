// $(document).foundation();

// TODO: Use json information in `philipyoo.json`
// $.getJSON("./philipyoo.json", function(info) {
//   console.log(info);
// })

var philipyoo = {
  "name" : "Philip Yoo",
  "location" : "San Diego",
  "gender" : "male",
  "about" : "Hello and thank you for dropping by! My name is Philip Yoo and I spent most of my life in San Diego, CA. I attended and graduated from Dev Bootcamp in San Francisco. I am an aspiring full-stack developer who is currently looking for opportunities to apply what I have learned so far and continue learning in order to be the best that I could be as a developer.",
  "random" : [
    "I could live off of Burritos! (Seriously)",
    "Huge fan of Milk Tea with Boba.",
    "I enjoy playing Texas Hold'em Poker NL >:)",
    "First programming language: Ruby.",
    "Guilty Pleasure: Korean music and sports-related cartoons",
    "Semi-Foodie?",
    "Coined the term 'Philip Yoo is Awesome'"
  ],
  "resume" : ["Stuff goes in here"],
  "resumeLink" : "Put in link here",
  "projects" : [],
  "socialMedia" : {
    "blogger" : "http://philipyoo.blogspot.com/",
    "email" : "mailto:philipyoo10@gmail.com",
    "github" : "https://github.com/philipyoo",
    "linkedin" : "https://www.linkedin.com/in/philipyoo",
    "twitter" : "https://twitter.com/philipYoo10"
  }
};


var termCommands = {
  echo: function(cmd) {
    this.echo(cmd);
  },
  help: function() {
    var exclusions = ["name", "location", "gender", "resumeLink", "socialMedia"];
    var validOptions = [];

    var sayings = [];

    for (category in philipyoo) {
      if (exclusions.indexOf(category) === -1) {
        validOptions.push(category);
      }
    }

    this.echo("<span>//~ List of Commands: </span>", {raw: true});
    this.echo("<span>//-------------------</span>", {raw: true});

    for (var i = 0; i < validOptions.length; i++) {
      this.echo("<span> -> " + validOptions[i] + "</span>", {raw: true});
    }

    this.echo("<span> -> clear</span>", {raw: true});
  },
  about: function() {
    this.echo("<br/><p>" + philipyoo.aboutMeBody + "</p>", {raw: true});
  },
  resume: function() {

  },
  projects: function() {

  },
  clear: function() {
    clear();
  },
  colors: function() {
    this.echo("[[;#d3e7d3;#153737]1. test]");
    this.echo("[[;#243434;#153737]2. test]");
    this.echo("[[;#576479;#153737]3. test]");
    this.echo("[[;#323232;#153737]4. test]");
    this.echo("[[;#757575;#153737]5. test]");
    this.echo("[[;#825d4d;#153737]6. test]");
    this.echo("[[;#718c61;#153737]7. test]");
    this.echo("[[;#ada16d;#153737]8. test]");
    this.echo("[[;#4d7b82;#153737]9. test]");
    this.echo("[[;#8a7167;#153737]10. test]");
    this.echo("[[;#719393;#153737]11. test]");
    this.echo("[[;#e0e0e0;#153737]12. test]");
    this.echo("[[;#8a8a8a;#153737]13. test]");
    this.echo("[[;#cf9379;#153737]14. test]");
    this.echo("[[;#98d9aa;#153737]15. test]");
    this.echo("[[;#fae79d;#153737]16. test]");
    this.echo("[[;#79c3cf;#153737]17.test]");
    this.echo("[[;#d6b2a1;#153737]18. test]");
    this.echo("[[;#ade0e0;#153737]19. test]");
  },
}

jQuery(function($, undefined) {
  var height = $(window).height();

  $('#philips-term').terminal(termCommands, {
      greetings: "Logged in to PHILIPs-MBP\n"+
                 "Use `[[;gold;#243434]help]` for a list of commands\n",
      name: "Philip's Terminal",
      prompt: "[[;#825d4d;#243434]guest~] > ",
      onBlur: function() {
        return false;
      },
      exit: false,
      tabcompletion: true,
      height: height
  });
});
