<?php 

class UsersModel extends BaseModel{
    
    
    
    public function getUsersModel($companyId){
        
        
			$stmt = $this->db->prepare("SELECT * FROM users WHERE company_id=:company_id");
			$stmt->execute(array(':company_id'=>$companyId));
			$users = $stmt->fetchALL(PDO::FETCH_ASSOC);
							
						
		try {	
						
			if($stmt->rowCount() >= 1)
			{       
				return $users;	
			} else if($stmt->rowCount() == 0) {
                $users = "";
				return $users;
			}else{
                return false;
            }

		} catch(PDOException $e) {
				echo $e->getMessage();
			}
        
    }
    
    
    public function addNewUser($userName,$userPosition,$userEmail,$userPassword,$userWebAccess,$userDigitCode,$companyId){
        try
            {	

                $userPassword = sha1($userPassword);
                
                $stmt = $this->db->prepare("INSERT INTO users(company_id, user_email, user_password, user_name, access, user_position, app_code) 
                                                           VALUES(:company_id, :user_email, :user_password,:user_name,:access,:user_position,:app_code)");

                $stmt->execute(array(':company_id'=>$companyId,
                                     ':user_email'=>$userEmail,
                                     ':user_password'=>$userPassword,
                                     ':user_name'=> $userName,
                                     ':access'=> $userWebAccess,
                                     ':user_position'=> $userPosition,
                                     ':app_code'=>$userDigitCode));	
                //$stmt->fetch(PDO::FETCH_ASSOC);
            
            //return "true";
                
            } catch(PDOException $e) {
                echo $e->getMessage();
            }
    }
    
    
    public function checkUserExistsModel($userName,$userPosition,$userEmail){
        
        $stmt = $this->db->prepare("SELECT * FROM users WHERE user_name=:name AND user_email=:email AND user_position=:position");
        $stmt->execute(array(':name'=>$userName,
                             ':email'=>$userEmail,
                             ':position'=>$userPosition));
        $stmt->fetchALL(PDO::FETCH_ASSOC);
							
						
		try {	
						
			if($stmt->rowCount() >= 1)
			{       
				return TRUE;	
			} else{
                return FALSE;
            }

		} catch(PDOException $e) {
				echo $e->getMessage();
			}
        
    }
    
    
    public function deleteUserModel($userId){
        
        
        $stmt = $this->db->prepare("DELETE FROM users WHERE user_id=:user_id");
        $stmt->execute(array(':user_id'=>$userId));
        
        
    }
    
    
    public function getUserDataModel($userId){
        
        
        $stmt = $this->db->prepare("SELECT * FROM users WHERE user_id=:user_id");
        $stmt->execute(array(':user_id'=>$userId));
        
        $userData = $stmt->fetchALL(PDO::FETCH_ASSOC);
        
        try {	
						
			if($stmt->rowCount() >= 1)
			{       
				return $userData;	
			}else{
                return false;
            }

		} catch(PDOException $e) {
				echo $e->getMessage();
			}
        
    }
    
    
    public function updateUserModel($userName,$userPosition,$userEmail,$userWebAccess,$userAppCode,$userId){
        
        $stmt = $this->db->prepare("UPDATE users SET user_email=:email, user_name=:name, access=:access, user_position=:position, app_code=:code WHERE user_id=:user_id");
        $stmt->execute(array(':email'=>$userEmail,
                             ':name'=>$userName,
                             ':access'=>$userWebAccess,
                             ':position'=>$userPosition,
                             'code'=>$userAppCode,
                             'user_id'=>$userId
                            ));
        
        try {	
						
			if($stmt->rowCount() >= 1)
			{       
				return true;	
			}else{
                return false;
            }

		} catch(PDOException $e) {
				echo $e->getMessage(); 
			}
        
    }
    
    
    
}

?>