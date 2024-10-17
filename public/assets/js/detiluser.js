$(document).ready(function () {
       //Sweet Alert
       if (error) {
        Swal.fire({
            title: "Error",
            text: error,
            icon: "error"
          });
    }

    if (success) {
        Swal.fire({
            title: "Success",
            text: success,
            icon: "success"
          });        
    }
});