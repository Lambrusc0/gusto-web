<?php 

class RegisterController extends BaseController{
    
    
    public function __construct()
    {
        
			$this->loadModel('RegisterModel');
            

	}
    
    
    public function signup()
    {
        $pageTitle = 'Gusto';

		 if(isset($_POST['register'])){
               $error = $this->validateRegister();
                
        } 
                require APP . 'view/_templates/home_header.php';
                require APP . 'view/home/index.php';
                require APP . 'view/_templates/home_footer.php';
        
        echo "<script type='text/javascript'>";
        echo "document.getElementById('signup-modal').style.display = 'block';";
        echo "</script>";


	}
    
    // This function is to register the data from the registration form
    public function validateRegister(){
        
        $error = "";
        
        $companyName = $this->filterUserInput($_POST['companyName']);
        $userName = $this->filterUserInput($_POST['userName']);
        $userEmail = $this->filterUserInput($_POST['userEmail']);
        $password = $this->filterUserInput($_POST['password']);
        $passwordAgain = $this->filterUserInput($_POST['passwordAgain']);
        
        $passLength = strlen($password);
        
        if($companyName == ""){
            $error[] = "Please give us the name of your company";
        } else if($this->model->checkCompanyExists($companyName)){
            $error[] = "This company is already registered";
        }
        
        if($userName == ""){
            $error[] = "Please give us your name";
        }
        
        if($userEmail=="")	{
            $error[] = "Please enter email !";
        }else if(!filter_var($userEmail, FILTER_VALIDATE_EMAIL))	{
            $error[] = "Please enter a valid email address !";
        }else if($this->model->checkEmailExists($userEmail)){
            $error[] = "This email address is already registered";
        }
        
        if($password == "" ){
            $error[] = "Please set up a password";
        } else if ($passLength < 8){
            $error[] = "Password has to be at least 8 caracter long";
        }
        
        if ($passwordAgain !== $password){
            $error[] = "Password did not match";
        }
        
        if($error !== ""){
				return $error;
			} else {
				
                $this->model->register($companyName, $userName, $userEmail, $password);
                $companyId = $this->model->getCompanyId($companyName);
                session_start();
		        $_SESSION['user_session']['user_name'] = $userName;
                $_SESSION['user_session']['company_id'] = $companyId;
                $_SESSION['user_session']['company_name'] = $companyName;
		        $this->redirect('gusto');
                
			}
        
    }
    
    
    
    public function login()
    {
        $pageTitle = 'Login';
        
        if(isset($_POST['login'])){

               $errors = $this->validateLogin();
        }
    
                require APP . 'view/_templates/home_header.php';
                require APP . 'view/home/index.php';
                require APP . 'view/_templates/home_footer.php';
         
        echo "<script type='text/javascript'>";
        echo "document.getElementById('login-modal').style.display = 'block';";
        echo "</script>";
    

    }
    
    
    public function validateLogin(){
            
            $loginCompanyId = $this->filterUserInput($_POST['loginCompanyId']);
			$loginUserName  =  $this->filterUserInput($_POST['loginUserName']);
			$loginPassword =  $this->filterUserInput($_POST['loginPassword']);

            
        
        
                if($loginCompanyId == ""){
                    $errors[] = "Please type your company ID number";
                }    
        
				if($loginUserName=="" )	{
					$errors[] = "Please enter your name !";

				} 
				if($loginPassword=="")	{
					$errors[] = "Please enter your password !";

					} else if(!$this->model->doLogin($loginCompanyId,$loginUserName,$loginPassword)){

						$errors[] = "Sorry invalid Login details !";

                    }
        
        $access = $this->model->userAccessModel($loginCompanyId,$loginUserName,$loginPassword);
        
                if($access==false){
                    $errors[] = "You do not have access to the web administration";
                }
                

        if(isset($errors)){
            return $errors;
        } else {
        
                session_start();
            
                $companyName = $this->model->getCompanyName($loginCompanyId);
            
		        $_SESSION['user_session']['user_name'] = $loginUserName;
                $_SESSION['user_session']['company_id'] = $loginCompanyId;
                $_SESSION['user_session']['company_name'] = $companyName;
                //   print_r($_SESSION['user_session'] );
                $this->redirect('gusto');
	   }

}
    
    
    
    
   // This function is to filter all the input come from the form
    public function filterUserInput($data) {

		// trim() function will remove whitespace from the beginning and end of string.
		$data = trim($data);

		// Strip HTML and PHP tags from a string
		$data = strip_tags($data);

		/* The stripslashes() function removes backslashes added by the addslashes() function.
			Tip: This function can be used to clean up data retrieved from a database or from an HTML form.*/
		$data = stripslashes($data);

		// htmlspecialchars() function converts special characters to HTML entities. Say '&' (ampersand) becomes '&amp;'
		$data = htmlspecialchars($data);
		return $data;

	} # End of filter_user_input function
    
    
}

?>