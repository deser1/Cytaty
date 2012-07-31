<?php
class Session {
	private $sid;
	private $count;
	protected function __construct(){
		session_start();
		$this->count +=1;
		$this->sid = session_id;//md5(uniqid(rand(), true));
		if (!setcookie('sid',$this->sid, null, "/")){
			setcookie('sid',$this->sid, time()+3600, "/");
		}
	}

	public function sesid(){
		return $this->sid;
	}

	public function sesvar(){
		$var = '';
		foreach ($_SESSION as $key => $val){
			$var .= "SESSION var '{$key}' :\t '{$val}'\n";
		}
		return $var;
	}

	public function sescount(){
		return $this->count;
	}

	public function exist($var){
		if (version_compare(PHP_VERSION, '5.3.0', '<')) {
			return session_is_registered($var);
		}else{
			if (isset($_SESSION[$var])){
				return true;
			}else{
				return false;
			}
		}
	}

	public function expire(){
		if (!setcookie('sid',$this->sid, time()-3600, "/")){
			return false;
		}
		return true;
	}

	public function pop($var){
		if (version_compare(PHP_VERSION, '5.3.0', '<')) {
			return session_unregister($var);
		}else{
			unset($_SESSION[$var]);
			return true;
		}
	}

	public function destroy(){
		session_destroy();
		$_COOKIE = array();
		$this->count = 0;
	}
}
?>
