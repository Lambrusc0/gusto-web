<?php 

class MenuModel extends BaseModel{
    
    
    public function getCategoriesModel($companyId){
        
        //return "hello";
        
        $stmt = $this->db->prepare("SELECT * FROM category WHERE company_id=:company_id");
        $stmt->execute(array(':company_id'=>$companyId));
        $categories = $stmt->fetchALL(PDO::FETCH_ASSOC);
							
						
		try {	
						
			if($stmt->rowCount() >= 1)
			{       
				return $categories;	
			} else{
                return false;
            }

		} catch(PDOException $e) {
				echo $e->getMessage();
			}
        
        
    }
    
    
    public function addNewItemModel($itemName,$itemPrice,$itemCategory,$itemDescription,$companyId){
        
        $stmt = $this->db->prepare("INSERT INTO item(category_id,company_id,item_name,item_price,item_description)
                                            VALUES(:category_id,:company_id,:item_name,:item_price,:item_description)");
        $stmt->execute(array(':category_id'=>$itemCategory,
                             ':company_id'=>$companyId,
                            ':item_name'=>$itemName,
                            ':item_price'=>$itemPrice,
                            ':item_description'=>$itemDescription));
        
        try {	
						
			if($stmt->rowCount() >= 1)
			{       
				return true;	
			} else{
                return false;
            }

		} catch(PDOException $e) {
				echo $e->getMessage();
			}
        
    }
    
    public function getItemsCountModel($categoryId){
        
        $stmt = $this->db->prepare("SELECT * FROM item WHERE category_id=:category_id");
        $stmt->execute(array(':category_id'=>$categoryId));
        $numberOfItems = $stmt->fetchALL(PDO::FETCH_ASSOC);
        
        return $stmt->rowCount();
        
    }
    
    public function getItemsModel($categoryId){
        
        $stmt = $this->db->prepare("SELECT * FROM item WHERE category_id=:category_id");
        $stmt->execute(array(':category_id'=>$categoryId));
        
        $items = $stmt->fetchALL(PDO::FETCH_ASSOC);
        
        return $items;
        
    }
    
    
    public function deleteItemModel($itemId){
        
        $stmt = $this->db->prepare("DELETE FROM item WHERE item_id=:item_id");
        $deleteItem = $stmt->execute(array(':item_id'=>$itemId));
        
        if($deleteItem){
            return true;
        }else{
            return false;
        }
        
    }
    
    public function getCatgoryModel($categoryId){
        
        $stmt = $this->db->prepare("SELECT * FROM category WHERE category_id=:category_id");
        $stmt->execute(array(':category_id'=>$categoryId));
        $categoryName = $stmt->fetchALL(PDO::FETCH_ASSOC);
        
        if($categoryName){
            return $categoryName;
        }else{
            return "something bad happened";
        }
        
    }
    
    public function updateCatgoryModel($categoryId,$categoryName){
        
        $stmt = $this->db->prepare("UPDATE category SET category_name=:category_name WHERE category_id=:category_id");
        $stmt->execute(array(':category_name'=>$categoryName,
                             ':category_id'=>$categoryId));
        
        
        try {	
						
			if($stmt->rowCount() >= 1)
			{       
				return true;	
			} else{
                return false;
            }

		} catch(PDOException $e) {
				echo $e->getMessage();
			}
        
    }
    
    public function getItemModel($itemId){
        
        $stmt = $this->db->prepare("SELECT * FROM item WHERE item_id=:item_id");
        $selectItem = $stmt->execute(array(':item_id'=>$itemId));
        
        $selectItem = $stmt->fetchALL(PDO::FETCH_ASSOC);
        
        if($selectItem){
            return $selectItem;
        }else{
            return false;
        }
        
    }
    
    public function updateItemModel($updateName,$updatePrice,$updateCategory,$updateDescription,$itemId){
        
        $stmt = $this->db->prepare("UPDATE item SET category_id=:category_id, item_name=:item_name, item_price=:item_price, item_description=:item_description WHERE item_id=:item_id");
        $stmt->execute(array(':category_id'=>$updateCategory,
                             ':item_name'=>$updateName,
                             ':item_price'=>$updatePrice,
                             ':item_description'=>$updateDescription,
                             ':item_id'=>$itemId
                            ));
        
        try {	
						
			if($stmt->rowCount() == 1)
			{       
				return true;	
			} else{
                return false;
            }

		} catch(PDOException $e) {
				echo $e->getMessage();
			}
        
    }
    
    
    
}

?>