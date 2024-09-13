$(document).ready(function () {
//panggil fungsi getbanding
// getbanding()
let getperkara = $('#dataPerkara').DataTable({
   "ajax": `${baseUrl}user/getbanding`,
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
                "data": null,
                "defaultContent": `<a href="javascript:;" id='view_doc' class="badge text-bg-primary text-decoration-none me-2"><i class="bi bi-cloudy-fill">Upload</i> <br>
                <a href="javascript:;" id='view_doc' class="badge text-bg-warning text-decoration-none"><i class="bi bi-vector-pen">Edit</i>
                `
            }
        ]
});


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