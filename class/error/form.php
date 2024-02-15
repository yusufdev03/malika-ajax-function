<?php
if(isset($_REQUEST['e'])){
	$e = $_REQUEST['e'];
?>

<div class="track-content">
			<div class="track-form" style="width:60%;">
				<div class="track-header">
					<div class="track-title">Form Error Reporting
						<a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
					</div>
				</div>
				<div class="track-body">
					<table>
						<thead>
							<tr>
								<th class="error-tbl-name">Kepada</th>
								<th class="error-tbl-email">technical_support@malika.id</th>
								<th class="error-tbl-space"> </th>
							</tr>
							<tr>
								<th class="error-tbl-name">Judul</th>
								<th class="error-tbl-email">Error Reporting : Page <?php echo $e; ?></th>
								<th class="error-tbl-space"> </th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<th id="error-message" colspan="3">
									<textarea class="error-textarea"></textarea>
								</th>
							</tr>
							<tr>
								<th colspan="3">
									<div id="error-button" onclick="errSend('<?php echo $e; ?>')">Kirim</div>
								</th>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>
<?php
}
?>