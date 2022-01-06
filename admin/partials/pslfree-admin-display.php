<?php
/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       https://codecanyon.net/user/teknofraction/portfolio
 * @since      1.0.0
 *
 * @package    woocommerce_skeleton_loader_animation
 * @subpackage woocommerce_skeleton_loader_animation/admin/partials
 *
 * This file should primarily consist of HTML with a little bit of PHP.
 */

/*
 * The admin notices
 *
 * @since   1.0
 */

if ( ! is_admin() ) : ?>

	<h1>
		<?php printf( esc_html__( 'Sorry You Are Not Allowed to Edit These Settings', 'pslfree' ) ); ?>
	</h1>

	<?php
else :
	;
	?>

	<?php
	/**
	 * This function is provided for demonstration purposes only.
	 *
	 * An instance of this class should be passed to the run() function
	 * defined in woocommerce_skeleton_loader_animation_Loader as all of the hooks are defined
	 * in that particular class.
	 *
	 * The woocommerce_skeleton_loader_animation_Loader will then create the relationship
	 * between the defined hooks and the functions defined in this
	 * class.
	 */

	?>
	<div class="wrap pslfree_settings">
		<h1>
			<?php printf( esc_html( get_admin_page_title() ) ); ?>
		</h1>
		<!-- Displaying errors & messages -->
		<?php settings_errors(); ?>


		<div class="header">
			<p><?php printf( esc_html__( 'Add Premium Look & Feel to your Woocommerce website with Products Skeleton Loader!', 'pslfree' ) ); ?></p>
			<ul style="list-style: inside;">
				<li><?php printf( esc_html__( 'Enable or Disable Skeleton Loading Animation on Products.' ) ); ?></li>
				<li><?php printf( esc_html__( 'Enable Image Branding.' ) ); ?> 
					<span class="pro_btn2" ><?php printf( esc_html__( '(&nbsp;' ) ); ?></span>
					<a class="pro_btn" target="_blank" href="<?php printf( esc_html__( 'https://www.codester.com/teknofraction/' ) ); ?>">
						<?php printf( esc_html__( 'Pro Feature' ) ); ?>
					</a>
					<span class="pro_btn2" ><?php printf( esc_html__( '&nbsp;)' ) ); ?></span>
				</li>
				<li><?php printf( esc_html__( 'Add Custom Logo Branding on Loading Animation.' ) ); ?>
					<span class="pro_btn2" ><?php printf( esc_html__( '(&nbsp;' ) ); ?></span>
					<a class="pro_btn" target="_blank" href="<?php printf( esc_html__( 'https://www.codester.com/teknofraction/' ) ); ?>">
						<?php printf( esc_html__( 'Pro Feature' ) ); ?>
					</a>
					<span class="pro_btn2" ><?php printf( esc_html__( '&nbsp;)' ) ); ?></span>
				</li>
			</ul>
		</div>  


		<!-- Tabs -->
		<div class="wrap tab-content">
			<!-- Tabs Navigation -->
			<ul class="nav nav-tabs">
				<li class="active">
					<a href="#general"><?php printf( esc_html__( 'General Settings', 'pslfree' ) ); ?></a>
				</li>
				<li>
					<a href="#support"><?php printf( esc_html__( 'Support', 'pslfree' ) ); ?></a>
				</li>
			</ul>

			<!-- General Settings Tab -->
			<div id="general" class="tab-pane active">
				<form method="POST" action="options.php" style="width:50%">
					<?php settings_fields( 'pslfree_general_options' ); ?>	
					<?php do_settings_sections( 'general' ); ?>
					<?php wp_enqueue_media(); ?>
					<h1 style="margin-top: 2rem;"><b><?php printf( esc_html__( 'General Settings', 'pslfree' ) ); ?></b></h1>
					<table class="form-table" role="presentation">
						<tbody>
							<tr>
								<th scope="row"><label for="pslfree_switch"><?php printf( esc_html__( 'Enable Skeleton Loading:' ) ); ?></label></th>
								<td>
									<label class="control control--checkbox">
										<input type="checkbox" name="pslfree_switch" id="pslfree_switch" value="enabled"
										<?php checked( 'enabled', get_option( 'pslfree_switch' ) ); ?> />
										<div class="control__indicator"></div>
									</label>
								</td>
							</tr>
							<tr>
								<th scope="row">
									<label for="pslfree_image_switch"><?php printf( esc_html__( 'Enable Image Branding:' ) ); ?></label>
								</th>
								<td>
									<label class="control control--checkbox">
										<input type="checkbox" id="pslfree_image_switch" value="enabled"/>
										<div class="control__indicator"></div>
									</label>
									<br />
								</td>
							</tr>
							<tr
							style="display:none"
							class="pslfree_image_uploader">
								<th scope="row"><label for="pslfree_image" style="color:red"><?php printf( esc_html__( 'Pro Feature:' ) ); ?></label></th>
								<td>
									<button type="button" class="pslfree_btn_primary support_btn">
										<a target="_blank" href="<?php printf( esc_html__( 'https://www.codester.com/teknofraction/' ) ); ?>">
										<?php printf( esc_html__( 'Buy Premium!' ) ); ?>						</a>
									</button>
									<br />
								</td>
							</tr>
						</tbody>
					</table>
					<?php wp_nonce_field( 'pslfree_general_options', 'pslfree_general_nonce' ); ?>
					<?php submit_button( 'Save Settings', 'primary', 'pslfree_general', true, null ); ?>
				</form>
				<div class="preview">
				<h1><?php print( esc_html( 'Skeleton Preview' ) ); ?></h1>
				<hr>
				<div class="skeleton_bottom">
				<img
					src="<?php echo esc_url( PSLFREE_PLUGIN_URL . '/assets/icon.png' ); ?>"
					alt="placeholder" 
					class="pslfree_img"
					style="display:none">
						<div class="animation"
						style="
							<?php
							if ( get_option( 'pslfree_image_switch' ) ) {
								echo esc_html( 'display:none' );
							} else {
								echo esc_html( 'display:block' );
							}
							?>
						"></div>
				</div>
					<div class="pslfree_preview_placeholder">
						<img
						src="
								<?php
								if ( get_option( 'pslfree_image' ) ) {
									echo esc_url( get_option( 'pslfree_image' ) );
								} else {
									echo esc_url( PSLFREE_PLUGIN_URL . '/assets/icon.png' );
								}
								?>
						"
						alt="placeholder" 
						class="pslfree_img"
						/
						style="
							<?php
							if ( get_option( 'pslfree_image_switch' ) ) {
								echo esc_html( 'display:table-row' );
							} else {
								echo esc_html( 'display:none' );
							}
							?>
						">
					</div>
				</div>
			</div>

			<!-- Support Tab -->
			<div id="support" class="tab-pane">
				<div style="display:block;">
					<h1 style="margin-top: 2rem;">
						<b><?php printf( esc_html__( 'Need Support?', 'pslfree' ) ); ?></b>
					</h1>
					<br />
					<p>
						<?php printf( esc_html( 'If you have any more questions, visit our support on the' ) ); ?>
						<a target="_blank" href="<?php printf( esc_url( 'https://www.codester.com/items/comments/35168/woocommerce-skeleton-loader' ) ); ?>">
							<?php printf( esc_html( 'Codester' ) ); ?>
						</a>
						<br />
						<br />
						<?php printf( esc_html( 'Or you  can email us directly at' ) ); ?>
						<a href="<?php printf( esc_url( 'mailto:support@teknofraction.com' ) ); ?>">
							<?php printf( esc_html( 'support@teknofraction.com' ) ); ?>
						</a>
						<br />
						<br />
						<br />
						<br />
						<button type="button" class="pslfree_btn_secondary support_btn">
							<a target="_blank" href="<?php printf( esc_url( 'https://techriver.com.pk/teknofraction/pslfree/docs' ) ); ?>">
								<?php printf( esc_html( 'Online Documentation' ) ); ?>
							</a>
						</button>
						&nbsp;&nbsp;
						<a target="_blank" href="<?php printf( esc_url( 'https://www.codester.com/items/comments/35168/woocommerce-skeleton-loader' ) ); ?>">
							<?php printf( esc_html( 'Get Help !' ) ); ?>
						</a>
					</p>
				</div>
			</div>

		</div>
	</div>
<?php endif ?>
