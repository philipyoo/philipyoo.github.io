$(function () {
    $("#nav_page_a").on("click", function () {
        $("#main").load("PageA.html");
    });
    $("#nav_page_b").on("click", function () {
        $("#main").load("PageB.html");
    });
});


http://api.jquery.com/load/