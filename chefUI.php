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

	
$conn=db_connect();
	$sqlnotif="select SM.date,SM.heure,SM.codeModification,SM.salle,E.nom as nomEnseignement,ReP.nom as nomProf,ReP.prenom as prenomProf,
			dayname(S.dateSeance) as OldJour,S.heureSeance,ReS.nom as nomSalle
			from seances_mod SM
			join seances S on SM.codeSeance=S.codeSeance
			join enseignements E on E.codeEnseignement=S.codeEnseignement
			join ressources_profs ReP on S.codeProf=ReP.codeProf
			join seances_salles SS on S.codeSeance=SS.codeSeance
			join ressources_salles ReS on ReS.codeSalle=SS.codeRessource
			where status=0 order by codeModification DESC";
	$resultnotif=$conn->query($sqlnotif);
	if($resultnotif){
		$row_countnotif=$resultnotif->num_rows;
	}
	
?>
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
<script>$(document).ready(function () {
    setInterval(function () {
        $("#notification").load();
            }, 400);
         });
</script>
<style type="text/css">

#notification{
margin-left:95%;
margin-top:25%;
}
a.notif {
  position: relative;
  display: block;
  height: 50px;
  width: 50px;
  background: url(interface/img/notification-flat.png);
  background-size: contain;
  text-decoration: none;
}
#reglage{

margin-top:30%;
}
.reglage{
  position: relative;
  display: block;
  height: 55px;
  width: 55px;
  background: url(interface/img/reglage.png);
  background-size: contain;
  text-decoration: none;
}
.num {
  position: absolute;
  right: 5px;
  top: 2px;
  color: #fff;
  font-family:bold;
}
   
   
</style>
<meta http-equiv="refresh" content="<?php echo 90?>;URL='<?php echo "ChefUI.php"?>'">   
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
       <h5 align="center" id="toptext" >Interface Chef</h5>
        </div>
        
        
         <div id="buttons"  align="center">
         <a class="btn waves-effect z-depth-3" href="rechercheAvancee.php">Recherche Avancee</a>
         <a class="btn waves-effect z-depth-3" href="choisir.php">Affectation</a>
        <a class="btn waves-effect z-depth-3" href="gererUsers.php">Gerer utilisateurs</a>  
        
        <a  class="btn waves-effect z-depth-3" href='logout.php ' id='logout'> log out</a>
        </div>
        
        
</div>
    
   

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
        
 <?php 
 echo"<div id='notification'><a href='Notifications.php' class='notif'><span class='num'>$row_countnotif</span></a><div>";
 ?>
		
       <div id="reglage"><a href="reglage.php" class="reglage"></a></div> 
        
        
        
        
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

