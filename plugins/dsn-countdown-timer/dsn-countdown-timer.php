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
define( 'DSN_SECTION_NAME_SETTINGS', 'dsn_countdown_timer_settings' ); 
define( 'DSN_TIMER_OPTIONS', 'dsn_countdown_timer_options' );

// register_activation_hook( __FILE__, 'includes/dsn-countdown-timer-activation.php' );
// register_deactivation_hook( __FILE__, 'includes/dsn-countdown-timer-deactivation.php' );

// register_activation_hook( __FILE__, 'dsn-countdown-timer-activate' );
// register_deactivation_hook( __FILE__, 'dsn-countdown-timer-deactivate' );

// function dsn_countdown_timer_activate() {

// }

// function dsn_countdown_timer_deactivate() {
  
// }

// convert these to a class as per comments in: https://developer.wordpress.org/reference/functions/add_action/
function dsn_countdown_timer() {
  echo "
    <div class='dsn-countdown-timer'>
      Armageddon Countdown Timer:<br />
      <span id='dsn-countdown-timer'>&nbsp;</span>
    </div>
  ";
}

function add_countdown_timer_settings_admin_menu() {
  $page = add_menu_page(  DSN_PLUGIN_NAME, 'Countdown Timer', 'administrator', DSN_PLUGIN_NAME, 'displayCountdownTimerAdminDashboard', '', 26 );
  // include the plugin admin settings flatpickr JS & CSS only on this plugin's setting page
  add_action('admin_print_scripts-' . $page, 'dsn_countdown_timer_admin_flatpickr');
  add_action('in_admin_footer', 'dsn_countdown_timer_admin_flatpickr_call');
}

function displayCountdownTimerAdminDashboard() {
  require plugin_dir_path( __FILE__ ).'/includes/dsn-countdown-timer-admin-settings.php';
}

function displayCountdownTimerAdminSettings() {
  // // set this var to be used in the settings-display view
  // $active_tab = isset( $_GET[ 'tab' ] ) ? $_GET[ 'tab' ] : 'general';
  // if(isset($_GET['error_message'])){
  //     add_action('admin_notices', 'countdownTimerSettingsMessages');
  //     do_action( 'admin_notices', $_GET['error_message'] );
  // }
  // require_once 'partials/'.DSN_PLUGIN_NAME.'-admin-settings-display.php';
}

function countdownTimerSettingsMessages() {
  // switch ($error_message) {
  //   case '1':
  //       $message = __( 'There was an error adding this setting. Please try again.  If this persists, shoot us an email.', 'my-text-domain' );                 
  //       $err_code = esc_attr( 'plugin_name_example_setting' );                 
  //       $setting_field = 'plugin_name_example_setting';                 
  //       break;
  // }
  // $type = 'error';
  // add_settings_error(
  //       $setting_field,
  //       $err_code,
  //       $message,
  //       $type
  //   );
}

function dsn_countdown_timer_register_settings() {
  $optionArgs = array(
    'type' => 'string', 
    //'sanitize_callback' => 'sanitize_target',
    'default' => strtotime("+2 days"),
  );            
  register_setting( DSN_TIMER_OPTIONS, DSN_TIMER_OPTIONS, $optionArgs );

  add_settings_section( DSN_SECTION_NAME_SETTINGS, 'Countdown Timer Settings', 'dsn_countdown_timer_settings_section_display', DSN_PLUGIN_NAME );
  add_settings_field( 'dsn_countdown_timer_setting_target', 'Armageddon Date', 'dsn_countdown_timer_setting_target', DSN_PLUGIN_NAME, DSN_SECTION_NAME_SETTINGS );
}

function dsn_countdown_timer_settings_section_display() {
  echo "
    <p>Choose a target armageddon date and time [from tomorrow to sometime within the next year]:</p>
  ";
}

function dsn_countdown_timer_setting_target() {
  $optionsName = DSN_TIMER_OPTIONS;
  $optionsVarName = 'target';

  $options = get_option( $optionsName );
  $value = esc_attr( $options[$optionsVarName] );

  echo "<input id='dsn_countdown_timer_setting_target' 
              name='{$optionsName}[{$optionsVarName}]' 
              type='text' 
              value='{$value}' 
              placeholder='Select Target Date/Time...'
              data-input
        />";
}

function dsn_countdown_timer_enqueue() {
  wp_enqueue_script('momentjs', plugin_dir_url(__FILE__) . '/assets/js/moment.js');
  //wp_enqueue_script('momentjs-tz', plugin_dir_url(__FILE__) . '/assets/js/moment-timezone.js');
  wp_enqueue_script('dsnCountdownTimer', plugin_dir_url(__FILE__) . '/assets/js/dsnCountdownTimer.js');
  
  wp_enqueue_style( 'dsnCountdownTimer', plugin_dir_url( __FILE__ ) . '/assets/css/dsnCountdownTimer.css' );  
}

function dsn_countdown_timer_admin_flatpickr() {
  echo "

    <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css'>
    <script src='https://cdn.jsdelivr.net/npm/flatpickr'></script>

  ";
}

function dsn_countdown_timer_admin_flatpickr_call() {
  echo "
  
  <script type='text/javascript'>
    const args = {
          // from tomorrow to a year in the future
          minDate: new Date().fp_incr(1),
          maxDate: new Date().fp_incr(365),
          enableTime: true,
          dateFormat: 'Y-m-d h:i K',
    };
    const fp = flatpickr('#dsn_countdown_timer_setting_target', args);
  </script>

  ";
}

add_action('wp_enqueue_scripts', 'dsn_countdown_timer_enqueue');

add_action( 'wp_body_open', 'dsn_countdown_timer' );

add_action( 'admin_init', 'dsn_countdown_timer_register_settings' );

add_action( 'admin_menu', 'add_countdown_timer_settings_admin_menu' );

?>