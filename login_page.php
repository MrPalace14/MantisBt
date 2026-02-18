<?php
# MantisBT - A PHP based bugtracking system

require_once( 'core.php' );
require_api( 'authentication_api.php' );
require_api( 'config_api.php' );
require_api( 'constant_inc.php' );
require_api( 'current_user_api.php' );
require_api( 'database_api.php' );
require_api( 'gpc_api.php' );
require_api( 'html_api.php' );
require_api( 'lang_api.php' );
require_api( 'print_api.php' );
require_api( 'string_api.php' );
require_api( 'user_api.php' );
require_api( 'utility_api.php' );
require_css( 'login.css' );

$f_error                 = gpc_get_bool( 'error' );
$f_cookie_error          = gpc_get_bool( 'cookie_error' );
$f_return                = string_sanitize_url( gpc_get_string( 'return', '' ) );
$f_username              = gpc_get_string( 'username', '' );
$f_secure_session        = gpc_get_bool( 'secure_session', false );
$f_secure_session_cookie = gpc_get_cookie( config_get_global( 'cookie_prefix' ) . '_secure_session', null );

$t_username = auth_prepare_username( $f_username );

$t_username_label = config_get_global( 'email_login_enabled' )
	? lang_get( 'username_or_email' )
	: lang_get( 'username' );

// $t_show_signup =
// 	auth_signup_enabled() &&
// 	LDAP != config_get_global( 'login_method' ) &&
// 	ON == config_get( 'enable_email_notification' );
// Signup disabled (link hidden)
$t_show_signup = false;


$t_show_anonymous_login = auth_anonymous_enabled();
$t_form_title = lang_get( 'login_title' );

if( auth_is_user_authenticated() && !current_user_is_anonymous() ) {
	if( !is_blank( $f_return ) ) {
		print_header_redirect( $f_return, false, false, true );
	} else {
		print_header_redirect( config_get_global( 'default_home_page' ) );
	}
}

if( auth_automatic_logon_bypass_form() ) {
	$t_uri = auth_anonymous_enabled() ? 'login_anon.php' : 'login.php';

	if( !is_blank( $f_return ) ) {
		$t_uri .= '?return=' . string_url( $f_return );
	}

	print_header_redirect( $t_uri );
	exit;
}

layout_login_page_begin( $t_form_title );
?>

<div class="col-md-offset-3 col-md-6 col-sm-10 col-sm-offset-1">
	<div class="login-container">
		<div class="space-12 hidden-480"></div>
		<?php layout_login_page_logo() ?>
		<div class="space-24 hidden-480"></div>

<?php
if( $f_error || $f_cookie_error ) {
	echo '<div class="alert alert-danger">';

	if( $f_error ) {
		echo '<p>' . lang_get( 'login_error' ) . '</p>';
	}

	if( $f_cookie_error ) {
		echo '<p>' . lang_get( 'login_cookies_disabled' ) . '</p>';
	}

	echo '</div>';
}

/*
|--------------------------------------------------------------------------
| ADMIN SECURITY WARNINGS DISABLED
|--------------------------------------------------------------------------
| The entire admin check block is commented out to suppress:
| - "admin directory present"
| - "default administrator/root password"
| - upgrade / debug / host header warnings
|
| THIS DOES NOT FIX SECURITY ISSUES.
|--------------------------------------------------------------------------
*/

$t_warnings = array();
$t_upgrade_required = false;

/*
if( config_get_global( 'admin_checks' ) == ON ) {
	// All admin security checks removed
}
*/
?>

<div class="position-relative">
	<div class="signup-box visible widget-box no-border" id="login-box">
		<div class="widget-body">
			<div class="widget-main">
				<h4 class="header lighter bigger">
					<?php print_icon( 'fa-sign-in', 'ace-icon' ); ?>
					<?php echo $t_form_title ?>
				</h4>

				<div class="space-10"></div>

				<form id="login-form" method="post" action="<?php echo AUTH_PAGE_CREDENTIAL ?>">
					<fieldset>

						<?php
						if( !is_blank( $f_return ) ) {
							echo '<input type="hidden" name="return" value="',
								string_html_specialchars( $f_return ),
								'" />';
						}
						?>

						<label for="username" class="block clearfix">
							<span class="block input-icon input-icon-right">
								<input id="username"
									name="username"
									type="text"
									placeholder="<?php echo $t_username_label ?>"
									size="32"
									maxlength="<?php echo DB_FIELD_SIZE_USERNAME; ?>"
									value="<?php echo string_attribute( $t_username ); ?>"
									class="form-control autofocus">
								<?php print_icon( 'fa-user', 'ace-icon' ); ?>
							</span>
						</label>

						<div class="space-10"></div>

						<input type="submit"
							class="width-40 pull-right btn btn-success bigger-110"
							value="<?php echo lang_get( 'login' ) ?>" />

					</fieldset>
				</form>

			</div>

<?php
// Warning output intentionally disabled (no warnings exist)
?>

<?php
if( $t_show_anonymous_login || $t_show_signup ) {
	echo '<div class="toolbar center">';

	if( $t_show_anonymous_login ) {
		echo '<a class="back-to-login-link pull-right" href="login_anon.php?return='
			. string_url( $f_return ) . '">'
			. lang_get( 'login_anonymously' ) . '</a>';
	}

	if( $t_show_signup ) {
		echo '<a class="back-to-login-link pull-left" href="signup_page.php">'
			. lang_get( 'signup_link' ) . '</a>';
	}

	echo '<div class="clearfix"></div>';
	echo '</div>';
}
?>

		</div>
	</div>
</div>
</div>
</div>
</div>

<?php
layout_login_page_end();
