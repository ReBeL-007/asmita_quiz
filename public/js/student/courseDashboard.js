$(document).on("click", ".list-items li", function () {
    $(this)
        .addClass("active-list-class")
        .siblings()
        .removeClass("active-list-class");
});
