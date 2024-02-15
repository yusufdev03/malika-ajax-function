<?php
//include_once("cek-bilangan.php");

function get_channel_tube(){
	$api_key = "AIzaSyBK4Fu1kX3p-4L0OqVUpYmVFAMrqUlV5JA";
	$id_key = "UCMGCCX3XYhZGqf_sry5ik-w";
	
	//Get videos from channel by YouTube Data API
	$API_key    = $api_key;
	$channelID  = $id_key;
	$maxResults = 20;

	$videoList = json_decode(file_get_contents('https://www.googleapis.com/youtube/v3/search?order=date&part=snippet&channelId='.$channelID.'&maxResults='.$maxResults.'&key='.$API_key.''));
	
	return $videoList;
}

function iframe_tube($videoList){
	$i = 0;
	foreach($videoList->items as $item){
	//Embed video
		if(isset($item->id->videoId)){
			$list[$i] = $item->id->videoId;
		}
	$i += 1;
	}
	return $list;
}

function get_video_tube($videoid){
	$apikey = "AIzaSyBK4Fu1kX3p-4L0OqVUpYmVFAMrqUlV5JA";
	$json_output = file_get_contents('https://www.googleapis.com/youtube/v3/videos?id='.$videoid.'&key='.$apikey.'&part=snippet');
	//$json_output = str_replace("\n","<br>",$json_output);
	$json = json_decode($json_output,true);
	
	//This gives you the video description
	$video_description[0] = $videoid;
	$video_description[1] = $json['items'][0]['snippet']['title']; // content
	$video_description[2] = $json['items'][0]['snippet']['publishedAt']; // content
	$video_description[3] = $json['items'][0]['snippet']['description']; // content
	
	//content_html
	$video_description = content_html($video_description);
	
	return $video_description;
}

function content_html($content){
	$cnt['id_video'] = $content[0];
	$cnt['title'] = title_html($content[1]);
	$cnt['publish'] = published_html($content[2]);
	$cnt['description'] = text_html($content[3]);
	
	return $cnt;
}

function title_html($title){
	$kata = explode(" ",$title);
	$nKata = count($kata);
	
	$title = $nKata <= 3 ? $title : lower_case($kata);
	
	return $title;
}

function lower_case($judul){
	$nJdl = count($judul);
	$convTitle = $judul[0].' '.$judul[1].' '.$judul[2].' '.substr($judul[3],0,3).'...';	

	return $convTitle;
}

function published_html($waktu){
	$waktu = explode("T",$waktu);
	$waktu = $waktu[0];
	
	return $waktu;
}

function text_html($cnt){
	$cnt = explode(".",$cnt);
	$cnt = $cnt[0].".".$cnt[1].".";
	$cnt = nl2br($cnt);		
	return $cnt;
}

function rpl_html(){
	$list = get_channel_tube();
	$list = iframe_tube($list);
	$nArr = count($list);
	
	for($i=0;$i<$nArr;$i++){
		$content[$i] = get_video_tube($list[$i]);
	}
	
	return $content;
}

function body_html(){
$html['data'] = rpl_html();
$html = json_encode($html);
	
return $html;
}