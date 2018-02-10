<?php
/**
 * Settings Page
 *
 * @package Smooth Scroll by WPOS
 * @since 1.0.0
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

global $wp_version;
?>

<div class="wrap ssbywpos-settings">

<h2><?php _e( 'Smooth Scroll Settings', 'smooth-scroll-by-wpos' ); ?></h2><br />

<?php
if( isset($_GET['settings-updated']) && $_GET['settings-updated'] == 'true' ) {
	echo '<div id="message" class="updated notice notice-success is-dismissible">
			<p>'.__("Your changes saved successfully :)", "smooth-scroll-by-wpos").'</p>
		  </div>';
}
?>

<form action="options.php" method="POST" id="ssbywpos-settings-form" class="ssbywpos-settings-form">
	
	<?php
	    settings_fields( 'ssbywpos_plugin_options' );
	    global $ssbywpos_options;
	    
	?>

	<div id="ssbywpos-general-settings" class="post-box-container ssbywpos-general-settings">
		<div class="metabox-holder">
			<div class="meta-box-sortables ui-sortable">
				<div id="general" class="postbox">

					<button class="handlediv button-link" type="button"><span class="toggle-indicator"></span></button>

						<!-- Settings box title -->
						<h3 class="hndle">
							<span><?php _e( 'MouseWheel Smooth Scroll', 'smooth-scroll-by-wpos' ); ?></span>
						</h3>
						
						<div class="inside">
						
						<table class="form-table ssbywpos-general-settings-tbl">
							<tbody>

								<tr>
									<th scope="row">
										<label for="ssbywpos-enable-popup"><?php _e('Enable MouseWheel Smooth Scroll', 'smooth-scroll-by-wpos'); ?>:</label>
									</th>
									<td>
										<input type="checkbox" name="ssbywpos_options[enable_mousewheelsmooth_scroll]" value="1" class="ssbywpos-enable-popup" id="ssbywpos-enable-popup" <?php checked( $ssbywpos_options['enable_mousewheelsmooth_scroll'], 1 ); ?> /><br/>
										<span class="description"><?php _e('Check this box if you want to enable Mouse Wheel Smooth Scroll .', 'smooth-scroll-by-wpos'); ?></span>
									</td>
								</tr>				
								
								
								<tr>
									<th scope="row">
										<label for="ssbywpos-popup-delay"><?php _e('Scroll Amount', 'smooth-scroll-by-wpos'); ?>:</label>
									</th>
									<td>
										<input type="number" min="0" name="ssbywpos_options[ssbywpos_scroll_amount]" value="<?php echo $ssbywpos_options['ssbywpos_scroll_amount']; ?>" class="ssbywpos-popup-delay" id="ssbywpos-popup-delay" /> <span><?php _e('step-px', 'smooth-scroll-by-wpos'); ?></span><br/>
										<span class="description"><?php _e('Enter scroll amount', 'smooth-scroll-by-wpos'); ?></span>
									</td>
								</tr>

								<tr>
									<th scope="row">
										<label for="ssbywpos-popup-disappear"><?php _e('Scroll Speed', 'smooth-scroll-by-wpos'); ?>:</label>
									</th>
									<td>
										<input type="number" min="0" name="ssbywpos_options[ssbywpos_scroll_speed]" value="<?php echo $ssbywpos_options['ssbywpos_scroll_speed']; ?>" class="ssbywpos-popup-disappear" id="ssbywpos-popup-disappear" /> <span><?php _e('millisecond', 'smooth-scroll-by-wpos'); ?></span><br/>
										<span class="description"><?php _e('Enter scroll speed.', 'smooth-scroll-by-wpos'); ?></span>
									</td>
								</tr>							

								<tr>
									<td colspan="2" valign="top" scope="row">
										<input type="submit" id="ssbywpos-settings-submit" name="ssbywpos-settings-submit" class="button button-primary right" value="<?php _e('Save Changes','smooth-scroll-by-wpos');?>" />
									</td>
								</tr>
							</tbody>
						 </table>

					</div><!-- .inside -->
				</div><!-- #general -->
			</div><!-- .meta-box-sortables ui-sortable -->
		</div><!-- .metabox-holder -->
	</div><!-- #ssbywpos-general-settings -->

	<div id="ssbywpos-general-settings" class="post-box-container ssbywpos-general-settings">
		<div class="metabox-holder">
			<div class="meta-box-sortables ui-sortable">
				<div id="general" class="postbox">

					<button class="handlediv button-link" type="button"><span class="toggle-indicator"></span></button>

						<!-- Settings box title -->
						<h3 class="hndle">
							<span><?php _e( 'Go To Top Scroll', 'smooth-scroll-by-wpos' ); ?></span>
						</h3>
						
						<div class="inside">
						
						<table class="form-table ssbywpos-general-settings-tbl">
							<tbody>

								<tr>
									<th scope="row">
										<label for="ssbywpos-enable-gototop"><?php _e('Enable Go To Top Scroll', 'smooth-scroll-by-wpos'); ?>:</label>
									</th>
									<td>
										<input type="checkbox" name="ssbywpos_options[enable_gototop_scroll]" value="1" class="ssbywpos-enable-popup" id="ssbywpos-enable-gototop" <?php checked( $ssbywpos_options['enable_gototop_scroll'], 1 ); ?> /><br/>
										<span class="description"><?php _e('Check this box if you want to enable Mouse Wheel Smooth Scroll .', 'smooth-scroll-by-wpos'); ?></span>
									</td>
								</tr>				
								
								<tr>
									<th scope="row">
										<label for="ssbywpos-gototop-speed"><?php _e('Scroll Speed', 'smooth-scroll-by-wpos'); ?>:</label>
									</th>
									<td>
										<input type="number" min="0" name="ssbywpos_options[ssbywpos_gototop_speed]" value="<?php echo $ssbywpos_options['ssbywpos_gototop_speed']; ?>" class="ssbywpos-popup-disappear" id="ssbywpos-gototop-speed" /> <span><?php _e('millisecond', 'smooth-scroll-by-wpos'); ?></span><br/>
										<span class="description"><?php _e('Enter scroll speed.', 'smooth-scroll-by-wpos'); ?></span>
									</td>
								</tr>							

								<tr>
									<td colspan="2" valign="top" scope="row">
										<input type="submit" id="ssbywpos-settings-submit" name="ssbywpos-settings-submit" class="button button-primary right" value="<?php _e('Save Changes','smooth-scroll-by-wpos');?>" />
									</td>
								</tr>
							</tbody>
						 </table>

					</div><!-- .inside -->
				</div><!-- #general -->
			</div><!-- .meta-box-sortables ui-sortable -->
		</div><!-- .metabox-holder -->
	</div><!-- #ssbywpos-general-settings -->
	<div id="ssbywpos-general-settings" class="post-box-container ssbywpos-general-settings">
		<div class="metabox-holder">
			<div class="meta-box-sortables ui-sortable">
				<div id="general" class="postbox">

					<button class="handlediv button-link" type="button"><span class="toggle-indicator"></span></button>

						<!-- Settings box title -->
						<h3 class="hndle">
							<span><?php _e( 'Smooth Scrolling Anchor', 'smooth-scroll-by-wpos' ); ?></span>
						</h3>
						
						<div class="inside">
						To use Smooth Scrolling Anchor, please use the bellow shortcode: <br />
						<code>[ss_link link="content1" name="Click Me" class="button"]</code> <br />
						
						<h4> Shortcode parameters for Smooth Scrolling To Element </h4>
							<ul>
								<li> <strong>link</strong> : [ss_link link="content1" (link parameter is used define the link target. ie if you are giving link="content1" thats when the contant where you want to scroll should have ID content1 ie &lt;div id="content1"&gt;....&lt;/div&gt; )</li>
								<li> <strong>name</strong> : [ss_link link="content1" name="Click Me"] (ie Name of link)</li>
								<li> <strong>class</strong> : [ss_link link="content1" name="Click Me" class="button"] ( ie design your button by giving a custom class)</li>
						</ul>
						
						</div><!-- .inside -->
				</div><!-- #general -->
			</div><!-- .meta-box-sortables ui-sortable -->
		</div><!-- .metabox-holder -->
	</div><!-- #ssbywpos-general-settings
	<!-- Appearance Setting Box Ends -->

</form><!-- end .ssbywpos-settings-form -->

</div><!-- end .ssbywpos-settings -->