<?php

define( 'DSN_SECTION_NAME_SETTINGS', 'dsn_countdown_timer_settings' ); 

add_action( 'admin_init', 'dsn_countdown_timer_register_settings' );
add_action( 'admin_menu', 'add_countdown_timer_settings_admin_menu' );

function add_countdown_timer_settings_admin_menu() {
  $page = add_menu_page(  DSN_PLUGIN_NAME, 'Countdown Timer', 'administrator', DSN_PLUGIN_NAME, 'displayCountdownTimerAdminDashboard', '', 26 );
  // include the plugin admin settings flatpickr JS & CSS only on this plugin's setting page
  add_action('admin_print_scripts-' . $page, 'dsn_countdown_timer_admin_flatpickr');
  add_action('admin_print_footer_scripts-' . $page, 'dsn_countdown_timer_admin_flatpickr_call');
}

function displayCountdownTimerAdminDashboard() {
  require plugin_dir_path( __FILE__ ).'dsn-countdown-timer-admin-settings.php';
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
  $optionsVarName = DSN_TIMER_ARMAGEDDON_DATE_VAR_NAME;

  $value = get_armageddon_date();

  echo "<input id='dsn_countdown_timer_setting_target' 
              name='{$optionsName}[{$optionsVarName}]' 
              type='text' 
              value='{$value}' 
              placeholder='Select Target Date/Time...'
              readonly
        />";
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
            dateFormat: 'Y-m-d H:i',
      };
      const fp = flatpickr('#dsn_countdown_timer_setting_target', args);
    </script>
  
    ";
}
  
?>