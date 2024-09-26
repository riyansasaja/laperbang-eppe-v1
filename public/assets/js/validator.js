$(document).ready(function () {
    if (error) {
        Swal.fire({
            title: "Error",
            text: JSON.stringify(error),
            icon: "error"
          });
    }

    if (success) {
        Swal.fire({
            title: "Success",
            text: JSON.stringify(success),
            icon: "success"
          });        
    }

});