<?php 

session_start();

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
	
	if($_SESSION['user_type']!='pr'){

		echo"<script type='text/javascript'>alert('Redirection vers la page adequate.');
			document.location.href='index.php';</script>";
	}
}
}else 
	echo"<script type='text/javascript'>window.alert('Vous devez etre connecte pour acceder a cette page !');
			document.location.href='index.php';</script>";

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
<style type="text/css">
#reglage{
position: relative;
margin-left:95%;

}
table {
   
    border: 2px solid #aaaaaa;
    width: auto;
    
}
.seance{
                 text-align:center;
                   background-color: #eeeeee;
                   font-size: 9px;
                   font-weight: bold;
                  border: 2px solid #aaaaaa !important;   
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
</style>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta charset="UTF-8">
<script type="text/javascript" src="interface/js/jquery.min.js"></script>
<link rel="stylesheet" type="text/css" href="interface/css/profUI.css">
<link rel="stylesheet" type="text/css" href="interface/css/materialize.css">
<script type="text/javascript" src="interface/js/jquery.min.js"></script>
<script type="text/javascript" src="interface/js/materialize.min.js"></script>
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
    <div  id="top_div">
    	<div>
       <h5 align="center" id="toptext" > Interface Prof  (<?php echo $_SESSION['name']?>)</h5>
        </div>
        
        
         <div id="buttons"  align="center">
         <a class="btn waves-effect z-depth-3" href="rechercheAvancee.php">Recherche Avancee</a>
         <a class="btn waves-effect z-depth-3" href="modifierProf.php">Changer seance</a>
                 
          <a  class="btn waves-effect z-depth-3" href='logout.php' id='logout'> log out</a>
        </div>
     </div>
        
</div>
    
  
    
    
    


 
    <div id="tableau" >
        
        <table >

   <tr>
      <th>Jour/Seance</th>
    <th>Seance 1</th>
    <th>Seance 2</th>
    <th>Seance 3</th>
    <th>Seance 4</th>
  </tr>
  

<?php 
include_once 'Methods.php';
$conn=db_connect();
$code_prof=$_SESSION['code_prof'];
$jour_sem=1;
$seance=1;
$tab_jours[1]='Monday';$tab_jours[2]='Tuesday';$tab_jours[3]='Wednesday';
$tab_jours[4]='Thursday';$tab_jours[5]='Friday';$tab_jours[6]='Saturday';
$tab_joursfr[1]='Lundi';$tab_joursfr[2]='Mardi';$tab_joursfr[3]='Mercredi';
$tab_joursfr[4]='Jeudi';$tab_joursfr[5]='Vendredi';$tab_joursfr[6]='Samedi';

for($jour_sem=1;$jour_sem<7;$jour_sem++){
	echo "<tr><td class='jour'>$tab_joursfr[$jour_sem]</td>";
	
	for($seance=1;$seance<5;$seance++){
		$code_prof=$_SESSION['code_prof'];
		$heureSeance=0;
		switch ($seance){
			case 1:$heureSeance=830;
				   break;
			case 2:$heureSeance=1015;
				   	break;
			case 3:$heureSeance=1245;
			   		break;
			case 4:$heureSeance=1430;
					break;
		}
		$sql = "select dayname(S.dateSeance) as jour,S.heureSeance ,S.codeProf,ReG.nom as Groupe,
					   N.alias as Niveau,A.alias as Activite,M.nom as Module,ReS.nom as salle
																					from enseignements E 

											join matieres M on M.codeMatiere=E.codeMatiere 
											join niveaux N on E.codeNiveau=N.codeNiveau
                                            join types_activites A on E.codeTypeActivite=A.codeTypeActivite
											join seances S on S.codeEnseignement=E.codeEnseignement 
                                            join seances_groupes SeG on S.codeSeance=SeG.codeSeance 
					 						join ressources_groupes ReG on SeG.codeRessource=ReG.codeGroupe
											join seances_salles SeS on S.codeSeance=SeS.codeSeance 
					 						join ressources_salles ReS on SeS.codeRessource=ReS.codeSalle
											where S.codeProf=$code_prof 
											and dayname(S.dateSeance)='$tab_jours[$jour_sem]' 
											and S.heureSeance=$heureSeance";
	$result = $conn->query($sql);
	$row_count=$result->num_rows;
	if ($row_count>0) {
			// output data of each row
			
			while($row = $result->fetch_assoc()) {
				echo "<td><table border='1'><tr><td class='seance'>".$row["Groupe"]."</td><td class='seance'><span style='font-size:12;'> " 
            . $row["Module"]."</span></td><td class='seance'><span style='font-size:12;'> ".$row["Activite"]." ".$row["salle"];
            echo "</span></td></tr></table></td>";
			}
		
		}else{
			echo '<td></td>'; 
		}
		
	}
	echo "</tr>";
	
	
}

?>
</table>
</div>




  
 <br>   
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