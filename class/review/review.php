<?php

function malika_get_comments($pid){
	$arg = [
		'post_id' => $pid,
		'user_id' => get_current_user_id()
	];
	$comment = get_comments($arg);

	if(!empty($comment)){
		foreach($comment as $comt) :
			$comments['comment_ID'] = $comt->comment_ID;
			$comments['comment_content'] = $comt->comment_content;
		endforeach;
		return $comments;
	}else{
		return 0;
	}
}

function malika_review_text($comments,$id_product){
	if($comments!=0){
		$comment = $comments['comment_content'];
	}else{
		$comment = '';
	}
	
	return '<textarea id="text-'.$id_product.'" rows="2" aria-required="true" required>'.$comment.'</textarea>';
}

function malika_review_rating($comment,$id_product){
	$rate = [
		0 => '',
		1 => '',
		2 => '',
		3 => '',
		4 => '',
		5 => ''
	];
	
	if($comment!=0){
		$comment_id = $comment['comment_ID'];
		
		$meta_value = get_comment_meta($comment_id,'rating');

		$meta_value = intval($meta_value[0]);
	
		$rate[$meta_value-1] = 'active';
		
		$rate[5] = 'selected';
	}
	
	$rating = '
	<div class="comment-form-rating">
		<p id="star-'.$id_product.'" class="stars '.$rate[5].'">
			<span>
				<a class="star-1 '.$rate[0].'" onclick="revRate(this)" data-val="1"></a>
				<a class="star-2 '.$rate[1].'" onclick="revRate(this)" data-val="2"></a>
				<a class="star-3 '.$rate[2].'" onclick="revRate(this)" data-val="3"></a>
				<a class="star-4 '.$rate[3].'" onclick="revRate(this)" data-val="4"></a>
				<a class="star-5 '.$rate[4].'" onclick="revRate(this)" data-val="5"></a>
			</span>
		</p>
	</div>
	';
	
	return $rating;
}

function malika_review_button($od,$pod,$comment){
	if($comment!=0){
		$comment_id = $comment['comment_ID'];
	}else{
		$comment_id=0;
	}
	return '<div id="save-'.$pod.'" class="button-review-comment" onclick="revSave(\''.$od.'\',\''.$pod.'\',\''.$comment_id.'\')">Simpan</div>';
}