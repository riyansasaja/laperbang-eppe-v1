$(document).ready(function () {

    const pramejelisModal = new bootstrap.Modal($('#pramejelisModal'))
    const mejelisModal = new bootstrap.Modal($('#mejelisModal'))
    const ppModal = new bootstrap.Modal($('#ppModal'))
    const daftarModal = new bootstrap.Modal($('#daftarModal'))
    const putusanModal = new bootstrap.Modal($('#putusanModal'))
    
    $('#simpan').on('click', function (e) {
        //ambil value dari select
        let selectVal = $('#staper').val();

        switch (selectVal) {
            case 'none':
                e.preventDefault();
                alert('error','Silahkan pilih status perkara terlebih dahulu')
                break;
            case 'Pra Majelis':
                e.preventDefault();
                pramejelisModal.show()
                break;
            case 'Penunjukan Majelis Hakim':
                e.preventDefault();
                mejelisModal.show()
                break;
            case 'Pendaftaran Perkara':
                e.preventDefault();
                daftarModal.show()
                break;
            case 'Penunjukan Panitera Pengganti':
                e.preventDefault();
                ppModal.show()
                break;
            case 'Pengiriman Salinan Putusan':
                e.preventDefault();
                putusanModal.show()
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

    //function untuk simpan data pramajelis

    //function untuk simpan data nomor perkara


    //function untuk simpan Panitera Pengganti







    function cetakData(value, jenis) {
        console.log(value)
        console.log(jenis)
        Swal.close()
    }



});

