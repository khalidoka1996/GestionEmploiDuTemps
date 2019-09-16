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
<html>
<head>
<style>
#nothing{
margin-top:2%;
}
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
.num {
  position: absolute;
  right: 5px;
  top: 2px;
  color: #fff;
  font-family:bold;
}
   
   
#tablediv{
width:80%;
margin-left:11%;

}
#tableid{
 border: 1px solid #aaaaaa;
    width: 80%;
    align:center;
}	
  td, th{
    
	height:auto;
    width:16%;
    border: 2px solid #aaaaaa;
    text-align: left;
    padding: 8px;
}
        </style>
     <meta http-equiv="refresh" content="<?php echo 10?>;URL='<?php echo "Notifications.php"?>'">   
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta charset="UTF-8">
<script type="text/javascript" src="interface/js/jquery.min.js"></script>
<link rel="stylesheet" type="text/css" href="interface/css/index.css">
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
</head>
<body>
     
    
<div id="container">
    <div id="topbar" class="z-depth-2">

<img src="interface/img/logoAinchok.jpg" class="z-depth-3" id="ainchock" >
<img src="interface/img/logouh2c.jpg" class="z-depth-3" id="uh2c">
    <div id='top_div'>
       <h5 align="center" id="toptext" > Notifications </h5>
        </div>
        
        
         <div id="buttons"  align="center">
         <a class="btn waves-effect z-depth-3" href="chefUI.php" id='acceuil'>accueil</a>
                 	             
                          
                          <a class='btn waves-effect z-depth-3' href='rechercheAvancee.php'>Recherche Avancee</a><a  class='btn waves-effect z-depth-3' href='logout.php' id='login'> log out</a>
                         
        </div>
       
       
       
       
       
       
        </div>
        </div>
        
        
        
        
       
        
        
        
        
        
        
        
        
        
  <?php 
  include_once 'Methods.php';
  $conn=db_connect();
  $sql="select SM.date,SM.heure,SM.codeModification,SM.salle,E.nom as nomEnseignement,ReP.nom as nomProf,ReP.prenom as prenomProf,
			dayname(S.dateSeance) as OldJour,S.heureSeance,ReS.nom as nomSalle
			from seances_mod SM 
			join seances S on SM.codeSeance=S.codeSeance
			join enseignements E on E.codeEnseignement=S.codeEnseignement
			join ressources_profs ReP on S.codeProf=ReP.codeProf
			join seances_salles SS on S.codeSeance=SS.codeSeance
			join ressources_salles ReS on ReS.codeSalle=SS.codeRessource
			where status=0 order by codeModification DESC";
  $result=$conn->query($sql);
  if($result){
  $row_count=$result->num_rows;
	if ($row_count>0) {
		echo "<div id='tablediv' align='center'><table id='tableid'>
  		<th>Enseignement</th>
  		<th>Professeur</th>
  		<th>An. Jour</th>
  		<th>An. Seance</th>
  		<th>Nv. Jour</th>
  		<th>Nv. Seance</th>
		<th>An. Salle</th>
		<th>Nv. Salle</th>
  		<th>Action</th>
  		";
		while($row=$result->fetch_assoc())
		{  		
			$oseance='';
			
			switch ($row["heureSeance"]){
				case 830:$oseance='08h30-10h00';
				break;
				case 1015:$oseance='10h15-11h45';
				break;
				case 1245:$oseance='12h45-14h15';
				break;
				case 1430:$oseance='14h30-16h00';
				break;
			}
			$nseance='';
				
			switch ($row["heure"]){
				case 830:$nseance='08h30-10h00';
				break;
				case 1015:$nseance='10h15-11h45';
				break;
				case 1245:$seance='12h45-14h15';
				break;
				case 1430:$nseance='14h30-16h00';
				break;
			}
			$sqlsalle="select ReS.nom as nomSalle
			from ressources_salles ReS 
			where ReS.codeSalle=".$row["salle"];
			$ressalle=$conn->query($sqlsalle);
			$rows=$ressalle->fetch_assoc();
			$idd=$row["codeModification"];
			echo  "<form action='ConfirmNotification.php' method='POST'>";
			echo "<tr>
  				  <td>".$row["nomEnseignement"]."</td>
 				  <td>".$row["nomProf"]." ".$row["prenomProf"]."</td>
  				  <td>".$row["OldJour"]."</td>
     			  <td>".$oseance."</td>
     			  <td>".$row['date']."</td>
  				  <td>".$nseance."</td>
				  <td>".$row["nomSalle"]."</td>	
				  <td>".$rows["nomSalle"]."</td>
			<input type='number' style='visibility:hidden; width:0px; height:0px;' name='idd' value='$idd' >";
			echo "<td><input type='submit' name='OK' value='Valider'>";
			echo "<input type='submit'  name='OK' value='Refuser'></td></tr></form>";
			
			
		} 
		echo "</table></div>";
	} else
		
		echo "<div align='center' id='nothing'><h4>Vous n'avez aucune notification pour l'instant.</h3></div>";
  }
  echo"<div id='notification'><a href='Notifications.php' class='notif'><span class='num'>$row_count</span></a><div>";
  
  ?>      
        
        
      </body>
      </html>  
        
        
        
        
        
        
        
        
        
        
        

        
        
        
        
        
        
        
        
        
        
        
        
        