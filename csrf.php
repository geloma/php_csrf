<?php

	class CSRF{
		/* Constructor */
		public function __construct(){
			
		}
		
		/* Generate token */
		function generate(){
			$token = hash('sha256', openssl_random_pseudo_bytes (8));
			$_SESSION[$token] = date("H:i:s");
			return $token;
			
		}
		/* Check if given token exist in session var */
		function check(){
			if(isset($_SESSION)){
				if(!isset($_POST["csrf"])) return FALSE;
				$token = $this->filter($_POST["csrf"]);
				if(!isset($_SESSION[$token])) return FALSE;
				$now = date("H:i:s");
				$difference = abs(strtotime($_SESSION[$token]) - strtotime($now)); // diferencia en segundos
				if($difference > 20*60){ // 20 minutos * 60 segundos
					unset($_SESSION[$token]);
					return FALSE;
				} 
				return TRUE;
			}else{
				return FALSE;
			}
		}
		/* Clean token from session */
		function clean(){
			if(isset($_SESSION)){
				if(isset($_POST["csrf"])){
					$token = $this->filter	($_POST["csrf"]);
					if(isset($_SESSION[$token])){
						unset($_SESSION[$token]);
					}
				}
			}
		}
		/* Simple input filter */
		public function filter($input, $size = NULL){
			if($input === NULL || is_array($input) === TRUE) return "";
			$input = strip_tags($input);
			$input = htmlspecialchars ($input);
			$input = filter_var($input, FILTER_SANITIZE_STRING);
			$input = trim($input);
			if(!$size) {
				return $input;
			}else {
				return rtrim((strlen($input) > $size)? substr($input,0,$size): $input);
			}
		}
	}

?>
