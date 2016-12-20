<?php

class getUrl{

	function __construct(){
		$this->keyView = 2;
		$this->param = explode('/', $_SERVER['REQUEST_URI']);
		$this->actionExist = false;
		print_r($this->param);
		$this->options =  array('extension' => '.html');
		$this->m = new Mustache_Engine(array(
		      'loader' => new Mustache_Loader_FilesystemLoader('template/themeA', $this->options),
		  ));
	}
	
	public function get($action = null, $key = null){
		if(!is_null($action)){
			if(!is_null($key)){
				$key = $key;
			}
			else{
				$key = $this->keyView;
			}

			if($this->param[$key] == $action){
				
				$this->actionExist = true;
				return true;
			}
			else{
				$this->actionExist = false;
				return false;
			}
		}
	}

	public function loadHeader($text){
		echo $this->m->render('header', $text);		
	}
	
	public function loadTemplate($text = "inconnu"){
		echo $this->m->render($text);
		echo $this->m->render('footer');
	}
	

}

?>