$(document).ready(function () {
  
  // Summernote WYSIWYG Editor
  $("#summernote").summernote({
    height: 300, // Set the height of the editor
  });

  // Bulk Action
  $("#selectAllBoxes").click(function (event) {
    if (this.checked) {
      $(".checkBoxes").each(function () {
        this.checked = true;
      });
    } else {
      $(".checkBoxes").each(function () {
        this.checked = false;
      });
    }
  });
});

// Users online
function loadUsersOnline() {
  $.get("functions.php?onlineusers=result", function (data) {
    $(".usersonline").text(data);
  });
}
setInterval(function () {
  loadUsersOnline();
}, 500); // Update every 5 seconds

