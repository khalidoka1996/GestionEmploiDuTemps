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

?>
<?php

if(isset($_POST["filiere"])){
	

	echo "<form id='id_du_formulaire' action='affectation.php' method='post'>
	<input type='hidden' name='filiere' value='";
	if(isset($_POST['filiere'])) echo $_POST['filiere'];
	echo "'>
	<input type='hidden' name='section' value='";
	if(isset($_POST['section'])) echo $_POST['section'];
	echo "'>
	<input type='hidden' name='semestre' value='";
	if(isset($_POST['semestre'])) echo $_POST['semestre'];
	echo "'>
							</form>";
							
	echo "<script type='text/javascript'>
	document.getElementById('id_du_formulaire').submit();
	</script>";
}









//index.php
$connect = mysqli_connect("localhost", "root", "", "mydb");
$filiere= '';
$query = "SELECT ReG.codeGroupe ,ReG.nom FROM 
	ressources_groupes ReG 
	where ReG.codeGroupe in (287,288,275,279,283)
	ORDER BY `nom` ASC
";
$result = mysqli_query($connect, $query);

while($row = mysqli_fetch_array($result))
{
 $filiere .= '<option value="'.$row["codeGroupe"].'">'.$row["nom"].'</option>';
}
?>

<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta charset="UTF-8">
<script type="text/javascript" src="interface/js/jquery.min.js"></script>
<link rel="stylesheet" type="text/css" href="interface/css/chefUI.css">
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
       <h5 align="center" id="toptext" > Affectation</h5>
        </div>
        
        
         <div id="buttons"  align="center">
         <a class="btn waves-effect z-depth-3" href="chefUI.php" id='acceuil'>accueil</a>
         <a class="btn waves-effect z-depth-3" href="rechercheAvancee.php">Recherche Avancee</a>
        <a class="btn waves-effect z-depth-3" href="gererUsers.php">Gerer utilisateurs</a>  
        
        <a  class="btn waves-effect z-depth-3" href='logout.php ' id='logout'> log out</a>
        </div>
        
        
</div>
    
     <div id="menu" class="fixed-action-btn toolbar">
    <a class="btn-floating btn-large red">
      <i class="large material-icons">A</i>
    </a>
    <ul>
      <li class="waves-effect waves-light"><a href="#!"><i class="material-icons">info user</i></a></li>
      <li class="waves-effect waves-light"><a href="#!"><i class="material-icons">notifications</i></a></li>
      <li class="waves-effect waves-light"><a href="#!"><i class="material-icons">contact</i></a></li>
      <li class="waves-effect waves-light"><a href="reglage.php"><i class="material-icons">reglage account</i></a></li>
    </ul>
  </div>

 <div id="options_container">
    <form method="post" action="affectation.php">
    <div class="select">
   
  <select name="filiere" id="filiere"  class="browser-default form-control action">
    <option value="" disabled selected>Selectionner filiere</option>
     <?php echo $filiere; ?>
  </select>
    </div>
    
    <div class="select">

  <select name="semestre" id="semestre" class="browser-default form-control action">
    <option value="" disabled selected>Selectionner semestre</option>
  </select>
    </div>
    
    <div class="select">

  <select name="section" id="section" class="browser-default form-control action">
    <option value="" disabled selected>Selectionner Section</option>
  </select>
    </div>
    
       
  
    <div class="select">
    <button type="submit" style="text-align:center;"  class="btn waves-effect waves-light z-depth-3" >Affecter </button>
    </div>
    
    
    </form> 
    </div>
        
        
 
		
        
        
        
        
        
</body>
</html>
<script>
$(document).ready(function(){
 $('.action').change(function(){
  if($(this).val() != '')
  {
   var action = $(this).attr("id");
   var query = $(this).val();
   var result = '';
   if(action == "filiere")
   {
    result = 'semestre';
   }
   if(action == "semestre")
   {
    result = 'section';
   }
   if(action == "section")
   {
    result = 'td';
   }
  
   $.ajax({
    url:"fetch.php",
    method:"POST",
    data:{action:action, query:query},
    success:function(data){
     $('#'+result).html(data);
    }
   })
  }
 });
});
</script>