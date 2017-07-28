<?php

class UsersController extends BaseController
{
    
    public function __construct()
    {
			$this->loadModel('UsersModel');
            
	}
    
    

    
    
    /**
     * PAGE: index
     * This method handles the error page that will be shown when a page is not found
     */
      public function index()
    {
         $pageTitle = 'Manage Users';   
        // load views
        require APP . 'view/_templates/gusto_header.php';
        require APP . 'view/users/index.php';
        require APP . 'view/_templates/gusto_footer.php';
          
         
              
    }
    
    
    ////////////////////////////////////////////////////////////////////////
    // Those are the links for each pages
    ////////////////////////////////////////////////////////////////////////
    public function users()
	{
				$this->redirect('users');
		}
    public function menu()
	{
				$this->redirect('menu');
		}
    public function advmenu()
	{
				$this->redirect('advmenu');
		}
    public function statistic()
	{
				$this->redirect('statistic');
		}
    public function stock()
	{
				$this->redirect('stock');
		}
    public function liveview()
	{
				$this->redirect('liveview');
		}
    public function gusto()
	{
				$this->redirect('gusto');
		}
    
    public function getUsers($companyId){
        $users = $this->model->getUsersModel($companyId);
        
        return $users;
        
    }
    
    
    public function newUser(){
        
        $pageTitle = 'Manage Users'; 
        
        $userName = $this->filterUserInput($_POST['user-name']);
        $userPosition = $this->filterUserInput($_POST['user-position']);
        $userEmail = $this->filterUserInput($_POST['user-email']);
        $userPassword = $this->filterUserInput($_POST['user-password']);
        $userPasswordAgain = $this->filterUserInput($_POST['user-password-again']);
        $userWebAccess = $_POST['web-access'];
        $userDigitCode = $this->filterUserInput($_POST['app-code']);
        $companyId = $_POST['company-id'];
        
        if($userName==""){
            $newUserErrors[]="Please fill up the name field";
        }
        
        if($userPosition==""){
            $newUserErrors[]="Please enter the position of the new user";
        }
        
        if($userEmail==""){
            $newUserErrors[]="Please fill up the email field";
        }
        
        if($userPassword==""){
            $newUserErrors[]="Please give a password";
        }
        
        if($userPassword !== $userPasswordAgain){
            $newUserErrors[]="Passwords did not match";
        }
        
        if($userDigitCode==""){
            $newUserErrors[]="Please give a digit number to the new user";
        }
        
        if($this->checkUserExists($userName,$userPosition,$userEmail)==TRUE){
            $newUserErrors[]="This user already exists";
        }
        
        if(isset($newUserErrors)) {
            
            
            
            
                           require APP . 'view/_templates/gusto_header.php';
                           require APP . 'view/users/index.php';
                           require APP . 'view/_templates/gusto_footer.php';

            echo "<script type='text/javascript'>";
            echo "document.getElementById('add-user-modal').style.display = 'block';";
            echo "</script>";
            
            

                   }  else  {
                           $setNewUser = $this->model->addNewUser($userName,$userPosition,$userEmail,$userPassword,$userWebAccess,$userDigitCode,$companyId);
            
                        if($setNewUser=="true"){
                            getUsers();
                        }
            
                           require APP . 'view/_templates/gusto_header.php';
                           require APP . 'view/users/index.php';
                           require APP . 'view/_templates/gusto_footer.php';
            
            
            
                          
                       }

        
        
    }
    
    
    public function checkUserExists($userName,$userPosition,$userEmail){
        
        $userExists = $this->model->checkUserExistsModel($userName,$userPosition,$userEmail);
        return $userExists;
    }
    
    
    
    public function deleteUser(){
         
        $pageTitle = 'Manage Users'; 
        
        $userId = $this->filterUserInput($_POST['user-id']);
        
        $this->model->deleteUserModel($userId);
        
        require APP . 'view/_templates/gusto_header.php';
        require APP . 'view/users/index.php';
        require APP . 'view/_templates/gusto_footer.php';
        
        echo "<script>confirm('User data has been deleted')</script>";
        
    }
    
    
    public function getUserData(){
        
        $pageTitle = 'Manage Users'; 
        
        $userId = $this->filterUserInput($_POST['user-id']);
        
        $userDatas = $this->model->getUserDataModel($userId);
        
        foreach($userDatas as $userData){
            
            
            $updateUserId = $userData['user_id'];
            $updateUserName = $userData['user_name'];
            $updateUserPosition = $userData['user_position'];
            $updateUserEmail = $userData['user_email'];
            $updateUserAccess = $userData['access'];
            $updateUserAppCode = $userData['app_code'];
            
            
        }
        
        
        //$updateUserName = $userData['user_name'];
        
        
        require APP . 'view/_templates/gusto_header.php';
        require APP . 'view/users/index.php';
        require APP . 'view/_templates/gusto_footer.php';
        
        
        echo "<script type='text/javascript'>";
        echo "document.getElementById('update-user-modal').style.display = 'block';";
        echo "</script>";
        
    }
    
    
    public function updateUser(){
        
        $pageTitle = 'Update User';
        
        $userName = $_POST['update-user-name'];
        $userPosition = $_POST['update-user-position'];
        $userEmail = $_POST['update-user-email'];
        $userWebAccess = $_POST['update-web-access'];
        $userAppCode = $_POST['update-app-code'];
        $userId = $_POST['user-id'];
        
        $updateUser = $this->model->updateUserModel($userName,$userPosition,$userEmail,$userWebAccess,$userAppCode,$userId);
        
        
        require APP . 'view/_templates/gusto_header.php';
        require APP . 'view/users/index.php';
        require APP . 'view/_templates/gusto_footer.php';
        
        
        if($updateUser==true){
            echo "<script>confirm('User data has been updated')</script>";
        }else if($updateUser==false){
            echo "<script>confirm('User data has not been updated. There`s been a problem with the server')</script>";
        };
        
        
        
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