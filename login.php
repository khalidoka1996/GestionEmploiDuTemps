<?php
session_start();
if(isset($_SESSION['connect'])){
	if($_SESSION['connect']==1){
		switch($_SESSION['user_type']){
			case 'pr':header('Location:ProfUI.php'); break;
			case 'cd':header('Location:chefUI.php'); break;
		}
	}
}

else {
	$_SESSION['connect']=0;
	$_SESSION['user_type']="";
}
?>



<html>
<head>

      <script type="text/javascript" src="interface/js/jquery.min.js"></script>
<link rel="stylesheet" type="text/css" href="interface/css/login.css">

     <link rel="stylesheet" type="text/css" href="interface/css/materialize.min.css">
     
     <script type="text/javascript" src="interface/js/jquery.min.js"></script>
    
    <script type="text/javascript" src="interface/js/materialize.min.js"></script>

    
    
    
    
</head>
<body>
<div id="container">
   <div id="topbar" class="z-depth-2">

<img src="interface/img/logoAinchok.jpg" class="z-depth-3" id="ainchock" >
<img src="interface/img/logouh2c.jpg" class="z-depth-3" id="uh2c">
    <div>
       <h5 align="center" id="toptext" > Emploi du temps FSAC </h5>
        </div>
</div>
<div id="logindiv" class="z-depth-3" >
   
    <p align="center"><b>LOGIN</b></p><br>
    <form action="ConnectApp.php" method="post">
        <div class="input-field col s6">
        <label for="username">Username</label>
        <input name="username" type="text" id="username">
        </div>
        <div class="input-field col s12">
         <label for="password">Password</label>
        <input name="password" type="password" id="password">
        </div>
        <div id="buttons"  align="center">
         
         <button class="btn waves-effect z-depth-3" type="submit" name="action">Se connecter</button>
            
        </div>
        <div id="passwordf">
       <a href="#" >mot de passe oublie</a>
        </div>              

    </form>
    
    
</div>
 </div>
 
 
 
 
 
 
 
 
 
 
 
 
 
</body>
</html>
