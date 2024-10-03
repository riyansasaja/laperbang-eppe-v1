$(document).ready(function () {

    $('#tbBanding').DataTable();


//    getAllDataBanding

//    let tbBanding = $('#tbBanding').DataTable({
//         "ajax": {
//             url :`${baseUrl}admin/getAllDataBanding`,
//             dataSrc: ''
//         },
//         "columns": [
//             {
//                 "data": null, "sortable": false,
//                 render: function (data, type, row, meta) {
//                     return meta.row + meta.settings._iDisplayStart + 1;
//                 }
//             },
//             { "data": "no_perkara" },
//             { "data": "fullname" },
//             { "data": "no_banding" },
//             { "data": "status" },
//             {
//                 "data": null,
//                 "defaultContent": `
//                 <a href="javascript:;" class="item_view">Detil</a>
//                 <a href="javascript:;" class="item_status">Status</a>
//                 <a href="javascript:;" class="item_delete">Hapus</a>
//                 `
//             }
//         ]
//     });


//     //klik itemview
//     $('#tbBanding').on('click', '.item_view', function () {
//         let data = tbBanding.row($(this).parents('tr')).data()
//         let noper = data['no_perkara']
//         window.location.href= `${baseUrl}bandingdetil/${noper}`
//         console.log(data['no_perkara']);        
//     });

//     //klik status
//     $('#tbBanding').on('click', '.item_status', function () {
//         let data = tbBanding.row($(this).parents('tr')).data()
//         console.log(data['no_perkara']);        
//     });

//     //




});