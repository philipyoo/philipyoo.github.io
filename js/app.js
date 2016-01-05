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
    "I'm a Semi-Foodie?r",
    "Coined the term 'Philip Yoo is Awesome'"
  ],
  "resume" : {
    "header" : ["Philip Yoo", "Full-Stack Developer"],
    "skills" : [
      "Programming Languages",
      ["Ruby", "JavaScript"],
      "Databases",
      ["SQLite", "PostgreSQL", "Mongo"],
      "Web Frameworks, Libraries & Others",
      ["Ruby on Rails", "NodeJS", "Sinatra", "AJAX", "jQuery", "React", "ActiveRecord", "HTML", "CSS"]
    ],
    "summary" : [
      "After graduating college, I tried my hand at a lot of different jobs. I interacted with a wide range of people and gained a lot of invaluable experiences, and yet there was still something missing-- everything was still \"just a job\". Reflecting on my past experiences, I knew I wanted to build things that would benefit others. In pursuit of something more, I dropped everything and wholly dedicated myself to learning to program.",
      "I attended Dev Bootcamp, where I spent 1000+ hours learning to program applications and build websites. I worked on projects in pairs or in groups and was able to clearly communicate ideas to the team. I learned about engineering empathy and how that can affect a team's performance. I approached many of my projects structurally from a user's point-of-view while applying Agile development. I picked up new technologies within days and applied them to relevant projects. And...I did this all while enjoying the experience.",
      "I am a full-stack web developer who has a strong desire to build meaningful and fun applications. I am currently seeking opportunities to apply and expand upon my current skill sets. I am a quick learner who enjoys problem-solving, gaming, and contributing to a team environment."
    ],
    "education" : ["Dev Bootcamp", "Web Development (2015)", "University of San Diego", "Bachelor of Business Administration (2010)"],
    "employment" : [
      "City National Bank, Relationship Banker", "Carlsbad, CA (Feb.14 - Jan.15)",
      "Accend Energy, Energy Efficiency Consultant", "San Diego, CA (Dec.12 - Dec.13)",
      "Aventis Asset Management, Research Analyst Intern", "Costa Mesa, CA (Jun.12 - Aug.12)",
      "USA Trading, Operations and Market Research", "Chicago, IL (Jan.11 - May.12)"
    ]
  },
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
    // Exclude certain keys or categories within philipyoo.json
    var exclusions = ["name", "location", "gender", "resumeLink", "socialMedia"];
    var validOptions = [];

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

    this.echo("<span> -> clear</span><br/>", {raw: true});
  },
  about: function() {
    this.echo("<span>" + philipyoo.about + "</span>", {raw: true});
  },
  random: function() {
    this.echo(philipyoo.random[Math.floor(Math.random() * philipyoo.random.length)]);
    this.echo("<i>Try using `random` again</i>", {raw: true});
  },
  resume: function() {
    this.echo("Download the Resume by clicking <a href='./Resume.PhilipYoo.pdf' download='Philip.pdf'>HERE</a>", {raw: true});
  },
  projects: function() {
    // this.echo("<span>")
  },
  clear: function() {
    clear();
  },
  colors: function() {
    this.echo("[[;#d3e7d3;#243434]1. test]");
    this.echo("[[;#243434;#243434]2. test]");
    this.echo("[[;#576479;#243434]3. test]");
    this.echo("[[;#323232;#243434]4. test]");
    this.echo("[[;#757575;#243434]5. test]");
    this.echo("[[;#825d4d;#243434]6. test]");
    this.echo("[[;#718c61;#243434]7. test]");
    this.echo("[[;#ada16d;#243434]8. test]");
    this.echo("[[;#4d7b82;#243434]9. test]");
    this.echo("[[;#8a7167;#243434]10. test]");
    this.echo("[[;#719393;#243434]11. test]");
    this.echo("[[;#e0e0e0;#243434]12. test]");
    this.echo("[[;#8a8a8a;#243434]13. test]");
    this.echo("[[;#cf9379;#243434]14. test]");
    this.echo("[[;#98d9aa;#243434]15. test]");
    this.echo("[[;#fae79d;#243434]16. test]");
    this.echo("[[;#79c3cf;#243434]17.test]");
    this.echo("[[;#d6b2a1;#243434]18. test]");
    this.echo("[[;#ade0e0;#243434]19. test]");
  },
}

jQuery(function($, undefined) {
  var height = $(window).height();

  $('#philips-term').terminal(termCommands, {
      greetings: "Logged in to PHILIPs-MBP\n"+
                 "Use `[[;gold;#243434]help]` for a list of commands\n",
      name: "Philip's Terminal",
      prompt: "[[;#825d4d;#243434]guest~] :> ",
      onBlur: function() {
        return false;
      },
      exit: false,
      tabcompletion: true,
      height: height
  });
});
