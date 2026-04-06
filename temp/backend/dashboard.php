<?php
function tigonwm_dashboard_temp()
{
?>
	<section class="tigonwm_section">
		<h2>Tigon Watermark Handler <span class="dashicons dashicons-tag"></span></h2>
		<p>
			Add new watermark <button class="btn btn-outline-info" data-toggle="modal" data-target="#tigonwm_modal">Add New</button>
		</p>


		<div class="modal fade" id="tigonwm_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">Add new watermark</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						  <span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<div class="form-group">
						    <label for="exampleInputEmail1">Watermark Text</label>
						    <input type="email" class="form-control" id="tigonwm_addnew_input" aria-describedby="emailHelp" placeholder="Ocean View NJ">
						    <small id="emailHelp" class="form-text text-muted">Write location label text here..</small>
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Close</button>
						<button type="button" class="btn btn-outline-success tigonwm_addnew">Add Now</button>
					</div>
				</div>
			</div>
		</div>

		<div class="tigonwm_tablewrapper">
			<table class="table table-striped">
				<thead>
			    	<tr>
			    		<th scope="col">#</th>
			    		<th scope="col">Watermark</th>
						<th scope="col">Action</th>
					</tr>
				</thead>
				<tbody>
					<?php
					Global $wpdb;
					$tigonwm_watermarks = 'tigonwm_watermarks';
					$all_wm = $wpdb->get_results($wpdb->prepare("SELECT * from {$tigonwm_watermarks}" ));

					foreach ( $all_wm as $wm ) 
					{
					?>
						<tr>
							<th scope="row">1</th>
							<td><?=$wm->watermark?></td>
							<td>
								<div class="modal fade" id="tigonwm_edit_<?=$wm->id?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
								<div class="modal-dialog" role="document">
									<div class="modal-content">
										<div class="modal-header">
											<h5 class="modal-title" id="exampleModalLabel">Edit Watermark</h5>
											<button type="button" class="close" data-dismiss="modal" aria-label="Close">
											  <span aria-hidden="true">&times;</span>
											</button>
										</div>
										<div class="modal-body">
											<div class="form-group">
											    <label for="exampleInputEmail1">Watermark Text</label>
											    <input type="email" class="form-control" id="tigonwm_editinput_<?=$wm->id?>" aria-describedby="emailHelp" placeholder="Ocean View NJ" value="<?=$wm->watermark?>">
											    <small id="emailHelp" class="form-text text-muted">Write location label text here..</small>
											</div>
										</div>
										<div class="modal-footer">
											<button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Close</button>
											<button type="button" class="btn btn-outline-success tigonwm_editlabel" data-crntid="<?=$wm->id?>">Update</button>
										</div>
									</div>
								</div>
							</div>
								<button class="btn btn-warning" data-toggle="modal" data-target="#tigonwm_edit_<?=$wm->id?>">Edit</button>
								<button class="btn btn-danger tigonwm_delbtn" data-crntid="<?=$wm->id?>">Delete</button>
							</td>
						</tr>
					<?php
					}
					?>
				</tbody>
			</table>
		</div>
	</section>
	
	

<?php
}