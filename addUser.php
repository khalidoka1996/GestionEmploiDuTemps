<?php 
session_start();

include_once 'Methods.php';
$conn=db_connect();
$dept=$_SESSION["dept"];


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




?>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta charset="UTF-8">
<script type="text/javascript" src="interface/js/jquery.min.js"></script>
<link rel="stylesheet" type="text/css" href="interface/css/formulaire.css">
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
       <h5 align="center" id="toptext" >Add user </h5>
        </div>
        
        
         <div id="buttons">
         <a class="btn waves-effect z-depth-3" id="acceuil" href="gererUsers.php">Back</a>     
        <a  class="btn waves-effect z-depth-3" href='logout.php ' id='logout'> log out</a>
        </div>     
</div>
      
      
      <form action="addUser.php" method="POST">
          <table id="formtable">
              <tr>
              <td colspan="2"> <h4 align="center">Saisir les informations du Prof </h4></td>
              </tr>
          <tr>
              <td>
        <div class="input-field col s6">
          <input placeholder="prenom"  name="firstname" type="text" class="validate">
        </div>
      </td>
              <td>
                
        <div class="input-field col s6">
          <input placeholder="nom"  name="lastname" type="text" class="validate">
        </div>
      </td>
              
         </tr>
         <tr>
             <td>
             
        <div class="input-field col s6">
          <input placeholder="E-mail"  name="mail" type="email" class="validate">
        </div>
      </td>
             <td>
           
             </td>
        </tr>
        <tr>
            <td></td>
            <td><div id="envoyer">
<input  class="btn waves-effect z-depth-3" type="submit" value="envoyer"></div></td>
        </tr>
          </table>

      </form>
      
        
     
    
        
    
    
        </div>
    </body>
</html>
<?php 




if(isset($_POST["lastname"])&&isset($_POST["firstname"])&&isset($_POST["mail"])){
$nom=$_POST["lastname"];
$prenom=$_POST["firstname"];
$email=$_POST["mail"];
echo $nom.$prenom.$email;
$sql="insert into ressources_profs (nom,prenom,email,codeDept) 
VALUES ('$nom','$prenom','$email','$dept')"; 
$res=$conn->query($sql);
 if($res) echo "<script> alert('User ajouté')</script>";
 else echo "<script> alert('Something wrong')</script>";

}

?>

 
