###################
Deploy
###################

1. Upload files to Home /public_html/app
2. Apply database migrations to deangelomotors-app in phpmyAdmin
3. Change application/config/config.php as:
    $config['base_url'] = 'http://www.deangelomotors.com/app';
4. Change application/config/database.php as:
    $active_group = 'default';
5. Change application/config/authorize_net.php with correct api keys
6. Change application/config/email.php with correct mandrill api keys
