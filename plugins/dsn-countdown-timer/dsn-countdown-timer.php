<?php
  /*
  Plugin name: DSN's Countdown Timer Plugin
  Plugin URI: https://github.com/dsnutter/portfolio-sample-wordpress-countdown-timer
  Description: Displays a countdown to armageddon
  Author: DS Nutter
  Author URI: https://github.com/dsnutter
  Version: 1.0
  */

if ( ! defined( 'WPINC' ) ) {
	die;
}

define( 'DSN_COUNTDOWN_TIMER_VERSION', '1.0.0' );
define( 'DSN_PLUGIN_NAME', 'dsn_countdown_timer' );

require plugin_dir_path( __FILE__ ).'includes/dsn-countdown-timer-public-functions.php';

require plugin_dir_path( __FILE__ ).'includes/dsn-countdown-timer-admin-functions.php';

?>