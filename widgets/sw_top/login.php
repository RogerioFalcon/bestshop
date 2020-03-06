<?php 
$bestshop_header_style = swg_options('header_style');
if($bestshop_header_style !='style10') { ?>
<?php do_action( 'before' ); ?>
<?php if ( class_exists( 'WooCommerce' ) ) { ?>
<?php global $woocommerce; ?>
<div class="top-login">
	<?php if ( ! is_user_logged_in() ) {  ?>
		<ul>
			<li>
			<i class="fa fa-lock" aria-hidden="true"></i>
			<?php echo ' <a href="javascript:void(0);" data-toggle="modal" data-target="#login_form"><span>'.esc_html__('Login', 'bestshop').'</span></a> '; ?><?php esc_html_e( "or", 'bestshop' )?>
			<a class="register" href="<?php echo esc_url( home_url('/my-account') ); ?>" title="<?php esc_attr_e( 'Register', 'bestshop' ) ?>"><?php esc_html_e('Register', 'bestshop'); ?></a>
			</li>
		</ul>
	<?php } else{?>
		<div class="div-logined">
			<ul>
				<li>
					<i class="fa fa-unlock-alt" aria-hidden="true"></i>
					<?php 
						$user_id = get_current_user_id();
						$user_info = get_userdata( $user_id );	
					?>
					<a href="<?php echo wp_logout_url( home_url('/') ); ?>" title="<?php esc_attr_e( 'Logout', 'bestshop' ) ?>"><span><?php esc_html_e('Logout', 'bestshop'); ?></span></a>
				</li>
			</ul>
		</div>
	<?php } ?>
</div>
<?php }  } ?>
