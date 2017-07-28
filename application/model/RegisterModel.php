<?php 



class RegisterModel extends BaseModel{
    
    
    public function register($companyName, $userName, $userEmail, $password)
        {
            try
            {	

                $password = sha1($password);
                
                $stmt = $this->db->prepare("INSERT INTO company(company_name, u_pass, u_email) 
                                                           VALUES(:company_name, :u_pass, :u_email)");

                $stmt->execute(array(':company_name'=>$companyName,
                                     ':u_email'=>$userEmail,
                                     ':u_pass'=>$password));	
                
                
                $companyId = $this->db->lastInsertId();
                
                
                $sql = $this->db->prepare("INSERT INTO users(company_id, user_email, user_password, user_name) 
                                                           VALUES(:company_id, :user_email, :user_password, :user_name)");

                $sql->execute(array(':company_id'=>$companyId,
                                     ':user_email'=>$userEmail,
                                     ':user_password'=>$password,
                                     ':user_name'=>$userName));
                
                $categories = $this->db->prepare("INSERT INTO category(company_id, category_name, category_number)
                                                        VALUES(:company_id, 'FOOD', 1),(:company_id, 'DRINK', 2),(:company_id, 'COFFEE', 3),(:company_id, 'ALCOHOL', 4)");
                
                $categories->execute(array(':company_id'=>$companyId));
                
                $advencedSettings = $this->db->prepare("INSERT INTO advenced_settings(company_id)
                                                        VALUES(:company_id)");
                
                $advencedSettings->execute(array(':company_id'=>$companyId));
                
                
            } catch(PDOException $e) {
                echo $e->getMessage();
            }				
        } 
    
    
    public function checkEmailExists($userEmail){
	   try {
			$stmt = $this->db->prepare("SELECT user_email FROM users WHERE user_email=:email");
			$stmt->execute(array(':email'=>$userEmail));
			$row = $stmt->fetch(PDO::FETCH_ASSOC);
							
						
			if($row['user_email']==$userEmail) {
			return true;
			} else {
				return false;
			}

	   } catch(PDOException $e) {
			echo $e->getMessage();
		}

   }
    
    
    
    public function checkCompanyExists($companyName){
        try {
			$stmt = $this->db->prepare("SELECT company_name FROM company WHERE company_name=:company_name");
			$stmt->execute(array(':company_name'=>$companyName));
			$row = $stmt->fetch(PDO::FETCH_ASSOC);
							
						
			if($row['company_name']==$companyName) {
			return true;
			} else {
				return false;
			}

	   } catch(PDOException $e) {
			echo $e->getMessage();
		}
    }
     
    
    
    public function doLogin($loginCompanyId,$loginUserName,$loginPassword)
	   {
		    $loginPassword = sha1($loginPassword);
			$stmt = $this->db->prepare("SELECT * FROM users WHERE user_name=:user_name AND user_password =:password AND company_id=:company_id");
			$stmt->execute(array(':user_name'=>$loginUserName, 
                                 ':password'=>$loginPassword,
                                 ':company_id'=>$loginCompanyId));
			
			$userDetails = $stmt->fetch(PDO::FETCH_ASSOC);
		      
            
            
		try {	
						
			if($stmt->rowCount() == 1)
			{       
				return $userDetails;	
			} else {
				return false;
			}

		} catch(PDOException $e) {
				echo $e->getMessage();
			}

    }
    
    public function getCompanyId($companyName){
        $stmt = $this->db->prepare("SELECT company_id FROM company WHERE company_name=:company_name");
        $stmt->execute(array(':company_name'=>$companyName));
        
        $companyId = $stmt->fetch(PDO::FETCH_ASSOC);
        $companyId = implode(' ',$companyId);
        
        try {	
						
			if($stmt->rowCount() == 1)
			{       
				return $companyId;	
			} else {
				return false;
			}

		} catch(PDOException $e) {
				echo $e->getMessage();
			}
    }
    
    public function getCompanyName($loginCompanyId){
        $stmt = $this->db->prepare("SELECT company_name FROM company WHERE company_id=:company_id");
        $stmt->execute(array(':company_id'=>$loginCompanyId));
        
        $companyName = $stmt->fetch(PDO::FETCH_ASSOC);
        $companyName = implode(' ',$companyName);
        
        
        try {	
						
			if($stmt->rowCount() == 1)
			{       
				return $companyName;	
			} else {
				return false;
			}

		} catch(PDOException $e) {
				echo $e->getMessage();
			}
    }
    
    
    public function userAccessModel($loginCompanyId,$loginUserName,$loginPassword){
        
        $password = sha1($loginPassword);
        
        $stmt = $this->db->prepare("SELECT access FROM users WHERE company_id=:company_id AND user_password =:password AND user_name=:user_name");
        $stmt->execute(array(':user_name'=>$loginUserName, 
                                 ':password'=>$password,
                                 ':company_id'=>$loginCompanyId));
			
        $access = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if($access['access']==2){
            return true;
        }else if($access['access']==3){
            return false;
        }else if($access['access']==1){
            return "admin";
        }
        
    
			
        
    }
    
    
}

?>