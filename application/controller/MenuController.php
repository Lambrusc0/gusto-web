<?php

class MenuController extends BaseController
{
    
    public function __construct()
    {
			$this->loadModel('MenuModel');
            
	}
    
    

    
    
    /**
     * PAGE: index
     * This method handles the error page that will be shown when a page is not found
     */
      public function index()
    {
         $pageTitle = 'Menu Management';   
        // load views
        require APP . 'view/_templates/gusto_header.php';
        require APP . 'view/menu/index.php';
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
    
    
    public function getCategories($companyId){
        
        $categories = $this->model->getCategoriesModel($companyId);
        
        return $categories;
        
    }
    
    public function getCategory(){
        
        $pageTitle = 'Menu Management'; 
        
        $categoryId = $this->filterUserInput($_POST['category-id']);
        
        $categoryName = $this->model->getCatgoryModel($categoryId);
        
        require APP . 'view/_templates/gusto_header.php';
        require APP . 'view/menu/index.php';
        require APP . 'view/_templates/gusto_footer.php';
        
        
        echo "<script type='text/javascript'>";
        echo "document.getElementById('modal2').style.display = 'block';";
        echo "</script>";
        
        return $categoryName;
        
    }
    
    public function updateCategory(){
        
        $pageTitle = 'Menu Management'; 
        
        $categoryId = $this->filterUserInput($_POST['category-id']);
        $categoryName = $this->filterUserInput($_POST['category-name']);
        
        $updateCategory = $this->model->updateCatgoryModel($categoryId,$categoryName);
        
        require APP . 'view/_templates/gusto_header.php';
        require APP . 'view/menu/index.php';
        require APP . 'view/_templates/gusto_footer.php';
        
        if($updateCategory==true){
            echo "<script>confirm('Category name has been updated')</script>";
        }else if($updateCategory==false){
            echo "<script>confirm('A problem has occured during the update')</script>";
        }
        
    }
    
    public function addNewItem(){
        
        $pageTitle = 'Menu Management';   
        
        $itemName = $_POST['item-name'];
        $itemPrice = $_POST['item-price'];
        $itemCategory = $_POST['item-category'];
        $itemDescription = $_POST['item-description'];
        $companyId = $_POST['company-id'];
        
        $addItem = $this->model->addNewItemModel($itemName,$itemPrice,$itemCategory,$itemDescription,$companyId);
        
        require APP . 'view/_templates/gusto_header.php';
        require APP . 'view/menu/index.php';
        require APP . 'view/_templates/gusto_footer.php';
        
        if($addItem==true){
            echo "<script>confirm('Item has been added to menu')</script>";
        }else if($addItem==false){
            echo "<script>confirm('Item has not been added to the menu, there was a problem with the database')</script>";
        }
        
    }
    
    public function getItemsCount($categoryId){
        
        $pageTitle = 'Menu Management'; 
        
        $itemsCount = $this->model->getItemsCountModel($categoryId);
        
        return $itemsCount;
        
    }
    
    
    public function getItems($categoryId){
        // This function returns all the item in the category
        
        $pageTitle = 'Menu Management'; 
        
        $items = $this->model->getItemsModel($categoryId);
        
        return $items;
        
    }
    
    public function deleteItem(){
        
        $pageTitle = 'Manage Menu'; 
        
        $itemId = $this->filterUserInput($_POST['item-id']);
        
        $deleteItem = $this->model->deleteItemModel($itemId);
        
        require APP . 'view/_templates/gusto_header.php';
        require APP . 'view/menu/index.php';
        require APP . 'view/_templates/gusto_footer.php';
        
        if($deleteItem==true){
            
            echo "<script>confirm('Menu data has been deleted')</script>";
            
        }else if($deleteItem==false){
            
            echo "<script>confirm('Menu data has NOT been deleted')</script>";
            
        } else {
            
            echo "<script>confirm('Some problem occured during the action')</script>";
            
        }
        
    }
    
    public function getItem(){
        // This function will only return one item to update it
        
        $pageTitle = 'Menu Management'; 
        
        $itemId = $this->filterUserInput($_POST['item-id']);
        
        $getItem = $this->model->getItemModel($itemId);
            
        if($getItem!=false){
            foreach($getItem as $item){
                $updateItemName = $item['item_name'];
                $updateItemPrice = $item['item_price'];
                $updateItemDescription = $item['item_description'];
                $updateItemCategory = $item['category_id'];
                $updateItemId = $item['item_id'];
            }
        }
            
        require APP . 'view/_templates/gusto_header.php';
        require APP . 'view/menu/index.php';
        require APP . 'view/_templates/gusto_footer.php';
        
        echo "<script type='text/javascript'>";
        echo "document.getElementById('modal3').style.display = 'block';";
        echo "</script>";
        
    }
    
    public function updateItem(){
        
        $pageTitle = 'Update Menu'; 
        
        $updateName = $this->filterUserInput($_POST['update-item-name']);
        $updatePrice = $this->filterUserInput($_POST['update-item-price']);
        $updateCategory = $this->filterUserInput($_POST['item-category']);
        $updateDescription = $this->filterUserInput($_POST['item-description']);
        $itemId = $_POST['item-id'];
        
        $updateItem = $this->model->updateItemModel($updateName,$updatePrice,$updateCategory,$updateDescription,$itemId);
        
        require APP . 'view/_templates/gusto_header.php';
        require APP . 'view/menu/index.php';
        require APP . 'view/_templates/gusto_footer.php';
        
        if($updateItem==true){
            echo "<script>confirm('Menu data has been updated')</script>";
        }else if($updateItem==false){
            echo "<script>confirm('Menu data has NOT been updated, a problem has occured during the action')</script>";
        } else {
            echo "<script>confirm('Menu data has NOT been updated')</script>";
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