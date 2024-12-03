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



    //cek timecontrol
    $.ajax({
        type: "GET",
        url: `${baseUrl}user/gettimecontrol/${id_perkara}`,
        dataType: "json",
        success: function (response) {
            console.info(response);
            let time_log = response.time_log;
            let time_now = Math.floor(new Date().getTime()/1000.0);
            let selisih_waktu = time_now - time_log;
            let batas_upload_bundel_b = 3600 * 72;
            console.info('waktu sekarang' + time_now);
            console.info('selisih waktu' + selisih_waktu);
            console.info('batas upload' + batas_upload_bundel_b);
            if (selisih_waktu >= batas_upload_bundel_b) {
                console.info('kunci')
                $('#infoerror').removeAttr('hidden');
                $(':input[type="submit"]').prop('disabled', true);
                $(':input[type="file"]').prop('disabled', true);
            }
            else {
                $('#infoerror').attr('hidden', true);
            }
        }
    });


    //buka kunci di klik
    $('#bukaKunci').on('click', function () {
        let tes = $("meta[name='jago']").attr("content");
        let csrf = $('meta[name="{csrf_header}"]').attr('content');
        let csrf_name = $('.txt_csrfname').attr('name');
        let csrfHash = $('.txt_csrfname').val(); 
        // return console.info(csrf);


        (async () => {
            const {value : alasan} = await Swal.fire({
                title : "Request Unlock",
                input: "textarea",
                inputLabel: "Alasan Upload e-Doc ",
                inputPlaceholder: "Tuliskan Alasan Anda ....",
                confirmButtonText: "Kirim",
                showCancelButton: true,
            });
            if (alasan) {
               $.ajax({
                type: "post",
                url: `${baseUrl}user/requnlock`,
                headers:{'X-CSRF-TOKEN': csrfHash },
                data : {
                    idperkara : id_perkara,
                    pesan : 'tes satu dua',
                },
                dataType: "json",
                success: function (response) {
                    console.info(response);
                    Swal.fire('Request Unlock Terkirim.');
                },
                error: function(xhr, status, error) {
                    console.info(xhr);
                }
               });
            }
        })()



       
    });




});