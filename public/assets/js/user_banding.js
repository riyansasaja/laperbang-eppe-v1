$(document).ready(function () {

//panggil fungsi getbanding
// getbanding()
let getperkara = $('#dataPerkara').DataTable({
   "ajax": {
     url : `${baseUrl}user/getbanding`,
     type : 'GET',
     dataSrc : '',
     error: function(jqXHR, textStatus, errorThrown) {
                // Menampilkan pesan error
                console.error('ini depe console error:', textStatus, errorThrown);
                Swal.fire({
                    title: "Mohon Maaf",
                    text: 'data kosong atau tidak ditemukan ! Silahkan tambahkan data',
                    icon: "warning"
                  });
            }
   } ,
   
   
   
        "columns": [
            {
                "data": null, "sortable": false,
                render: function (data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                }
            },
            { "data": "no_perkara" },
            { "data": "jenis_perkara" },
            { "data": "no_banding" },
            { "data": "created_at", render :DataTable.render.date() },
            { "data": "status" },
            {
                "targets": [0],
                render : function (data, type, row, meta) {
                   return  `<a href="${baseUrl}user/upload/${row.id_perkara}" id='upload' class="badge text-bg-info text-decoration-none me-2"><i class="bi bi-cloud-arrow-up"></i> Upload</i> <br>
                <a href="javascript:;" id='view_doc' class="badge text-bg-warning text-decoration-none"><i class="bi bi-vector-pen"> Edit</i>`
                }
            }
        ],
        
});


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
        text: success,
        icon: "success"
      });
}

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