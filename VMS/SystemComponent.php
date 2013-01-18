<?php
require_once 'Constants.php';

class SystemComponent {

var $settings;

function getSettings() {

// System variables
$settings['siteDir'] = '/path/to/your/intranet/';

// Database variables
$settings['dbhost'] = 'localhost:3307';
$settings['dbusername'] = 'root';
$settings['dbpassword'] = 'password';
$settings['dbname'] = 'tvwebcity';

return $settings;

}

}
?> 