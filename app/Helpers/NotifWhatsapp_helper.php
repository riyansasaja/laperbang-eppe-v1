<?php


function notification($target, $message)
{
    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://api.fonnte.com/send',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,

        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => array(
            'target' => $target,
            'message' => $message . "
    untuk Info lebih lanjut silahkan mengunjungi https://laperbang.pta-manado.go.id/      
--- Pesan Ini Dikirim Otomatis, Harap untuk tidak dibalas ---,
terima kasih ",
            'delay' => '2'
        ),
        CURLOPT_HTTPHEADER => array(
            "Authorization: 3W5ycCuAB4r4szc6gwq5"
        ),
    ));

    $response = curl_exec($curl);

    curl_close($curl);
    return $response;
}
