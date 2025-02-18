$(document).ready(function () {
    //untuk keperluan tampil di date select option
    //ambil tahun sekarang
    let tahun = new Date().getFullYear();
    //looping dari tahun 2016 mengingat sisurban sudah ada sejak 2016
    for (let index = 2016; index <= tahun; index++) {
        if (index == tahun) {
            //menambahkan jumlah tahun, sampai dengan tahun sekarang
            $('#inputTahun').append(`<option value="${index}" selected>${index}</option>`)
        } else {

            $('#inputTahun').append(`<option value="${index}" selected>${index}</option>`)
        }        
    }
    //Sweet Alert
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

    //btnsearch ditekan
    $('#btnSearch').on("click", function () {
        //ambil variabel
        let no = $("input[name='no']").val()
        let tahun = $('#inputTahun').val();
        let noper = `${no}/Pdt.G/${tahun}/PTA.Mdo`
       //panggil ajax
        $.ajax({
            type: "get",
            url: `${baseUrl}getstatus`,
            data: {
                no : no,
                tahun : tahun
            },
            dataType: "json",
            success: function (response) {
             
                let nomor = 1
                //looping hasil response ajax
                $.each(response.data, function (i, val) { 
                    //menampilkan pada modal
                    $('#t_noper').text(noper)
                    $('#isi').append(`
                        <tr>
                            <th scope="row">${nomor}</th>
                            <td>${val.status}</td>
                            <td>${new Date(val.tgl_status).toLocaleDateString('id-ID')}</td>
                        </tr>
                        `);
                        //modal tampil
                    $('#perkaraModal').modal('show')
                    nomor++
                });
            },
            //jika error
            error: function (jqXHR, textStatus, errorThrown) {
                //tampilkan pemberitahuan di swal2
                Swal.fire({
                    title: "Error",
                    text: jqXHR.responseJSON.messages.error ,
                    icon: "error"
                  });
            }
            
        });
        

    });


});