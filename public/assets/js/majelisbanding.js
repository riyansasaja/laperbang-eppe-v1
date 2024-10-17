$(document).ready(function () {
    

    $('#tb_users').dataTable()

    //swal fire for error
    if (error) {

        Swal.fire({
            title: "Error",
            text: JSON.stringify(error),
            icon: "error"
          });
    }
    //swal fire for success
    if (success) {
    
        Swal.fire({
            title: "Success",
            text: success,
            icon: "success"
          });
    }


});