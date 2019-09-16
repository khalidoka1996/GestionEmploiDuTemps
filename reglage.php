<?php
session_start();
if(isset($_SESSION['connect'])){
	if($_SESSION['connect']!=1)
	{
		echo"<script type='text/javascript'>alert('Vous devez etre connecte pour acceder a cette page !');
			document.location.href='index.php';</script>";


	}
}else
	echo"<script type='text/javascript'>window.alert('Vous devez etre connecte pour acceder a cette page !');
			document.location.href='index.php';</script>";

	?>
	
	

<html>
<head>
<style type="text/css">
#buttns{
margin-top:-3%;
margin-left:25%;
			 }
			 #logout{

	width:13%;
	font-size:75%;
	margin-right:15px;
	float:right;
	background-color:green;
}
#toptext{
height:1%;
margin-bot:35%;
}
			 
			 </style>

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
      <div id='toptextA'>
       <h5 align="center" id="toptext" >Interface <?php 
         		switch($_SESSION['user_type']){
					case 'pr':echo 'Prof'; break;
					case 'cd':echo 'Chef'; break;
				}?>
				(<?php echo $_SESSION['name']?>)</h5>
        </div>
        <div id="buttns"  align="center">
      
        
         <a class="btn waves-effect z-depth-3" href="<?php 
         		switch($_SESSION['user_type']){
					case 'pr':echo 'ProfUI.php'; break;
					case 'cd':echo 'chefUI.php'; break;
				}?>
													">accueil</a>
		<a  class="btn waves-effect z-depth-3" href='logout.php ' id='logout'> log out</a>
		</div>										 
</div>
<div id="logindiv" class="z-depth-3" >
   
    <p align="center"><b>Changez le mot de passe</b></p><br>
    <form action="reglage.php" method="post">
        <div class="input-field col s6">
        <label for="username">Old Password</label>
        <input name="oldpwd" type="password" >
        </div>
        <div class="input-field col s12">
         <label for="password">New Password</label>
        <input name="newpwd" type="password" >
        </div>
        <div id="buttons"  align="center">
         
         <button class="btn waves-effect z-depth-3" type="submit" name="action">Changez</button>
            
        </div>
                    

    </form>
    
    
</div>
 </div>
 
 
 
 
 
 
 
 
 
 
 
 
 
</body>
</html>



<?php
function test_input($data) {
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	return $data;
}

$passwordErr="";
if(isset($_POST['oldpwd'])&&isset($_POST['newpwd'])){
include_once 'Methods.php'; 
$conn=db_connect();
$oldpwd=$_POST['oldpwd'];
$newpwd=$_POST["newpwd"];



$change=true;
if(!empty($_POST["newpwd"])) {
	
	$password = test_input($_POST["newpwd"]);
	if (strlen($_POST["newpwd"]) <= '8') {
		$passwordErr = "Your Password Must Contain At Least 8 Characters!";
		$change=false;
	}
	elseif(!preg_match("#[0-9]+#",$password)) {
		$passwordErr = "Your Password Must Contain At Least 1 Number!";
		$change=false;
	}
	elseif(!preg_match("#[A-Z]+#",$password)) {
		$passwordErr = "Your Password Must Contain At Least 1 Capital Letter!";
		$change=false;	
	}
	elseif(!preg_match("#[a-z]+#",$password)) {
		$passwordErr = "Your Password Must Contain At Least 1 Lowercase Letter!";
		$change=false;
	}
}
 else {
	$passwordErr = "Please enter a password   ";
	$change=false;
 }




if($change){
$userid=$_SESSION['id_us'];
$sql2="select password_user from users where id_user=$userid";
$r=$conn->query($sql2);
$rw=$r->fetch_row();
	$testpwd=$rw[0];

if(sha1($oldpwd)==$testpwd)
 {
 	
 	$pwd_sh=sha1($newpwd);
	$sql1="update users set password_user='$pwd_sh' where id_user= '$userid'";
	$result=$conn->query($sql1);
	$_SESSION["safe"]=true;
	if($result===true){echo "<script> alert('CHANGED');
         				document.location.href='index.php';
         				</script>";
		
	}
	 else {echo "<script> alert('Erreur lors du changement de mot de passe.')</script>";} 
	 
 }
else {echo "<script> alert('Ancien mot de passe incorrect.')</script>";}}


 else echo "<script type='text/javascript'>alert('$passwordErr');</script>";

}?>