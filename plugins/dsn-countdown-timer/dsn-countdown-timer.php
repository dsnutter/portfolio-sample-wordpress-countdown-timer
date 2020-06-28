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

// register_activation_hook( __FILE__, 'includes/dsn-countdown-timer-activation.php' );
// register_deactivation_hook( __FILE__, 'includes/dsn-countdown-timer-deactivation.php' );

// register_activation_hook( __FILE__, 'dsn-countdown-timer-activate' );
// register_deactivation_hook( __FILE__, 'dsn-countdown-timer-deactivate' );

// function dsn_countdown_timer_activate() {

// }

// function dsn_countdown_timer_deactivate() {
  
// }

function dsn_countdown_timer_css() {
	echo "
  <style type='text/css'>
    div.dsn-countdown-timer {
      color: white;
      background-color: red;
      width: 100%;
      font-weight: bold;
      font-size: 2em;
      text-align: center;
    }
	</style>
	";
}

// convert these to a class as per comments in: https://developer.wordpress.org/reference/functions/add_action/
function dsn_countdown_timer() {
  echo "
    <div class='dsn-countdown-timer'>
      Armageddon Countdown Timer:<br />
      <span id='dsn-countdown-timer'>&nbsp;</span>
    </div>
  ";
}

wp_enqueue_script('momentjs', plugin_dir_url(__FILE__) . '/assets/js/moment.js');
//wp_enqueue_script('momentjs-tz', plugin_dir_url(__FILE__) . '/assets/js/moment-timezone.js');
wp_enqueue_script('dsnCountdownTimer', plugin_dir_url(__FILE__) . '/assets/js/dsnCountdownTimer.js');
add_action( 'wp_head', 'dsn_countdown_timer_css' );
add_action( 'wp_body_open', 'dsn_countdown_timer' );

?>