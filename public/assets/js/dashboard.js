$(document).ready(function () {
    let ctx = document.getElementById('myChart');

    $.ajax({
        type: "get",
        url: `${baseUrl}getrekapbulan`,
        dataType: "json",
        success: function (res) {
            const myChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September','Oktober','November','Desember'],
                    datasets: [{
                        label: "Data Pengajuan Perkara Perbulan",
                        data: [res[0].jan,res[0].feb,res[0].mar,res[0].apr,res[0].mei,res[0].jun,res[0].jul, res[0].agu, res[0].sep, res[0].okt, res[0].nov, res[0].des,],
                        fill: false,
                        borderColor: 'rgb(75, 192, 192)',
                        tension: 0.1
                    }]
                }
            });




        }
    });


    
   





});//end docready