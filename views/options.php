<div class="wrap">
	<h1>Early Tickets</h2>
	<?php
		if ( !function_exists('remove_filters_for_anonymous_class') ) { ?>
		<p>You need the plugin available at <a href="https://github.com/herewithme/wp-filters-extras" target="_blank">https://github.com/herewithme/wp-filters-extras</a> for this plugin to work.</p>
	<?php } else { ?>

		<p>By activating the option below, event tickets will be sent when the order status changes to processing, rather than at the completed state.</p>
		<form action="options.php" method="post">
			<?php
				settings_fields('wc_early_tickets');							
				$early_ticket_options = get_option('wc_early_tickets');
			?>
			<table border="0" cellspacing="8" cellpadding="0" class="form-table">					
				<tr>
					<?php $checked = ( $early_ticket_options['active'] === 'on' ) ? ' checked' : ''; ?>
					<th>Send on processing</label></th>
					<td>
						<fieldset>
							<label for="wc_early_tickets[active]">
								<input name="wc_early_tickets[active]" type="checkbox" <?php echo $checked; ?>/> Active
							</label>
						</fieldset>
					</td>
				</tr>
				<tr>
					<td colspan="2">
						<input type="submit" value="Save Changes" class="button button-primary" />
					</td>
			</tr>
			</table>
		</form>
	<?php } ?>
</div>