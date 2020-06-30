<div class="wrap">
    <form method="POST" action="options.php">  
        <?php 
            settings_fields( 'dsn_countdown_timer_options' );
            do_settings_sections( DSN_PLUGIN_NAME ); 
        ?>             
        <?php submit_button(); ?>  
    </form> 
</div>
