
        
                <div id="display">


                    <h1>Advenced menu options</h1>
                    
                    <?php 
                        $menuData = $this->getMenuData($_SESSION['user_session']['company_id']) ;
                        foreach($menuData as $data){

                            $vatNo = $data['VAT_number'];
                            $serviceCharge = $data['service_charge'];
                            $phoneNumber = $data['phone'];
                            $message = $data['message'];
                            
                        }
                    ?>
                    
                    <form action="<?php echo URL ?>advmenu/updateMenu" method="POST">
                    
                        <h3>Set up your advenced bill settings</h3>
                        <p>Those settings will show on the final printed bill</p>
                        
                        VAT No:<br>
                        <input type="Number" name="VAT-number" value="<?PHP if(isset($vatNo)){echo $vatNo;} ?>"><br>
                        Service charge (in percentage):<br>
                        <input type="number" step="0.01" name="service-charge" value="<?PHP if(isset($serviceCharge)){echo $serviceCharge;} ?>"><br>
                        Restaurant`s phone number<br>
                        <input type="number" name="phone-number" value="<?PHP if(isset($phoneNumber)){echo $phoneNumber;} ?>"><br>
                        
                        Put a message on the bottom of the bill<br>
                        <textarea rows="6" name="bill-message"><?PHP if(isset($message)){echo $message;} ?></textarea><br><br>
                        <input type="hidden" name="company-id" value="<?php echo $_SESSION['user_session']['company_id']; ?>">
                        <input type="submit">
                    
                    </form>
          
        
            </div>
    
        <script> 
            
            $( ".active" ).removeClass( "active" ).addClass( "non-active" );
            $("#adv-menu").addClass("active");

        </script>

    
        </div><!-- END OF content-ui -->
    
    
    
    
    </div><!-- END OF content -->




</div><!-- END OF content-wrap --> 