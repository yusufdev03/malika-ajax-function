<?php

require 'review.php';

if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {

	$od = $_REQUEST['od'];
	review_template($od);

}else{
	review_error();
}

function review_error(){
echo '
	<div class="track-content">
		<div class="track-form">
			<div class="track-header">
				<div class="track-title">Tidak ada produk yang di tampilkan
					<a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
				</div>
			</div>
		</div>
	</div>
	';
}

function review_template($od){

		$ord_trial = new WC_Order($od);
		$order_items = $ord_trial->get_items( apply_filters( 'woocommerce_purchase_order_item_types', 'line_item' ) );
		?>

		<div class="track-content">
			<div class="track-form" style="width:80%;">
				<div class="track-header">
					<div class="track-title">Ulasan Barang
						<a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
					</div>
				</div>
				<div class="track-body">
					<table>
						<thead>
							<tr>
								<th class="review-tbl-name">Nama</th>
								<th class="review-tbl-ulasan">Ulasan</th>
								<th class="review-tbl-rating">rating</th>
								<th class="review-tbl-tombol"></th>
							</tr>
						</thead>
						<tbody>
							<?php
								foreach ( $order_items as $item_id => $item ) {
									$id_product = $item->get_product_id();
									$comments = malika_get_comments($id_product);
									//Desktop & tablet
									echo '<tr class="dekstop-review table">';
									echo '<th class="review-name">'.$item->get_name().'</th>';
									echo '<th class="review-text">'.malika_review_text($comments,$id_product).'</th>';
									echo '<th class="review-rate">'.malika_review_rating($comments,$id_product).'</th>';
									echo '<th class="review-button">'.malika_review_button($od,$id_product,$comments).'</th>';
									echo '</tr>';
									
									//Mobile
									echo '<tr class="mobile-review table">';
									echo '<th class="review-name">'.$item->get_name().'</th>';
									echo '<th class="review-rate">'.malika_review_rating($comments,$id_product).'</th>';
									echo '</tr>';
									
									echo '<tr class="mobile-review table">';
									echo '<th colspan="2" class="review-text">'.malika_review_text($comments,$id_product).'</th>';
									echo '</tr>';
									
									echo '<tr class="mobile-review table">';
									echo '<th class="review-button">'.malika_review_button($od,$id_product,$comments).'</th>';
									echo '</tr>';
								}
							?>
						</tbody>
					</table>
				</div>
			</div>
		</div>

	<?php
}
	?>