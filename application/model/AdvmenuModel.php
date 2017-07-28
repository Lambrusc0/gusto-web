<?php 

class AdvmenuModel extends BaseModel{
    
    
    public function getMenuDataModel($Id){
        
        $stmt = $this->db->prepare("SELECT * FROM advenced_settings WHERE company_id=:id");
        $selectMenuData = $stmt->execute(array(':id'=>$Id));
        
        $selectMenuData = $stmt->fetchALL(PDO::FETCH_ASSOC);
        
        if($selectMenuData){
            return $selectMenuData;
        }else{
            return false;
        }
    }
    
    public function updateMenuModel($updateVatNo,$updateServiceCharge,$updatePhone,$updateMessage,$companyId){
        
        $stmt = $this->db->prepare("UPDATE advenced_settings SET VAT_number=:VAT_number, service_charge=:service_charge, phone=:phone, message=:message WHERE company_id=:company_id");
        $stmt->execute(array(':VAT_number'=>$updateVatNo,
                             ':service_charge'=>$updateServiceCharge,
                             ':phone'=>$updatePhone,
                             ':message'=>$updateMessage,
                             ':company_id'=>$companyId
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