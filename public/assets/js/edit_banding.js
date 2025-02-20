$(document).ready(function () {


    $('#jenis_perkara').change(function () { 
        let jenisPerkara = $(this).val();
        if (jenisPerkara == 'Lain-lain') {
            $('#otheroption').removeAttr('hidden');
            $('#otheroption').attr('name', 'jenis_perkara');
            $("#jenis_perkara").removeAttr('name');
        } else {

        $('#otheroption').attr('hidden', true);
        $('#otheroption').removeAttr('name');
        $('#otheroption').val('');
        $('#jenis_perkara').attr('name', 'jenis_perkara');
        }
        
    });


    if (error) {

        Swal.fire({
            title: "Error",
            text: JSON.stringify(error),
            icon: "error"
          });
    }
});