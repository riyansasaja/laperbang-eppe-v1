$(document).ready(function () {    
    $('#simpan').on('click', function (e) {
        //ambil value dari select
        e.preventDefault();
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


    //async function untuk pramajelis
    async function majelis (jenis) {
    const { value: val } = await Swal.fire({
        title: "Silahkan pilih Majelis",
        input: "select",
        inputOptions: {
          //pilihan majelis
          majelis_a: "Majelis A",
          majelis_b: "Majelis B",
          majelis_c: "Majelis C"

        },
        inputPlaceholder: "Pilih Majelis",
        showCancelButton: true,
        //validator
        inputValidator: (value) => {
          return new Promise((resolve) => {
            if (value === "") {
                resolve("You need to select oranges :)");
            } else {
                //jika benar memilih jalankan fungis cetakData, nanti ganti dengan fungsi saveMajelis
              return cetakData(value, jenis);
            }
          });
        }
      });
    }

    function cetakData(value, jenis) {
        console.log(value)
        console.log(jenis)
        Swal.close()
    }



});

