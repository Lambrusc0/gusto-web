
        
                <div id="display">


                    <h1>Menu options</h1>
                    
                    <button id="button1" class="button" type="button" >Add New Menu Item</button>
                        
                        <?php 
                                
                                    $categories = $this->getCategories($_SESSION['user_session']['company_id']);
                                    
                                    foreach($categories as $category){
                                        
                                        /* This is a number of items of how many items there are in each category */
                                        $itemsCount = $this->getItemsCount($category['category_id']);
                                        
                                        
                                        /* Here I load all the data of the items for each category */
                                        $items = $this->getItems($category['category_id']);
                                        
                                        
                                        
                                        /* Echo each category */
                                        echo "<table class='menu-table' style='border-top:2px solid black;margin-top:50px;'>
                        
                                                <tr>

                                                    <th>Category</th>
                                                    <th>No. of items</th>
                                                    <th>Edit</th>

                                                </tr>
                                            <tr style='background:black;color:white;' id=".$category['category_id']."><td>".$category['category_name']."</td>
                                             <td class='text-center'>

                                                ".$itemsCount."

                                             </td>
                                             <td class='text-center'>
                                             
                                                <form action='".URL."menu/getCategory' method='POST'>
                                                    <input type='hidden' name='category-id' value='".$category['category_id']."'>
                                                    <button type='submit' name='update-category' id='update-category-data'><img class='edit' src='".URL."images/pencil-white.png'></button>
                                                </form>
                                             
                                             </td>
                                             </tr>
                                         </table>
                                         
                                         
                                         <table class='menu-table' style='margin-bottom:20px;'>
                                                <tr>
                                                    <th>Name</th>
                                                    <th class='text-center'>£Price</th>
                                                    <th class='text-center'>Description</th>
                                                    <th class='text-center'>Edit</th>
                                                    <th class='text-center'>Delete</th>
                                                </tr>";
                                        
                                        foreach($items as $item){
                                            
                                            /* Putting the data in variables */
                                            $itemName=$item['item_name'];
                                            $itemPrice=$item['item_price'];
                                            $itemDescription=$item['item_description'];
                                            $itemId=$item['item_id'];
                                            
                                             /* Echo each item */
                                             echo "<tr>
                                                        <td>".$itemName."</td>
                                                        <td class='text-center'>£".$itemPrice."</td>
                                                        <td class='text-center'><div class='tooltip'>Description<span class='tooltiptext'>".$itemDescription."</span></div></td>
                                                        <td class='text-center'>
                                                            <form action='".URL."menu/getItem' method='POST'>
                                                            <input type='hidden' name='item-id' value='".$itemId."'>
                                                            <button type='submit' name='get-item'><img class='edit' src='".URL."images/pencil.png'></button>
                                                            </form>
                                                        </td>
                                                        <td class='text-center'>
                                                            <form action='".URL."menu/deleteItem' method='POST'>
                                                            <input type='hidden' name='item-id' value='".$itemId."'>
                                                            <button type='submit' name='delete-user'><img class='edit text-center' src='".URL."images/delete_icon.svg.png'></button>
                                                            </form>
                                                        </td>
                                                    </tr>

                                                ";
                                            
                                        }
                                        
                                        echo "</table>";
                                         
                                        
                                    };
                                
                                
                                
                                ?>
                    
                    
                    
                    
                    
                    

                
                    
                    
                    <div id="modal1" class="modal"> 
                        <?php if(isset($script)){echo $script;} ?>
                      <!-- Modal content -->
                      <div class="modal-content">
                        <span class="close">&times;</span>
                    
                    
                    
                        <form id="add-item" action="<?php echo URL ?>menu/addNewItem" method="POST">

                            <h3>Use this form to manage your menu</h3>

                            Name:<br>
                            <input type="text" name="item-name"><br>
                            Price:<br>
                            <input type="number" step="0.01" name="item-price"><br>
                            Select category:<br>
                            <select name="item-category">
                            
                                <?php 
                                
                                    $categories = $this->getCategories($_SESSION['user_session']['company_id']);
                                    
                                    foreach($categories as $category){
                                        
                                        echo "<option value=".$category['category_id'].">".$category['category_name']."</option>";
                                        
                                    }
                                
                                
                                
                                ?>
                                
                            </select><br>
                            
                            Description<br>
                            <textarea rows="6" style="text-align:left;" name="item-description"></textarea><br>
                            <input type="hidden" name="company-id" value="<?php echo $_SESSION['user_session']['company_id'] ?>">

                            <input type="submit" name="add-menu-item" value="Add item">

                        </form>
                          
                        </div>
                    </div>
                    
                    
                    <div id="modal2" class="modal">
                    <?php if(isset($script)){echo $script;} ?>
                      <!-- Modal content -->
                        <div class="modal-content">
                            <span class="close2">&times;</span>
                            
                            <form id="update-category" action="<?php echo URL ?>menu/updateCategory" method="POST">
                                
                                <h3>Use this form to update the name of this category</h3>
                                
                                Name:<br>
                                <input type="text" name="category-name" value="<?php if(isset($categoryName)){
    
                                                                                    foreach($categoryName as $name){
                                                                                        echo $name['category_name'];
                                                                                    $categoryId=$name['category_id'];}}; ?>"><br><br>
                                <input type="hidden" name="category-id" value="<?php if(isset($categoryName)){echo $categoryId;} ?>" >
                                <input type="submit" name="update-category" value="Update"><br><br>
                                
                            </form>
                            
                        </div>
                    
                    </div>
                    
                    <div id="modal3" class="modal">
                    <?php if(isset($script)){echo $script;} ?>
                      <!-- Modal content -->
                        <div class="modal-content">
                            <span class="close3">&times;</span>
                            
                            <form id="update-item" action="<?php echo URL ?>menu/updateItem" method="POST">
                                
                                    <h3>Use this form to update this item`s details</h3>
                                
                                    Name:<br>
                                    <input type="text" name="update-item-name" value="<?php if(isset($updateItemName)){echo $updateItemName;} ?>"><br>
                                    Price:<br>
                                    <input type="number" step="0.01" name="update-item-price" value="<?php if(isset($updateItemPrice)){echo $updateItemPrice;} ?>"><br><br>
                                    <select name="item-category">

                                    <?php 

                                        $categories = $this->getCategories($_SESSION['user_session']['company_id']);

                                        foreach($categories as $category){

                                            $selected="";
                                            if($category['category_id']==$updateItemCategory){$selected="selected";};
                                            
                                            echo "<option value='".$category['category_id']."'".$selected.">".$category['category_name']."</option>";

                                        }



                                    ?>

                                </select><br>

                                Description<br>
                                <textarea rows="6" style="text-align:left;" name="item-description"><?php if(isset($updateItemDescription)){echo $updateItemDescription;} ?></textarea><br>
                                <input type="hidden" name="item-id" value="<?php if(isset($updateItemId)){echo $updateItemId;} ?>" >
                                <input type="submit" name="update-item" value="Update"><br><br>
                                
                            </form>
                            
                        </div>
                    
                    </div>
                    
          
            </div>
        
        <script> 
            
            $( ".active" ).removeClass( "active" ).addClass( "non-active" );
            $("#menu").addClass("active");
            
            var modal = document.getElementById('modal1');
            var modal2 = document.getElementById('modal2');
            var btn = document.getElementById("button1");
            var btn2 = document.getElementById("update-category-data");
            var span = document.getElementsByClassName("close")[0];
            var span2 = document.getElementsByClassName("close2")[0];
            var span3 = document.getElementsByClassName("close3")[0];
            
            btn.onclick = function() {
                modal.style.display = "block";
            }
            
            span.onclick = function() {
                modal.style.display = "none";
            }
            
            span2.onclick = function() {
                modal2.style.display = "none";
            }
            
            span3.onclick = function() {
                modal3.style.display = "none";
            }
            
            window.onclick = function(event) {
                if (event.target == modal || event.target == modal2 || event.target == modal3) {
                    modal.style.display = "none";
                    modal2.style.display = "none";
                    modal3.style.display = "none";
                }
            }

        </script>
    
        </div><!-- END OF content-ui -->
    
    
    
    
    </div><!-- END OF content -->




</div><!-- END OF content-wrap -->