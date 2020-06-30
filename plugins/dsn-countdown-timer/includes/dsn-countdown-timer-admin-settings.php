<div class="wrap">
    <form method="POST" action="options.php">  
        <?php 
            settings_fields( 'dsn_countdown_timer_options' );
            do_settings_sections( DSN_PLUGIN_NAME ); 

            // add_settings_section( 'dsn_countdown_timer_settings', 'Countdown Timer Settings', 'dsn_countdown_timer_section_text', 'dsn_countdown_timer' );
          
            // add_settings_field( 'dsn_countdown_timer_setting_target', 'Armageddon Date', 'dsn_countdown_timer_setting_target', 'dsn_countdown_timer', 'dsn_countdown_timer_settings' );
        ?>             
        <?php submit_button(); ?>  
    </form> 
</div>
