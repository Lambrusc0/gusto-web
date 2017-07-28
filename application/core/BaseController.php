<?php



class BaseController
{
    # Protected property for child to assign the model.
    protected $model = null; 

    # Protected method for child to load the model
    protected function loadModel($model_name)
    {
        if (file_exists(APP . 'model/' . $model_name . '.php')) {
       
            require_once APP . 'model/' . $model_name . '.php';
            $this->model = new $model_name();          
        }   
    }


    # Only call this function once you load header.php (due to the requirement of session_start())
    # you can call this function in the child as $this->is_loggedin()
	protected function is_loggedin()
	{ 
 
		if(isset($_SESSION['user_session']))
		{
			return true;
		} else {
			return false;
		}
	}
	
	public function redirect($url)
	{
		$url = URL.$url;
		header("Location: $url");
	}

	
	public function logout($logout)
	{
		session_start();
		if(isset($logout) && $logout=="true"){
				session_destroy();
				unset($_SESSION['user_session']);
				$this->redirect('home');
				//return true;
		}
	
	}
	

  
}
?>