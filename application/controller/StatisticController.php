<?php

class StatisticController extends BaseController
{
    
    public function __construct()
    {
			$this->loadModel('StatisticModel');
            
	}
    
    

    
    
    /**
     * PAGE: index
     * This method handles the error page that will be shown when a page is not found
     */
      public function index()
    {
         $pageTitle = 'Statistic Menu';   
        // load views
        require APP . 'view/_templates/gusto_header.php';
        require APP . 'view/statistic/index.php';
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
    
    
}

?>