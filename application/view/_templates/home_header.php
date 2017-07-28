<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Gusto <?php echo $pageTitle ?></title>
      
      <link href="<?php echo URL; ?>css/style.css" rel="stylesheet" type="text/css" >
      <link href="https://fonts.googleapis.com/css?family=Lato|Slabo+27px" rel="stylesheet">
      <script src="https://code.jquery.com/jquery-1.12.4.js"></script><!-- jQuery library --> 
      <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script><!-- jQuery UI library -->
      <script src="<?php echo URL; ?>/js/jquery.ui.touch-punch.min.js"></script>
      
  </head>
  <body onload="modalFunction()">
      
      
      <div id="logo">
      
        <img src="<?php echo URL; ?>/images/cafe.png">
      
      </div>
      <div id="home-nav-bar">
          <ul>

              <li><a href="#">About us</a></li>
              <li><a href="#">Blog</a></li>
              <li><button id="signup" type="button" onclick="modalFunction()">Sign up</button></li>
              <li><button id="login" type="button" onclick="modalFunction()">Log in</button></li>


          </ul>
      </div>
      
    <!-- The Modal Log in -->
    <div id="login-modal" class="modal"> 

      <!-- Modal content -->
      <div class="modal-content">
        <span class="close">&times;</span>
        <form id="login-form" action="<?php echo URL ?>register/login" method="POST">
          <br><br>
            Company ID<br>
            <input type="text" name="loginCompanyId" placeholder="Company ID" value="<?php if(isset($errors)){echo $_POST['loginCompanyId'];}else{echo "";}?>"><br>
            Name<br>
            <input type="text" name="loginUserName" placeholder="Name" value="<?php if(isset($errors)){echo $_POST['loginUserName'];}else{echo "";}?>"><br>
            Password<br>
            <input type="password" name="loginPassword" placeholder="Password" value="<?php if(isset($errors)){echo $_POST['loginPassword'];}else{echo "";}?>"><br><br>
            <input type="submit" name="login" value="Log in"><br><br>
            <span class="error"><?php if(isset($errors)){echo $errors[0];}; ?></span>
          
        </form>
      </div>

    </div>
      
      
      
      <!-- The Modal Sign up -->
    <div id="signup-modal" class="modal">

      <!-- Modal content -->
      <div class="modal-content">
        <span class="close">&times;</span>
        <form id="signup-form" action="<?php echo URL ?>register/signup" method="POST">
            
            
                <br><br>
                Company Name<br>
                <input type="text" name="companyName" placeholder="Company Name" value="<?php if(isset($error)){echo $_POST['companyName'];}?>"><br>
                Your Name<br>
                <input type="text" name="userName" placeholder="Your Name" value="<?php if(isset($error)){echo $_POST['userName'];}?>"><br>
                Your or the Company`s Email address<br>
                <input type="email" name="userEmail" placeholder="Your Email" value="<?php if(isset($error)){echo $_POST['userEmail'];}?>"><br>
                Password<br>
                <input type="password" name="password" placeholder="Password"><br>
                Password again<br>
                <input type="password" name="passwordAgain" placeholder="Password again"><br><br>
                <input type="submit" name="register" value="Sign up"><br><br>
                <span class="error"><?php if(isset($error)){echo ($error[0]);}; ?></span>
            
          
        </form>
      </div>

    </div>