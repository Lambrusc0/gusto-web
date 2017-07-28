<?php

class AdvmenuController extends BaseController
{
    
    public function __construct()
    {
			$this->loadModel('AdvmenuModel');
            
	}
    
    

    
    
    /**
     * PAGE: index
     * This method handles the error page that will be shown when a page is not found
     */
      public function index()
    {
         $pageTitle = 'Advanced Menu';   
        // load views
        require APP . 'view/_templates/gusto_header.php';
        require APP . 'view/advmenu/index.php';
        require APP . 'view/_templates/gusto_footer.php';
              
        $this->getMenuData($_SESSION['user_session']['company_id']);
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
    
    public function getMenuData($Id){
        
        $companyData = $this->model->getMenuDataModel($Id);
        
        return $companyData;
    }
    
    public function updateMenu(){
        
        $pageTitle = 'Advanced Menu';   
        
        $updateVatNo = $_POST['VAT-number'];
        $updateServiceCharge = $_POST['service-charge'];
        $updatePhone = $_POST['phone-number'];
        $updateMessage = $_POST['bill-message'];
        $companyId = $_POST['company-id'];
        
        $updateAdvMenu = $this->model->updateMenuModel($updateVatNo,$updateServiceCharge,$updatePhone,$updateMessage,$companyId);
        
        require APP . 'view/_templates/gusto_header.php';
        require APP . 'view/advmenu/index.php';
        require APP . 'view/_templates/gusto_footer.php';
        
        if($updateAdvMenu==true){
            echo "<script>confirm('Menu data has been updated')</script>";
        }else if($updateAdvMenu==false){
            echo "<script>confirm('Menu data has NOT been updated, a problem has occured during the action')</script>";
        } else {
            echo "<script>confirm('Menu data has NOT been updated')</script>";
        }
        
    }
    
    
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