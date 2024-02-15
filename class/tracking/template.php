<?php
function tanggal_update($data){
	$jdt = count($data);
	$tgl = $data[$jdt-1]['manifest_date'];
	$tgl = format_tanggal($tgl);
	$wkt = $data[$jdt-1]['manifest_time'];
	$wkt = format_waktu($wkt);
	return $tgl.' '.$wkt;
}

function format_tanggal($tgl){
	$tgl=date_create($tgl);
	$d = date_format($tgl,"d");
	$m = date_format($tgl,"m");
	$m = format_bulan($m);
	$y = date_format($tgl,"Y");
	
	return $d.' '.$m.' '.$y;
}

function format_waktu($wkt){
	return substr($wkt,0,-5).' WIB';
	
}

function format_bulan($m){
	$m = intval($m);
	$bln = [
		1 => 'Januari',
		2 => 'Februari',
		3 => 'Maret',
		4 => 'April',
		5 => 'Mei',
		6 => 'Juni',
		7 => 'Juli',
		8 => 'Agustus',
		9 => 'September',
		10 => 'Oktober',
		11 => 'November',
		12 => 'Desember'
	];
	return $bln[$m];
}

function info_kurir($kurir){
	switch($kurir){
		case 'jne':
			$info = 'Untuk mempercepat pengiriman, kamu bisa menghubungi <strong>JNE</strong> di nomor telepon <strong>(021) 29278888</strong>';
			return $info;
			break;
		case 'jnt':
			$info = 'Untuk mempercepat pengiriman, kamu bisa menghubungi <strong>JNT</strong> di nomor telepon <strong>(0800) 100-1188</strong>';
			return $info;
			break;
		case 'pos':
			$info = 'Dikirim melalui POS Indonesia';
			return $info;
			break;
		case 'tiki':
			$info = 'Untuk mempercepat pengiriman, kamu bisa menghubungi <strong>TIKI</strong> di nomor telepon <strong>(021) 314-0404 </strong>';
			return $info;
			break;
		case 'wahana':
			$info = 'Dikirim melalui Wahana';
			return $info;
			break;
		default:
			return 'Dikirim melalui '.$kurir;
			break;
	}
}
?>

<div class="track-content">
	<div class="track-form">
		<div class="track-header">
			<div class="track-title">Histori Pengiriman
				<a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
			</div>
		</div>
		<div class="track-body">
			<div class="track-info"> 
				<div class="track-info-layout">
					<div class="update-flex">
						<i class="fas fa-shipping-fast" style="font-size:14px;color:#90c42f;"></i>
						Update histori terakhir : <?php echo tanggal_update($data) ;?>
						<div class="info-flex"><?php echo info_kurir($kurir);?></div>
					</div>
				</div>
			</div>
			<table>
				<thead>
					<tr>
						<th class="track-tbl-date">Tanggal</th>
						<th class="track-tbl-status">Status Pengiriman</th>
					</tr>
				</thead>
				<tbody>
					<?php
						if($kurir!='tiki'){
							$data = array_reverse($data);
						}
					
						foreach($data as $dt){
							echo '<tr>';
							echo '	<th class="track-info-date"><span style="width: 52%;display: inline-block;">'.format_tanggal($dt['manifest_date']).'</span>'.format_waktu($dt['manifest_time']).'</th>';
							echo '	<th class="track-info-status">'.$dt['manifest_description'].'</th>';
							echo '</tr>';
						}
					?>
				</tbody>
			</table>
		</div>
	</div>
</div>