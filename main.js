function deleteRecord(id) {
    if (confirm("Are you sure you want to delete this record?")) {
      // Send an AJAX request to the delete script
      $.any({
        url: "delete.php",
        type: "POST",
        data: { id: id },
        success: function (response) {
          // Update the table dynamically by removing the deleted row
          if (response === "success") {
            $("#row_" + id).remove();
          }
        },
        error: function (xhr, status, error) {
          console.log(xhr.responseText);
        }
      });
    }
  }