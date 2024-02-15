<?php

require 'curl_track.php';

function malika_available_kurir(){
	$kurir = [
		'jne',
		'tiki',
		'pos',
		'jnt',
		'wahana'
	];
	
	return $kurir;
}

if(isset($_REQUEST['r'])){
$resi = preg_replace('/\s+/', '', $_REQUEST['r']);

if(empty($_REQUEST['k'])){
    $kurirs = malika_available_kurir();
}else{
    $kurirs = array($_REQUEST['k']);
}

	for($i=0;$i<count($kurirs);$i++){
	$url = "https://pro.rajaongkir.com/api/waybill";
	$data = "waybill=".$resi."&courier=".$kurirs[$i];
	
	$data = data_transaksi($url,$data);

		if($data!=0){
			$data = $data['manifest'];
				
			if(!empty($data)){
				$kurir = $kurirs[$i];
				
				include 'template.php';
				
				return true;
				break;
			}
		}
	}
	?>
	<div class="track-content">
		<div class="track-form">
			<div class="track-header">
				<div class="track-title">No resi tidak ditemukan</div>
			</div>
		</div>
	</div>
	<?php
}
?>