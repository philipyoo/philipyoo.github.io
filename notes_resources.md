# Notes & Resources:

## GitHub Markdown

[Markdown Cheatsheet by adam-p](https://github.com/adam-p/markdown-here/wiki/Markdown-Cheatsheet)


## [XML](http://www.w3schools.com/xml/xml_whatis.asp) (Extensible Markup Language)

* Designed to describe data vs HTML displays data.
* HTML is about displaying information, while XML is about carrying information
* XML language has no predefined tags. XML does not DO anything.
* XML is NOT a replacement for HTML. It is a complement to HTML. In most web applications, XML is used to describe data, while HTML is used to format and display the data.
* XML data is stored in plain text format. This provides a software- and hardware-independent way of storing data. This makes it much easier to create data that can be shared by different applications.


## [DOM](https://developer.mozilla.org/en-US/docs/Web/API/Document_Object_Model/Introduction) (Document Object Model)

* A programming interface for HTML and XML documents. Essentially, it connects web pages to scripts or programming languages.
* A webpage is a document. This document can be either displayed in the browser window, or as the HTML source. But it is the same document in both cases. DOM provides another way to represent, store, and manipulate that same document.
* DOM is a fully object-oriented representation of the web page, and it can be modified with a scriping language such as JS.
* The HTML you write is parsed by the browser and turned into the DOM.


## API (Application-Programming Interface)

* A set of programming instructions and standards for accessing a Web-based software application or **Web tool**.
* Ex: Amazon API allows 3rd party websites display Amazon products with updated prices and an option to buy the product.
* An API is a software-to-software interface, not a user interface. With APIs, applications talk to each other without any user knowledge or intervention.


## Preprocessors

#### HTML:

* HAML (HTML Abstraction Markup Language)


#### CSS:

* [Sass](http://sass-lang.com/guide) (Syntactically Awesome Style Sheets)
* SCSS is Sass but with different syntax. Syntax is more similar to CSS
* [Less.js](http://lesscss.org/features/)
* [Stylus](http://learnboost.github.io/stylus/)


## [Bootstrap](http://getbootstrap.com/):

* Bootstrap is the most popular HTML, CSS, and JS **framework** for developing responsive, mobile first projects on the web.
* Bootstrap uses vanilla CSS and also utilizes popular CSS preprocessors Sass and Less.
* With Bootstrap, you get extensive and beautiful documentation for common HTL elements, dozens of custom HTML and CSS components, and awesome jQuery plugins.


## Photos:

* [Pexels](http://www.pexels.com/) for free stock photos.


## Quick-Notes:

* An **IDE** (Integrated Development Environment) is a suped-up text editor with additional support for developing, compiling, and debugging applications (i.e. Visual Studio, Atom)
* A **Library** is a chunk of code that you can call from your own code, to help you do things more quickly/easily. For example, a Bitmap Processing library will provide facilities for loading and manipulating bitmap images, saving you having to write all that code for yourself.
* Most important difference between a **library** and a **framework** is **Inversion of Control**. This means that when you call a library, YOU are in contol. But with a framework, the control is inverted: the FRAMEWORK calls you. Basically, all the control flow is already in the framework and there's just a bunch of predefined white spots that you can fill out with your code.
* An **API** (Application Programming Interface) is a term meaning the functions/methods in a library that you can call to ask it to do things for you - the interface to the library. An API is an interface for other programs to interact with your program without having direct access. (i.e. Google maps, Twitter tweets, Amazon products with live prices).
* An **SDK** (Software Development Kit) is a library or programming package that enables a programmer to develop applications for a specific platform. Typically an SDK includes one or more APIs, programming tools, and documentation.
* A **toolkit** is like an SDK. It's a group of tools (and often code libraries) that you can use to make it easier to access a device or system.
* A **framework** is a big library that provides many services. For example, .NET provides an application framework - it provides most (if not all) of the services you need to write a vast range of applications - so one "library" provides support for pretty much everything you need to do. Often a framework supplies a base on which you build your own code, rather than you building an application that consumes library code. (i.e. bootstrap, sass)
* **AJAX** (Asynchronous JavaScript and XML) is not a programming language, but a new way to use existing standards. AJAX is the art of exchanging data with a server, and updating parts of a web page without reloading the whole page.
* **Compass** is a Sass framework and is a collection of helpful tools and tested best practices for Sass
* **jQuery** is a JS library


## CDNs

#### Bootstrap / Font-Awesome / jQuery

* Within `<head>`
```
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">
<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
```

* At end of `<body>`
```
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
<script src="http://getbootstrap.com/assets/js/ie10-viewport-bug-workaround.js"></script>
```