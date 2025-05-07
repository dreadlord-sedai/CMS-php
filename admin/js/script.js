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


