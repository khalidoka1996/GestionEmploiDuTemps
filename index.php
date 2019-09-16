<?php
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
<?php 
session_start();
include_once 'Methods.php';

if(isset($_SESSION['connect'])){
if($_SESSION['connect']==1)
{
	if(isset($_SESSION["safe"])){
		if($_SESSION['safe']==false){echo "<script type='text/javascript'>alert('Votre mot de passe n est pas securise , Redirection vers la parge de changement de mdp.');
								document.location.href='reglage.php';
					</script>";}
	}
switch($_SESSION['user_type']){
					case 'pr': header('Location:ProfUI.php');break;
					case 'cd': header('Location:chefUI.php');break;
					}
}
}
?>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta charset="UTF-8">
<script type="text/javascript" src="interface/js/jquery.min.js"></script>
<link rel="stylesheet" type="text/css" href="interface/css/index.css">
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
       <h5 align="center" id="toptext" > Accueil </h5>
        </div>
        
        
         <div id="buttons"  align="center">
         <a class="btn waves-effect z-depth-3" href="RechercheAv.php">Recherche Avancee</a>
        <a  class="btn waves-effect z-depth-3" href='login.php ' id='login'> login</a>
        
        </div>
        
        
</div>
 <!-- input-field col s6  -->
 <div id="options_container">
    <form method="post" action="afficherEmploi.php">
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

  <select name="td" id="td" class="browser-default form-control action">
    <option value="" disabled selected>Selectionner TD</option>

  </select>
    </div>
    
    <div class="select">

  <select name="groupe" id="groupe"  class="browser-default form-control ">
    <option value="" disabled selected>Selectionner Groupe</option>

  </select> 
    
    </div>
    
  
    <div class="select">
    <button type="submit" style="text-align:center;"  class="btn waves-effect waves-light z-depth-3" >Afficher Emploi</button>
    </div>
    
    
    </form> 
    </div>
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
   if(action == "td")
   {
    result = 'groupe';
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
