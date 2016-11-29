// $(document).foundation();

// Set Social Media Stuff
// var sidebarDiv = document.getElementById("social-media");
// var smKeys = Object.keys(philipyoo.socialMedia);
//
// for (var i = 0; i < Object.keys(philipyoo.socialMedia).length; i++) {
//   // Create the div with class name
//   var element = document.createElement('div');
//   element.className = "small-4 medium-6 columns add-padding";
//
//   // Create link and set attribute to open link in new tab
//   var linkImg = document.createElement('a');
//   linkImg.href = philipyoo.socialMedia[smKeys[i]];
//   linkImg.setAttribute('target', '_blank');
//
//   // Create the img with class name
//   var img = document.createElement('img');
//   img.className = "img-icon";
//
//   // Get the key name and add to src for img
//   var key = smKeys[i]
//   img.src = "./img/" + smKeys[i] + ".png"
//
//   // Add the image to link
//   linkImg.appendChild(img);
//
//   // Add the link inside `element` div
//   element.appendChild(linkImg);
//
//   // Add the element to parent div `sidebarDiv`
//   sidebarDiv.appendChild(element);
// }

// Set Terminal Commands
var termCommands = {
  echo: function(cmd) {
    this.echo(cmd);
  },
  help: function() {
    // Exclude certain keys or categories within philipyoo.json
    var exclusions = ["name", "location", "gender", "resumeLink"];
    var validOptions = [];

    for (category in philipyoo) {
      if (exclusions.indexOf(category) === -1) {
        validOptions.push(category);
      }
    }

    this.echo("<p class='header-main'>// List of Commands: </p>", {raw: true});

    for (var i = 0; i < validOptions.length; i++) {
      this.echo("<span>&nbsp; -> " + validOptions[i] + "</span>", {raw: true});
    }

    this.echo("<span>&nbsp; -> clear</span><br/>", {raw: true});
  },
  about: function() {
    this.echo("<span>" + philipyoo.about + "</span>", {raw: true});
  },
  random: function() {
    this.echo(philipyoo.random[Math.floor(Math.random() * philipyoo.random.length)]);
  },
  resume: function() {
    for (var i = 0; i < Object.keys(philipyoo.resume).length; i++) {
      var category = Object.keys(philipyoo.resume)[i];
      var content = philipyoo.resume[category];   // Contents are all Array Types

      if (category !== "header") {
        this.echo("<br/>&nbsp;&nbsp;<span class='category'>" + category + "</span>", {raw: true});

        content.forEach(function(c) {
          console.log(Array.isArray(c));
          console.log(c);
          if (Array.isArray(c)) {  // for ease-of-use, made sub-contents array types
            var stringTogether = c.length === 1 ? c : c.join(', ')

            this.echo("<span class='sub-contents'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" + stringTogether + "</span>", {raw: true});
          } else {
            this.echo("<span class='contents'>" + c + "</span>", {raw: true});
          }
        }.bind(this))
      } else {
        this.echo("<br/><span class='header-main'> " + content[0] + "</span>", {raw: true});
        this.echo("&nbsp;&nbsp;<span class='header-sub'> > " + content[1] + "</span>", {raw: true});
      }
    }

    this.echo("<br/>--------", {raw: true});
    this.echo("Download the Resume by clicking <a href='./Resume.PhilipYoo.pdf' download='Resume.PhilipYoo.pdf'>HERE</a><br/><br/>", {raw: true});
  },
  projects: function() {
    var projectNames = Object.keys(philipyoo.projects);

    for (var i = 0; i < projectNames.length; i++) {
      this.echo("&nbsp;&nbsp;<p class='category'>" + projectNames[i]  + "</p>", {raw: true});

      this.echo("<p class='contents'>" + philipyoo.projects[projectNames[i]].info + "</p>", {raw: true});
      this.echo("<a href=" + philipyoo.projects[projectNames[i]].url + ">Link to Project</a><br/><br/>", {raw: true});
    }
  },
  contact: function() {
    var contact = Object.keys(philipyoo.contact);

    for (var i = 0; i < contact.length; i++) {
      this.echo('<a href="' + philipyoo.contact[contact[i]] + '">' + contact[i] + '</a>', {raw: true});
    }
  },
  clear: function() {
    clear();
    this.echo("Use `[[;gold;#243434]help]` for a list of commands\n");
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
    this.echo("[[;#79c3cf;#243434]17. test]");
    this.echo("[[;#d6b2a1;#243434]18. test]");
    this.echo("[[;#ade0e0;#243434]19. test]");
    this.echo("This is supposed to be a secret command! How'd you get here?!");
  },
  wut: function() {
    var mylink = "www.google.com";

    this.echo("Get the link to work");
    this.echo("Get the link to work", {raw: true});
    this.echo('<a href="www.google.com" target="_blank">' + mylink + '</a>', {raw: true, convertLinks: false});
    this.echo('<a href="http://jquery.com/">jQuery</a>',{raw:true, Token:false, convertLinks:false, linksNoReferer: false});
    this.echo();
    this.echo("[[g;#EEEEEE;]www.google.com]");
    this.echo();
  }
}

// Setup Terminal
jQuery(function($, undefined) {
  var height = $(window).height();

  $('#philips-term').terminal(termCommands, {
      greetings: "[[b;red;#243434]Note:] For best experience, view on Desktop with fullscreen\n" +
                 "Logged in to PHILIPs-SITE\n" +
                 "Use `[[;gold;#243434]help]` for a list of commands\n",
      name: "Philip's Terminal",
      prompt: "[[;#825d4d;#243434]guest~] :> ",
      onBlur: function() {
        return false;
      },
      exit: false,
      tabcompletion: true,
      completion: function(terminal, command, cb) {
        cb(['help', 'about', 'random', 'resume', 'contact', 'projects', 'clear']);
      },
      height: height
  });
});
