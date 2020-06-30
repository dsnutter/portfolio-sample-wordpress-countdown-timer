<?php

add_action('wp_enqueue_scripts', 'dsn_countdown_timer_enqueue');
add_action( 'wp_body_open', 'dsn_countdown_timer' );

function dsn_countdown_timer() {
  echo "
    <div class='dsn-countdown-timer'>
      Armageddon Countdown Timer:<br />
      <span id='dsn-countdown-timer'>&nbsp;</span>
    </div>
  ";
}

function dsn_countdown_timer_enqueue() {
  wp_enqueue_script('momentjs', plugin_dir_url(__FILE__) . '../assets/js/moment.js');
  //wp_enqueue_script('momentjs-tz', plugin_dir_url(__FILE__) . '/assets/js/moment-timezone.js');
  wp_enqueue_script('dsnCountdownTimer', plugin_dir_url(__FILE__) . '../assets/js/dsnCountdownTimer.js');
  
  wp_enqueue_style( 'dsnCountdownTimer', plugin_dir_url( __FILE__ ) . '../assets/css/dsnCountdownTimer.css' );  
}

?>