<?php
$g_hostname               = '192.168.1.230';
$g_db_type                = 'mysqli';
$g_database_name          = 'mantis';
$g_db_username            = 'root';
$g_db_password            = '';

$g_default_timezone       = 'Europe/Berlin';

$g_crypto_master_salt     = 'rzXu8ufvW1/wFnSf4kixTdR3gSL1JsRyFI+dSIMFxqs=';

$g_path                   = 'http://192.168.1.230/mantis/';

# =========================
# Email Configuration (OVH)
# =========================
$g_phpMailer_method       = PHPMAILER_METHOD_SMTP;
$g_smtp_host              = 'ssl0.ovh.net';
$g_smtp_port              = 465;
$g_smtp_connection_mode   = 'ssl';

$g_smtp_username          = 'njie.micheline@iwomitechnologies.com';
$g_smtp_password          = 'njie.micheline';

# Email Address Settings
$g_from_email             = 'njie.micheline@iwomitechnologies.com';
$g_return_path_email      = 'njie.micheline@iwomitechnologies.com';
$g_webmaster_email        = 'njie.micheline@iwomitechnologies.com';
$g_administrator_email    = 'njie.micheline@iwomitechnologies.com';

# Sender Name
$g_from_name              = 'Mantis Bug Tracker';

# Enable Email System
$g_enable_email_notification = ON;
$g_allow_signup              = ON;
$g_send_reset_password       = ON;
$g_validate_email            = ON;

# Optional debugging
$g_email_notifications_verbose = OFF;

# Permissions
$g_permission_enable_project_create = ON;
$g_create_project_threshold = MANAGER;
$g_assign_issues_to_project_members_only = ON;
?>
