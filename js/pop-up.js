// Get the popup box and buttons
var popupBox = document.getElementById("popup-box");
var closeBtn = document.getElementById("close-btn");
var okBtn = document.getElementById("ok-btn");

// Show the popup box
popupBox.style.display = "block";

// Close the popup when the close button or OK button is clicked
closeBtn.onclick = okBtn.onclick = function() {
    popupBox.style.display = "none";
}

// Close the popup when clicking anywhere outside of the popup content
window.onclick = function(event) {
    if (event.target == popupBox) {
        popupBox.style.display = "none";
    }
}