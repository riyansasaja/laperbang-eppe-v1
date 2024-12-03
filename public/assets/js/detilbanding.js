$(document).ready(function () {    

    $('#simpan').on('click', function (e) {
        //ambil value dari select
        // e.preventDefault();
        console.log('tombol simpan di klik');
        let selectVal = $('#staper').val();

        switch (selectVal) {
            case 'none':
                e.preventDefault();
                alert('error','Silahkan pilih status perkara terlebih dahulu')
                break;
            case 'Pra Majelis':
                e.preventDefault();
                $('#pramejelisModal').modal('show')
                break;
            case 'Penunjukan Majelis Hakim':
                e.preventDefault();
                $('#mejelisModal').modal('show')
                break;
            case 'Pendaftaran Perkara':
                e.preventDefault();
                $('#daftarModal').modal('show')
                break;
            case 'Penunjukan Panitera Pengganti':
                e.preventDefault();
                $('#ppModal').modal('show')
                break;
            case 'Pengiriman Salinan Putusan':
                e.preventDefault();
                $('#putusanModal').modal('show')
                break;
        
            default:
                return true
                break;
        }

    });
    
    //fungsi untuk alert
    function alert(icon, text) {
        // jalankan di swal
        Swal.fire({
            icon: icon,
            text: text,
          });
    }


    //tombol buka kunci



    //fungsi untuk menampilkan alert dari session php
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


    bsCustomFileInput.init()



});

