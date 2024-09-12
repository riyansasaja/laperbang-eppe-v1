$(document).ready(function () {
//panggil fungsi getbanding
getbanding()


// fungsi get banding
function getbanding() {
    $.ajax({
        type: "get",
        url: `${baseUrl}user/getbanding`,
        dataType: "json",
        success: function (response) {
            console.log(response.data)
        }
    });

}

  

});