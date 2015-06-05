
// Figure out this jquery click function for the miniblog posts


$(document).ready(function(){
  $("#nav_page_a").on("click", function () {
    console.log( $(this).text('hi'));
    // $("#wrapper").load("../miniblog/blog_one.html");
  });
  $("#nav_page_b").on("click", function () {
    $("#wrapper").load("../miniblog/blog_two.html");
  });

})

// $(function () {
//     $("#nav_page_a").click(function () {
//         $("#wrapper").load("../miniblog/blog_one.html");
//     });
//     $("#nav_page_b").on("click", function () {
//         $("#wrapper").load("../miniblog/blog_two.html");
//     });
// });


// http://api.jquery.com/load/


// need to create mini description pages for each blog post
// add these minis into a separate folder