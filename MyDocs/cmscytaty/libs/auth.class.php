<?php
class Auth(){
	private $config = array();
	private $user = array();
	private $cookie = array();
	public function __construct(){
            require_once('libs/settings.class.php');
            $setting = new Settings();
            $config = $setting.Value();
	}
}
?>
