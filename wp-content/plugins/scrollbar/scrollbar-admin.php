<?php

	if(empty($_POST['scrollbar_wp_hidden'])){
			$themepoints_scrollbar_colors = get_option( 'themepoints_scrollbar_colors' );
			$themepoints_scrollbar_width = get_option( 'themepoints_scrollbar_width' );	
			$themepoints_scrollbar_radius = get_option( 'themepoints_scrollbar_radius' );
			$themepoints_scrollbar_border = get_option( 'themepoints_scrollbar_border' );	
			$themepoints_scrollbar_speed = get_option( 'themepoints_scrollbar_speed' );
			$themepoints_scrollbar_autohide = get_option( 'themepoints_scrollbar_autohide' );
	}
	else {
		if($_POST['scrollbar_wp_hidden'] == 'Y'){
			$themepoints_scrollbar_colors = stripslashes_deep($_POST['themepoints_scrollbar_colors']);
			update_option('themepoints_scrollbar_colors', $themepoints_scrollbar_colors);

			$themepoints_scrollbar_width = stripslashes_deep($_POST['themepoints_scrollbar_width']);
			update_option('themepoints_scrollbar_width', $themepoints_scrollbar_width);

			$themepoints_scrollbar_radius = stripslashes_deep($_POST['themepoints_scrollbar_radius']);
			update_option('themepoints_scrollbar_radius', $themepoints_scrollbar_radius);
			
			$themepoints_scrollbar_border = stripslashes_deep($_POST['themepoints_scrollbar_border']);
			update_option('themepoints_scrollbar_border', $themepoints_scrollbar_border);
			
			$themepoints_scrollbar_speed = stripslashes_deep($_POST['themepoints_scrollbar_speed']);
			update_option('themepoints_scrollbar_speed', $themepoints_scrollbar_speed);
			
			$themepoints_scrollbar_autohide = stripslashes_deep($_POST['themepoints_scrollbar_autohide']);
			update_option('themepoints_scrollbar_autohide', $themepoints_scrollbar_autohide);
			?>
			<div class="updated"><p><strong><?php _e('Changes Saved.' ); ?></strong></p></div>
			<?php
		}
	}
?>


<div class="wrap skill-bars">
	<div id="icon-tools" class="icon32"><br></div><?php echo "<h2>".__('Scrollbar Option Settings', 'tpscrollbars')."</h2>";?>
		<form  method="post" action="<?php echo str_replace( '%7E', '~', $_SERVER['REQUEST_URI']); ?>">
			<input type="hidden" name="scrollbar_wp_hidden" value="Y">
			<?php 
				settings_fields( 'scrollbar_wp_plugin_options' );
				do_settings_sections( 'scrollbar_wp_plugin_options' );
			?>
			<table class="form-table">

				<tr valign="top">
					<th scope="row"><label for="themepoints_scrollbar_colors"><?php echo __('Scrollbar Color:', 'tpscrollbars'); ?></label></th>
					<td style="vertical-align:middle;">
					<input  size='10' name='themepoints_scrollbar_colors' class='scrollbar-color' type='text' id="scrollbar_color" value='<?php echo esc_attr($themepoints_scrollbar_colors); ?>' /><br />
					<span style="font-size:12px;color:#22aa5d"><?php echo __('Select scrollbar color', 'tpscrollbars'); ?>;</span>
					</td>
				</tr>

				<tr valign="top">
					<th scope="row"><label for="themepoints_scrollbar_width"><?php echo __('Scrollbar width:', 'tpscrollbars'); ?></label></th>
					<td style="vertical-align:middle;">
					<input  size='10' name='themepoints_scrollbar_width' class='scrollbar-width' type='text' id="scrollbar_width" value='<?php if ( !empty( $themepoints_scrollbar_width ) ) echo esc_attr($themepoints_scrollbar_width); else echo ''; ?>' />px<br />
					<span style="font-size:12px;color:#22aa5d"><?php echo __('Select scrollbar width .default width:5px', 'tpscrollbars'); ?></span>
					</td>
				</tr>

				<tr valign="top">
					<th scope="row"><label for="themepoints_scrollbar_radius"><?php echo __('Scrollbar border radius:', 'tpscrollbars'); ?></label></th>
					<td style="vertical-align:middle;">
					<input  size='10' name='themepoints_scrollbar_radius' class='scrollbar-radius' type='text' id="scrollbar_radius" value='<?php if ( !empty( $themepoints_scrollbar_radius ) ) echo esc_attr($themepoints_scrollbar_radius); else echo ''; ?>' />px<br />
					<span style="font-size:12px;color:#22aa5d"><?php echo __('Select scrollbar border radius .default border-radius:0px', 'tpscrollbars'); ?></span>
					</td>
				</tr>

				<tr valign="top">
					<th scope="row"><label for="themepoints_scrollbar_speed"><?php echo __('Scrollbar scroll speed:', 'tpscrollbars'); ?></label></th>
					<td style="vertical-align:middle;">
					<input  size='10' name='themepoints_scrollbar_speed' class='scrollbar-speed' type='text' id="scrollbar_speed" value='<?php if ( !empty( $themepoints_scrollbar_speed ) ) echo esc_attr($themepoints_scrollbar_speed); else echo ''; ?>' /><br />
					<span style="font-size:12px;color:#22aa5d"><?php echo __('Select scrollbar scroll speed .default speed:60', 'tpscrollbars'); ?></span>
					</td>
				</tr>
				
				<tr valign="top">
					<th scope="row"><label for="themepoints_scrollbar_border"><?php echo __('Scrollbar border:', 'tpscrollbars'); ?></label></th>
					<td style="vertical-align:middle;">
					<input  size='10' name='themepoints_scrollbar_border' class='scrollbar-border' type='text' id="scrollbar_border" value='<?php if ( !empty( $themepoints_scrollbar_border ) ) echo esc_attr($themepoints_scrollbar_border); else echo ''; ?>' />px<br />
					<span style="font-size:12px;color:#22aa5d"><?php echo __('Select scrollbar border .default border:0px', 'tpscrollbars'); ?></span>
					</td>
				</tr>
				<!-- Update version 1.1 --> 

				<tr valign="top">
					<th scope="row">
						<label style="padding-left:10px;" for="themepoints_scrollbar_autohide"><?php echo __('Auto Hide Mode:', 'tpscrollbars'); ?></label>
					</th>
					<td style="vertical-align:middle;">
						<select class="timezone_string" name="themepoints_scrollbar_autohide">
							<option value="true" <?php if($themepoints_scrollbar_autohide=='true') echo "selected"; ?> >Enable</option>
							<option value="false" <?php if($themepoints_scrollbar_autohide=='false') echo "selected"; ?> >Disable</option>
						</select><br/>
						<span style="font-size:12px;color:#22aa5d"><?php echo __('Enable/Disable scrollbar Auto Hide Mode', 'tpscrollbars'); ?></span>
					</td>
				</tr>
			</table>
			<p class="submit">
				<input class="button button-primary" type="submit" name="Submit" value="<?php _e('Save Changes', 'tpscrollbars' ) ?>" />
			</p>
		</form>

		<script>
			jQuery(document).ready(function(jQuery){	
				jQuery('#scrollbar_color').wpColorPicker();
			});
		</script>
</div>