###################
Deploy
###################

1. Upload files to Home /public_html/app
2. Apply database migrations to deangelomotors-app in phpmyAdmin
3. Change application/config/config.php as:
    $config['base_url'] = 'http://www.deangelomotors.com/app';
4. Change application/config/database.php as:
    $active_group = 'default';
