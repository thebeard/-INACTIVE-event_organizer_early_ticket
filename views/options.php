<div id="fdz-cg-admin-wrapper" class="wrap">
	<h2>Early Tickets</h2>
	<div class="metabox-holder">
		<div class="postbox">
			<h3>Settings</h3>
				<form action="options.php" method="post">
					<?php
						settings_fields('wc_early_tickets');							
						$early_ticket_options = get_option('wc_early_tickets');
					?>
					<table border="0" cellspacing="8" cellpadding="0" class="form-table">					
						<tr>
							<?php $checked = ( $early_ticket_options['active'] === 'on' ) ? ' checked' : ''; ?>
	    					<td><label for="wc_early_tickets[active]">Active</label></td>
	    					<td><input name="wc_early_tickets[active]" type="checkbox" <?php echo $checked; ?>/></td>
						</tr>
						<tr>
							<td colspan="2">
								<input type="submit" value="Save Changes" class="button button-primary" />
							</td>
					</tr>
					</table>
				</form>
		</div>
	</div>
</div>