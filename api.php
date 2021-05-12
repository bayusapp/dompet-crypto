<?php
    $url = 'https://indodax.com/tapi';
    // Please find Key from trade API Indodax exchange
    $key = '7BW4NGMO-CWRH4YJF-DCN34TST-EPMSOEAH-QBDNKFOA';
    // Please find Secret Key from trade API Indodax exchange
    $secretKey = 'a39ca6cac14a5556e1a60b19bfb92ebb7997c8b71048b713adb5e3fd2fd0aa6d2aefecd18ea19c92';
    
	$data = [
	        'method' => 'getInfo',
	        'timestamp' => '1578304294000',
	        'recvWindow' => '1578303937000'
	    ];
	$post_data = http_build_query($data, '', '&');
    $sign = hash_hmac('sha512', $post_data, $secretKey);
    
    $headers = ['Key:'.$key,'Sign:'.$sign];

    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_HTTPHEADER => $headers,
        CURLOPT_URL => $url,
        CURLOPT_POST => true,
        CURLOPT_POSTFIELDS => $data,
        CURLOPT_RETURNTRANSFER => true
    ));

    $response = curl_exec($curl);

    curl_close($curl);
    echo $response;
    // $json_obj = json_decode($curl);
    // echo $json_obj->