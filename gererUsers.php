<?php
session_start();
include_once 'Methods.php';
if(isset($_SESSION['connect'])){
	if($_SESSION['connect']!=1)
	{
		echo"<script type='text/javascript'>alert('Vous devez etre connecte pour acceder a cette page !');
			document.location.href='index.php';</script>";


	}else{
		if(isset($_SESSION["safe"])){
			if($_SESSION['safe']==false){echo "<script type='text/javascript'>alert('Votre mot de passe n est pas securise , Redirection vers la parge de changement de mdp.');
								document.location.href='reglage.php';
					</script>";}
		}
		
		if($_SESSION['user_type']!='cd'){

			echo"<script type='text/javascript'>alert('Redirection vers la page adequate.');
			document.location.href='index.php';</script>";
		}
	}
}else
	echo"<script type='text/javascript'>window.alert('Vous devez etre connecte pour acceder a cette page !');
			document.location.href='index.php';</script>";

	if(isset($_POST['update_button'])){
		header("Location:updateUser.php?id=".$id);
	}
	
	
	
	
	if(isset($_POST['delete_button'])){
		$id=$_POST['id'];
		$connD=db_connect();
		$sqlD="delete from users where id_user=$id";
		$resD=$connD->query($sqlD);
		if($resD){
			echo "<script type='text/javascript'> window.alert('User $id deleted.')</script>";
		}
	}
	
	
	?>
	
	
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta charset="UTF-8">
<script type="text/javascript" src="interface/js/jquery.min.js"></script>
<link rel="stylesheet" type="text/css" href="interface/css/gererUsers.css">
<link rel="stylesheet" type="text/css" href="interface/css/materialize.css">
<script type="text/javascript" src="interface/js/jquery.min.js"></script>
<script type="text/javascript" src="interface/js/materialize.min.js"></script>
<script type="text/javascript" src="interface/js/methods.js"></script>
</head>
<body>
      <script type="text/javascript">
         
          $(document).ready(function() {
    $('select').material_select();
  });
         </script>
          <script type="text/javascript">
          $('select').material_select('destroy');
         </script>
    
<div id="container">
    <div id="topbar" class="z-depth-2">

<img src="interface/img/logoAinchok.jpg" class="z-depth-3" id="ainchock" >
<img src="interface/img/logouh2c.jpg" class="z-depth-3" id="uh2c">
    <div id='top_div'>
       <h5 align="center" id="toptext" > Gestion Utilisateurs</h5>
        </div>
        
        
         <div id="buttons"  align="center">
         <a class="btn waves-effect z-depth-3" href="<?php 
         		switch($_SESSION['user_type']){
					case 'pr':echo 'ProfUI.php'; break;
					case 'cd':echo 'chefUI.php'; break;
				}?>
													">accueil</a>
         <a class="btn waves-effect z-depth-3" href="rechercheAvancee.php">Recherche Avancee</a>
         <a class="btn waves-effect z-depth-3" href="choisir.php">Affectation</a>
        
        <a  class="btn waves-effect z-depth-3" href='logout.php ' id='logout'> log out</a>
       <div id='Ajouter'><form action="addUser.php"  method='POST'>
       						<input type="text" id="recherche" onkeyup="myFunction()" >
       						<button type="submit" class="btn waves-effect z-depth-3" value="Ajouter un utilisateur" id="Ajouter_btn">Ajouter un utilisateur</button>
       					
       					 </form></div>
       	
			 
       <?php 
      
       $conn=db_connect();
       user_list();
        if(isset($_POST['id'])){
       $idd=$_POST["id"];
         $sql1="delete from users where id_user=$idd";
				  if($conn->query($sql1)===true)
				  {echo "<script>alert('DELETED') </script>";}}
       
       
      
       ?>
       <script>
function myFunction() {
  // Declare variables 
  var input, filter, table, tr, td, i;
  input = document.getElementById("recherche");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTable");
  tr = table.getElementsByTagName("tr");

  // Loop through all table rows, and hide those who don't match the search query
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[1];
    if (td) {
      if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    } 
  }
}
</script>
        
</div>
</div>
</body>
</html>