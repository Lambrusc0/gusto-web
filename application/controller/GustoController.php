<?php 



class GustoController extends BaseController
{
    
    public function __construct()
    {
			$this->loadModel('GustoModel');
            
	}
    
    

    
    
    /**
     * PAGE: index
     * This method handles the error page that will be shown when a page is not found
     */
      public function index()
    {
         $pageTitle = 'Gusto PoS';   
        // load views
        require APP . 'view/_templates/gusto_header.php';
        require APP . 'view/gusto/index.php';
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
	
	public function notLoggedIn(){
        $this->redirect('home');
    }
    
    
}


?>