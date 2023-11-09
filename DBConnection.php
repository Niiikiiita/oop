<?php
if(!isset($_SESSION))
{
    session_start();
}
//URL, die abhängig von allen Situationen dieselbe Basis-URL für jede Datei im Strukturbaum bereitstellt,
// z. B. http:// oder https://
$root = "http://" . $_SERVER['HTTP_HOST'];
$root .= str_replace(basename($_SERVER['SCRIPT_NAME']), "", $_SERVER['SCRIPT_NAME']);
$constants['base_url'] = $root;
define('DB_SERVER', '127.0.0.1');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', 'root');
define('DB_DATABASE', 'bestellungen');
define('DB_PORT', '8889');

define('SITE_URL', $constants['base_url']);
define('HTTP_BOOTSTRAP_PATH', $constants['base_url'] . 'assets/vendor/');
define('HTTP_CSS_PATH', $constants['base_url'] . 'assets/css/');
define('HTTP_JS_PATH', $constants['base_url'] . 'assets/js/');

class DBConnection {
    private $_con;
    function __construct(){
        $this->_con = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD,DB_DATABASE, DB_PORT);
        if ($this->_con->connect_error) die('Database error -> ' . $this->_con->connect_error);
    }
    // verbindung returnen
    function returnConnection() {
        return $this->_con;
    }
}
?>