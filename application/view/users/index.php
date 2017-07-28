
        
                <div id="display">
                    
                    
                    

                    <h1>Users Management Options</h1>

                    <div id="page1">
                        <table id="users-table">
                            <tr>
                                <th>User name</th>
                                <th>User email</th>
                                <th>User position</th>
                                <th>Application code</th>
                                <th>Edit</th>
                                <th>Delete</th>
                            </tr>
                            <?php 


                                $users = $this->getUsers($_SESSION['user_session']['company_id']);

                                foreach($users as $user){

                                    echo    "
                                            <tr id='".$user['user_id']."'>
                                            <td>".$user['user_name']."</td>
                                            <td>".$user['user_email']."</td>
                                            <td>".$user['user_position']."</td>
                                            <td class='text-center'>".$user['app_code']."</td>
                                            <td class='text-center'>
                                                <form action='".URL."users/getUserData' method='POST'>
                                                    <input type='hidden' name='user-id' value='".$user['user_id']."'>
                                                    <button type='submit' name='update-user' id='update-user-data'><img class='edit' src='".URL."images/pencil.png'></button>
                                                </form>
                                            </td>
                                            <td class='text-center'>
                                                <form action='".URL."users/deleteUser' method='POST'>
                                                <input type='hidden' name='user-id' value='".$user['user_id']."'>
                                                <button type='submit' name='delete-user'><img class='edit text-center' src='".URL."images/delete_icon.svg.png'></button>
                                                </form>
                                            </td>
                                            </tr>
                                            ";

                                }


                            ?>
                        </table>
                    </div>
                    
                    <div id="page2">
                    
                        <button id="add-user" class="button" type="button" >Add New User</button>
                        
                    <!-- The Modal Log in -->
    <div id="add-user-modal" class="modal"> 
        <?php if(isset($script)){echo $script;} ?>
      <!-- Modal content -->
      <div class="modal-content">
        <span class="close">&times;</span>
                        
                        
                    <form id="new-user" action="<?php echo URL ?>users/newUser" method="POST">
                    
                        <h3>Use this form to add a new user or manage existing user</h3>
                        
                        Name:<br>
                        <input type="text" name="user-name" value="<?php if(isset($userName)){echo $userName;} ?>"><br>
                        Position:<br>
                        <input type="text" name="user-position" value="<?php if(isset($userPosition)){echo $userPosition;} ?>"><br>
                        Email:<br>
                        <input type="email" name="user-email" value="<?php if(isset($userEmail)){echo $userEmail;} ?>"><br>
                        Password:<br>
                        <input type="password" name="user-password"><br>
                        Password again<br>
                        <input type="password" name="user-password-again"><br>
                        
                        <h4>Advanced administrative access</h4>
                        
                        Access to the website<br>
                        <input type="radio" name="web-access" value="2" checked>Yes
                        <input type="radio" name="web-access" value="3">No<br><br>
                        
                        Give a digit code to access the tablet application<br>
                        <input type="number" name="app-code"><br><br>
                        
                        <input type="hidden" name="company-id" value="<?php echo $_SESSION['user_session']['company_id']; ?>">
                        
                        <input type="submit" name="new-user" value="Add new user"><br><br>
                        <span class="error"><?php if(isset($newUserErrors[0])){echo ($newUserErrors[0]);}; ?></span>
                        
                    </form>
                    
          
      </div>
        
        

    </div>
                        
                        
                        
                        
    <div id="update-user-modal" class="modal"> 
        <?php if(isset($script)){echo $script;} ?>
      <!-- Modal content -->
      <div class="modal-content">
        <span class="close">&times;</span>
                        
                        
                    <form id="update-user" action="<?php echo URL ?>users/updateUser" method="POST">
                    
                        <h3>Use this form to manage user details</h3>
                        
                        Name:<br>
                        <input type="text" name="update-user-name" value="<?php if(isset($updateUserName)){echo $updateUserName;} ?>"><br>
                        Position:<br>
                        <input type="text" name="update-user-position" value="<?php if(isset($updateUserPosition)){echo $updateUserPosition;} ?>"><br>
                        Email:<br>
                        <input type="email" name="update-user-email" value="<?php if(isset($updateUserEmail)){echo $updateUserEmail;} ?>"><br>
                        
                        <h4>Advenced administrative access</h4>
                        
                        Access to the website<br>
                        <input type="radio" name="update-web-access" value="2"  <?php if(isset($updateUserAccess)&&$updateUserAccess==2){echo 'checked';}else if(!isset($updateUserAccess)){echo 'checked';}else{echo '';} ?>>Yes
                        <input type="radio" name="update-web-access" value="3" <?php if(isset($updateUserAccess)&&$updateUserAccess==3){echo 'checked';}else{echo '';} ?>>No<br><br>
                        
                        Give a digit code to access the tablet application<br>
                        <input type="number" name="update-app-code" value="<?php if(isset($updateUserAppCode)){echo $updateUserAppCode;} ?>"><br><br>
                        
                        <input type="hidden" name="user-id" value="<?php if(isset($updateUserId)){echo $updateUserId;} ?>">
                        
                        <input type="submit" name="update-user" value="Update user details"><br><br>
                        <span class="error"><?php ?></span>
                        
                    </form>
                    
          
      </div>
        
        

    </div>
          
        
                    </div>
            </div>
        
        <script> 
            
            $( ".active" ).removeClass( "active" ).addClass( "non-active" );
            $("#users").addClass("active");
            
            var modal = document.getElementById('add-user-modal')
            var modal2 = document.getElementById('update-user-modal')

            var btn = document.getElementById("add-user");
            var btn2 = document.getElementById("update-user-data");

            var span = document.getElementsByClassName("close")[0];
            var span2 = document.getElementsByClassName("close")[1];

            btn.onclick = function() {
                modal.style.display = "block";
            }

            btn2.onclick = function() {
                modal2.style.display = "block";
            }

            span.onclick = function() {
                modal.style.display = "none";
            }

            span2.onclick = function() {
                modal2.style.display = "none";
            }

            window.onclick = function(event) {
                if (event.target == modal || event.target == modal2) {
                    modal.style.display = "none";
                    modal2.style.display = "none";
                }
            }
             

        </script>
        
    
        </div><!-- END OF content-ui -->
    
    
    
    
    </div><!-- END OF content -->




</div><!-- END OF content-wrap -->