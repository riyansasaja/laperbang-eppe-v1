$(document).ready(function () {
    if (error) {

        Swal.fire({
            title: "Error",
            text: JSON.stringify(error),
            icon: "error"
          });
    }
});