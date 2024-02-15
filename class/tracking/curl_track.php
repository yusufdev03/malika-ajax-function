<?php

function connect_ongkir($url,$data){
	$curl = curl_init();

	curl_setopt_array($curl, array(
	  CURLOPT_URL => $url,
	  CURLOPT_RETURNTRANSFER => true,
	  CURLOPT_ENCODING => "",
	  CURLOPT_MAXREDIRS => 10,
	  CURLOPT_TIMEOUT => 30,
	  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	  CURLOPT_CUSTOMREQUEST => "POST",
	  CURLOPT_POSTFIELDS => $data,
	  CURLOPT_HTTPHEADER => array(
		"content-type: application/x-www-form-urlencoded",
		"key: 6e017a3c62af6b88f5a0dea0bfe0bbdd"
	  ),
	));

	$response = curl_exec($curl);
	$err = curl_error($curl);

	curl_close($curl);

	if ($err) {
		return $err;
	} else {
		$data = json_decode($response,true);
		return $data;
	}
}

function filter_data($data){
	$data = $data['rajaongkir'];
	if($data['status']['code']==200){
		$data = $data['result'];
		return $data;
	}else{
		$err = 0;
		return $err;
	}
}

function data_transaksi($url,$data){
	$data = connect_ongkir($url,$data);
	if($data!=0){	
		$data = filter_data($data);
		return $data;
	}else{
		return 0;
	}
}