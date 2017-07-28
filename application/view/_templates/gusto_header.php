<?php ob_start();session_start(); ?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo $pageTitle ?></title>
      
      <link href="<?php echo URL; ?>css/style.css" rel="stylesheet" type="text/css" >
      <link href="https://fonts.googleapis.com/css?family=Lato|Slabo+27px" rel="stylesheet">
      <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
      <script src="https://code.jquery.com/jquery-1.12.4.js"></script><!-- jQuery library --> 
      <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script><!-- jQuery UI library -->
      <script src="<?php echo URL; ?>/js/jquery.ui.touch-punch.min.js"></script>
      
  </head>
  <body>
      
      
<div id="content-wrap">

    <div id="content">
        
        <div id="logo">
      
            <a href="<?php echo URL?>gusto/gusto" rel="external" ><img src="<?php echo URL; ?>/images/cafe.png"></a>
      
        </div>
        
        
        <div id="info-bar">
            
            <?php 
            
                if(isset($_SESSION['user_session']['user_name']) && isset($_SESSION['user_session']['company_id']) && isset($_SESSION['user_session']['company_name'])){
                    echo "";
                }else{
                     $this->redirect('home');
                }
            
            ?>
            
            
            <span class="padding">Hello <?php echo $_SESSION['user_session']['user_name'];?> welcome to Gusto</span>
            <span class="padding">Your company ID is <?php echo $_SESSION['user_session']['company_id'];?></span>
            <span class="padding">Your company is <?php echo $_SESSION['user_session']['company_name'];?></span>
            
        </div>
        
        
    
        <div id="content-ui">
      
            
            <!--<div id="dialog" title="Your company`s ID">
            <p>Your comapy`s ID is<br> <span class="bold"><?php //echo $companyId; ?></span><br> Please take a note of this number as it will be asked for login<br> We also send it to you by email.</p>
          </div>            I will need to put this back and sort it out to only display it for the first time-->
            
          <div id="gusto-nav-bar">
              
              
              
              <ul>

                  <li id="users" class="non-active"><a href="<?php echo URL?>gusto/users" rel="external" >Manage Users</a></li>
                  <li id="menu" class="non-active"><a href="<?php echo URL?>gusto/menu" rel="external" >Manage Menu</a></li>
                  <li id="adv-menu" class="non-active"><a href="<?php echo URL?>gusto/advmenu" rel="external" >Advanced Menu</a></li>
                  <li id="stat" class="non-active"><a href="<?php echo URL?>gusto/statistic" rel="external" >Statistic</a></li>
                  <li id="stock" class="non-active"><a href="<?php echo URL?>gusto/stock" rel="external" >Stock</a></li>
                  <li id="live-view" class="non-active"><a href="<?php echo URL?>gusto/liveview" rel="external" >Live View</a></li>
                  <li><a href="<?php echo URL?>gusto/logout/true" rel="external" >Sign out</a></li>


              </ul>
          </div>
      