$(function () {
    $("#nav_page_a").on("click", function () {
        $("#wrapper").load("PageA.html");
    });
    $("#nav_page_b").on("click", function () {
        $("#wrapper").load("PageB.html");
    });
});


// http://api.jquery.com/load/


// need to create mini description pages for each blog post
// add these minis into a separate folder