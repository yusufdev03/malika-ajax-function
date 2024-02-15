<?php
// custom plugin by yusuf eko n.
/**
 * Plugin Name: Malika Ajax
 * Plugin URI: http://malika.id/
 * Description: Custom Ajax Page
 * Version: 0.0.3
 * Author: Yusuf Eko N.
 * Author URI: http://malika.id/
 */
 
if(isset($_REQUEST['t'])){
	include '../../../wp-load.php';

	switch($_REQUEST['t']){
		case 'video':
			require 'class/page-video/hal-video.php';
			echo body_html();
			break;
		case 'tracking':
			require 'class/tracking/tracking.php';
			break;
		// tracking not user login
		case 'not_track':
			require 'class/tracking/not_track.php';
			break;
		// terima barang (manual)
		case 'confirm':
			if(isset($_REQUEST['od'])){
				$user = get_current_user_id();
				$od = $_REQUEST['od'];
				update_user_meta($user,"order_".$od,"confirm");
				
				echo 'Ulas';
			}
			break;
		case 'review':
			require 'class/review/template.php';
			break;
		// update ulasan
		case 'up_review':
			require 'class/update/ulasan.php';
			break;
		// form error to email
		case 'error_form':
			require 'class/error/form.php';
			break;
		case 'send_error':
			if(isset($_REQUEST['e']) && isset($_REQUEST['p'])){
				$msg = $_REQUEST['e'];
				$sub = $_REQUEST['p'];
				malika_mail_error_reporting($sub,$msg);
			}else{
				echo 'Gagal';
			}
			break;
		default:
			break;
	}
}

function malika_ajax_url(){
	return plugin_dir_url(__FILE__);
}

function malika_mail_error_reporting($sub,$msg){
$user = wp_get_current_user();
	
if(empty($user->user_login)){
	$user->user_email = 'xxx@example.com';
	$user->user_login = malika_get_user_ip();
}

$to['mail'] = 'technical_support@malika.id';
$to['name'] = 'technical support';

malika_phpmailer($to,$sub,$msg,$user);
}

function malika_phpmailer($to,$sub,$msg,$user){
	include "class/mailer/class.phpmailer.php";
	
	$mail = new PHPMailer; 
	$mail->IsSMTP();
	$mail->SMTPSecure = 'none'; 
	$mail->Host = "malika.id"; //host masing2 provider email
	$mail->SMTPDebug = 2;
	$mail->Port = 25;
	$mail->SMTPAuth = true;
	$mail->Username = "technical_support@malika.id"; //user email
	$mail->Password = "mplf6vtvz"; //password email 
	$mail->SetFrom($user->user_email,$user->user_login); //set email pengirim
	$mail->Subject = 'Error Reporting - '.$sub; //subyek email
	$mail->AddAddress($to['mail'],$to['name']);  //tujuan email
	$mail->MsgHTML($msg);
	if($mail->Send()){
		echo "<br>pesan telah berhasil di sampaikan<br>Mohon bersabar dalam menunggu perbaikan.";
	}else{
		echo "<br>pesan gagal dikirim<br>Mohon coba beberapa saat lagi.";
	}
}

function malika_get_user_ip() {
	$ip = 'undefined';
	if (isset($_SERVER)) {
		$ip = $_SERVER['REMOTE_ADDR'];
		if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
		elseif (isset($_SERVER['HTTP_CLIENT_IP'])) $ip = $_SERVER['HTTP_CLIENT_IP'];
	} else {
		$ip = getenv('REMOTE_ADDR');
		if (getenv('HTTP_X_FORWARDED_FOR')) $ip = getenv('HTTP_X_FORWARDED_FOR');
		elseif (getenv('HTTP_CLIENT_IP')) $ip = getenv('HTTP_CLIENT_IP');
	}
	$ip = htmlspecialchars($ip, ENT_QUOTES, 'UTF-8');
	return $ip;
}

$GLOBALS['malika_ajax'] = malika_ajax_url();