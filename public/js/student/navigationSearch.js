function openSearch() {
    console.log("hello");
    const openBackgroundOverlayBtn = document.querySelector("#overlay");
    document.getElementById("overlay").style.display = "block !important";
}

function closeSearch() {
    document.getElementById("overlay").style.display = "none";
}
