// $(document).foundation();

// TODO: Use json information in `philipyoo.json`
// $.getJSON("./philipyoo.json", function(info) {
//   console.log(info);
// })

var philipyoo = {
  "name" : "Philip Yoo",
  "location" : "San Diego",
  "gender" : "male",
  "randomFacts" : [
    "I could live off of Burritos! (Seriously)",
    "Huge fan of Milk Tea with Boba.",
    "I enjoy playing Texas Hold'em Poker NL >:)",
    "First programming language: Ruby.",
    "Guilty Pleasure: Korean music and sports-related cartoons",
    "Semi-Foodie?",
    "Coined the term 'Philip Yoo is Awesome'"
  ],
  "aboutMeBody" : "Hello and thank you for dropping by! My name is Philip Yoo and I spent most of my life in San Diego, CA. I attended and graduated from Dev Bootcamp in San Francisco. I am an aspiring full-stack developer who is currently looking for opportunities to apply what I have learned so far and continue learning in order to be the best that I could be as a developer.",
  "resume" : ["Stuff goes in here"],
  "resumeLink" : "Put in link here",
  "socialMedia" : {
    "blogger" : "http://philipyoo.blogspot.com/",
    "email" : "mailto:philipyoo10@gmail.com",
    "github" : "https://github.com/philipyoo",
    "linkedin" : "https://www.linkedin.com/in/philipyoo",
    "twitter" : "https://twitter.com/philipYoo10"
  },
  "projects" : []
};


var termCommands = {
  echo: function(cmd) {
    this.echo(cmd);
  },
  test: function() {
    this.echo("You inputted test.");
  },
  help: function() {
    this.echo("<b>Hello</b>", {raw: true});
    this.echo("test");
  },
  random: function() {
    var url = "https://github.com/philipyoo/philipyoo.github.io/blob/master/philipyoo.json"

  },
  about: function() {
    this.echo("<p>" + philipyoo.aboutMeBody + "</p>", {raw: true});
  },
  resume: function() {

  },
  projects: function() {

  },
  clear: function() {
    clear();
  }
}


jQuery(function($, undefined) {

  $('#philips-term').terminal(termCommands, {
      greetings: "Welcome to Philip Yoo's Computer\n"+
                 "Use `[[guib;<blue>]help]` for a list of commands",
      name: "Philip's Terminal",
      prompt: 'philipyoo> ',
      onBlur: function() {
        return false;
      }
  });
});
