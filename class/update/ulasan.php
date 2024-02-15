<?php

if(isset($_REQUEST['x']) && isset($_REQUEST['r'])){
$text = $_REQUEST['x'];
$rate = $_REQUEST['r'];
$id = $_REQUEST['id'];
$od = $_REQUEST['od'];
$cid = $_REQUEST['cd'];

$user = wp_get_current_user();

if($cid!=0){
	$arg = [
		'comment_ID' => $cid,
		'comment_date' => date("Y-m-d H:m:s"),
		'comment_approved' => 0,
		'comment_content' => $text,
	];

	wp_update_comment($arg);
}else{
		$arg = [
		'comment_post_ID' => $id,
		'comment_author' => $user->user_login,
		'comment_author_email' => $user->user_email,
		'comment_author_url' => '',
		'comment_date' => date("Y-m-d H:m:s"),
		'comment_type' => '',
		'comment_approved' => 0,
		'comment_content' => $text,
		'user_id' => $user->ID
	];

	$cid = wp_new_comment($arg);
}

update_comment_meta($cid,'rating',$rate);

echo 'Simpan';

}