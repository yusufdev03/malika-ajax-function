<?php

require 'curl_track.php';

if(isset($_REQUEST['r']) && isset($_REQUEST['k'])){
$resi = $_REQUEST['r'];
$kurir = $_REQUEST['k'];
	
$url = "https://pro.rajaongkir.com/api/waybill";
$data = "waybill=".$resi."&courier=".$kurir;

$data = data_transaksi($url,$data);
if($data!=0){
	$data = $data['manifest'];
	
	include 'template.php';

}else{ ?>
<div class="track-content">
	<div class="track-form">
		<div class="track-header">
			<div class="track-title">Server tidak merespon, mohon coba beberapa saat lagi...
				<a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
			</div>
		</div>
	</div>
</div>

<?php 
	}
}
?>