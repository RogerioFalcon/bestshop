<?php
/**
 * Login Form
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     3.6.0
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
?>

<?php wc_print_notices(); ?>

<?php do_action( 'woocommerce_before_customer_login_form' ); ?>
<?php
	if( bestshop_mobile_check() ) : ?>

<div class="col2-set" id="customer_login">
	<div class="row">
		<div class="col-lg-6 col-md-6 col-sm-12">
			<div class="image-login">
				<?php $bestshop_img_mobile = ( swg_options( 'mobile_logo_account' ) ) ? swg_options( 'mobile_logo_account' ) : get_template_directory_uri() .'/assets/img/icon-myaccount.png'; ?>
				<img class="img_logo" alt="404" src="<?php echo esc_url( $bestshop_img_mobile ) ?>">
			</div>
			
			<h2><?php esc_html_e( 'Login', 'bestshop' ); ?></h2>
			
			<form class="woocommerce-form woocommerce-form-login login" method="post">

				<?php do_action( 'woocommerce_login_form_start' ); ?>

				<p class="form-row form-row-wide">
					<label for="username"><?php esc_html_e( 'Username or email address', 'bestshop' ); ?>&nbsp;<span class="required">*</span></label>
					<input type="text" class="input-text" name="username" id="username" value="" />
				</p>
				<p class="form-row form-row-wide">
					<label for="password"><?php esc_html_e( 'Password', 'bestshop' ); ?>&nbsp;<span class="required">*</span></label>
					<input class="input-text" type="password" name="password" id="password" value=""/>
				</p>

				<?php do_action( 'woocommerce_login_form' ); ?>
				<p class="form-row">
					<label for="rememberme" class="inline">
						<input name="rememberme" type="checkbox" id="rememberme" value="forever" /> <?php esc_html_e( 'Remember me', 'bestshop' ); ?>
					</label>
				</p>
				<p class="form-row">
					<?php wp_nonce_field( 'woocommerce-login', 'woocommerce-login-nonce' ); ?>
					<input type="submit" class="button" name="login" value="<?php esc_html_e( 'Login', 'bestshop' ); ?>" /> 
				</p>
				<p class="lost_password">
					<a href="<?php echo esc_url( wc_lostpassword_url() ); ?>"><?php esc_html_e( 'Lost your password?', 'bestshop' ); ?></a>
				</p>

				<?php do_action( 'woocommerce_login_form_end' ); ?>

			</form>
		</div>
		<?php if ( get_option( 'woocommerce_enable_myaccount_registration' ) === 'yes' ) : ?>

		<div class="col-lg-6 col-md-6 col-sm-12">

			<h2><?php esc_html_e( 'Register', 'bestshop' ); ?></h2>

			<form method="post" class="woocommerce-form woocommerce-form-register register">

				<?php do_action( 'woocommerce_register_form_start' ); ?>

				<?php if ( 'no' === get_option( 'woocommerce_registration_generate_username' ) ) : ?>

					<p class="form-row form-row-wide">
						<label for="reg_username"><?php esc_html_e( 'Username', 'bestshop' ); ?> &nbsp;<span class="required">*</span></label>
						<input type="text" class="input-text" name="username" id="reg_username" value="<?php if ( ! empty( $_POST['username'] ) ){ echo esc_attr( $_POST['username'] ) ;} ?>" />
					</p>

				<?php endif; ?>

				<p class="form-row form-row-wide">
					<label for="reg_email"><?php esc_html_e( 'Email address', 'bestshop' ); ?> &nbsp;<span class="required">*</span></label>
					<input type="email" class="input-text" name="email" id="reg_email" value="<?php if ( ! empty( $_POST['email'] ) ) { echo esc_attr( $_POST['email'] ); }?>" />
				</p>

				<?php if ( 'no' === get_option( 'woocommerce_registration_generate_password' ) ) : ?>

					<p class="form-row form-row-wide">
						<label for="reg_password"><?php esc_html_e( 'Password', 'bestshop' ); ?> &nbsp;<span class="required">*</span></label>
						<input type="password" class="input-text" name="password" id="reg_password" value="templates" />
					</p>

				<?php endif; ?>

				<!-- Spam Trap -->
				<div style="<?php echo ( ( is_rtl() ) ? 'right' : 'left' ); ?>: -999em; position: absolute;"><label for="trap"><?php esc_html_e( 'Anti-spam', 'bestshop' ); ?></label><input type="text" name="email_2" id="trap" tabindex="-1" /></div>

				<?php do_action( 'woocommerce_register_form' ); ?>
				<?php do_action( 'register_form' ); ?>

				<p class="form-row">
					<?php wp_nonce_field( 'woocommerce-register', 'woocommerce-register-nonce' ); ?>
					<button type="submit" class="woocommerce-Button button" name="register" value="<?php esc_attr_e( 'Register', 'bestshop' ); ?>"><?php esc_html_e( 'Register', 'bestshop' ); ?></button>
				</p>

				<?php do_action( 'woocommerce_register_form_end' ); ?>

			</form>
						<!-- Social -->
			<?php bestshop_get_social() ?>
		</div>
	</div>
</div>
<?php endif; ?>
</div>
<?php else :?>
<?php if ( get_option( 'woocommerce_enable_myaccount_registration' ) === 'yes' ) : ?>

<div class="col2-set" id="customer_login">
	<div class="row">
	<div class="col-lg-6 col-md-6 col-sm-12">

<?php endif; ?>

		<h2><?php esc_html_e( 'Login', 'bestshop' ); ?></h2>

		<form method="post" class="woocommerce-form woocommerce-form-login login">

			<?php do_action( 'woocommerce_login_form_start' ); ?>

			<p class="form-row form-row-wide">
				<label for="username"><?php esc_html_e( 'Username or email address', 'bestshop' ); ?> &nbsp;<span class="required">*</span></label>
				<input type="text" class="input-text" name="username" id="username" value="" />
			</p>
			<p class="form-row form-row-wide">
				<label for="password"><?php esc_html_e( 'Password', 'bestshop' ); ?> &nbsp;<span class="required">*</span></label>
				<input class="input-text" type="password" name="password" id="password" value="" />
			</p>

			<?php do_action( 'woocommerce_login_form' ); ?>
			<p class="form-row">
				<label for="rememberme" class="inline">
					<input name="rememberme" type="checkbox" id="rememberme" value="forever" /> <?php esc_html_e( 'Remember me', 'bestshop' ); ?>
				</label>
			</p>
			<p class="form-row">
				<?php wp_nonce_field( 'woocommerce-login', 'woocommerce-login-nonce' ); ?>
				<input type="submit" class="button" name="login" value="<?php esc_html_e( 'Login', 'bestshop' ); ?>" /> 
			</p>
			<p class="lost_password">
				<a href="<?php echo esc_url( wc_lostpassword_url() ); ?>"><?php esc_html_e( 'Lost your password?', 'bestshop' ); ?></a>
			</p>

			<?php do_action( 'woocommerce_login_form_end' ); ?>

		</form>

<?php if ( get_option( 'woocommerce_enable_myaccount_registration' ) === 'yes' ) : ?>

	</div>

	<div class="col-lg-6 col-md-6 col-sm-12">

		<h2><?php esc_html_e( 'Register', 'bestshop' ); ?></h2>

		<form method="post" class="woocommerce-form woocommerce-form-register register">

			<?php do_action( 'woocommerce_register_form_start' ); ?>

			<?php if ( 'no' === get_option( 'woocommerce_registration_generate_username' ) ) : ?>

				<p class="form-row form-row-wide">
					<label for="reg_username"><?php esc_html_e( 'Username', 'bestshop' ); ?> &nbsp;<span class="required">*</span></label>
					<input type="text" class="input-text" name="username" id="reg_username" value="<?php if ( ! empty( $_POST['username'] ) ){ echo esc_attr( $_POST['username'] ); }?>" />
				</p>

			<?php endif; ?>

			<p class="form-row form-row-wide">
				<label for="reg_email"><?php esc_html_e( 'Email address', 'bestshop' ); ?> &nbsp;<span class="required">*</span></label>
				<input type="email" class="input-text" name="email" id="reg_email" value="<?php if ( ! empty( $_POST['email'] ) ) { echo esc_attr( $_POST['email'] ); } ?>" />
			</p>

			<?php if ( 'no' === get_option( 'woocommerce_registration_generate_password' ) ) : ?>

				<p class="form-row form-row-wide">
					<label for="reg_password"><?php esc_html_e( 'Password', 'bestshop' ); ?> &nbsp;<span class="required">*</span></label>
					<input type="password" class="input-text" name="password" id="reg_password" />
				</p>

			<?php endif; ?>
			
			<?php do_action( 'woocommerce_register_form' ); ?>
			<?php do_action( 'register_form' ); ?>

			<p class="form-row">
				<?php wp_nonce_field( 'woocommerce-register', 'woocommerce-register-nonce' ); ?>
				<button type="submit" class="woocommerce-Button button" name="register" value="<?php esc_attr_e( 'Register', 'bestshop' ); ?>"><?php esc_html_e( 'Register', 'bestshop' ); ?></button>
			</p>

			<?php do_action( 'woocommerce_register_form_end' ); ?>

		</form>
	</div>
	</div>
</div>
<?php endif; ?>
<?php endif; ?>

<?php do_action( 'woocommerce_after_customer_login_form' ); ?>