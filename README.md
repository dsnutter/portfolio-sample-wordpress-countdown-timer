# portfolio-sample-wordpress-countdown-timer

Countdown timer plugin for wordpress

# to test your YAML configuration
docker-compose -f docker-compose.yaml config

# to start wordpress and mysql via the YAML file
docker-compose up -d

# to stop the containers specified by the YAML file
docker-compose stop

# for interactive shell
docker exec -it dsn-wp bash

# for custom wp-config.php file for enabling debugging, etc
docker cp wp-config.php dsn-wp:/var/www/html/wp-config.php

![Frontend Display](https://dsnutter.github.io/assets/images/screenshots/Wordpress-Countdown-Timer-Frontend.png)

![Administration Area Settings](https://dsnutter.github.io/assets/images/screenshots/Wordpress-Countdown-Timer-Plugin-Admin.png)
