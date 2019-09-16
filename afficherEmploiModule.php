<?php 
session_start();
?>
<html>
<head>
<style>
         input{
         	height:35px;	
         }
             .op{
                 width: 100%;
                 margin: auto;
             }
             .select{
                align-self: center;
                 
             }
             #tablediv{
                 width: auto;
                 margin: auto;
                 margin-top:1%;
                 
                 border: 2px solid #aaaaaa;
                 
             }
             table {
   
    border: 2px solid #aaaaaa;
    width: auto;
    
}
             .pause{
                 width: 1px;
                 border: 2px solid #aaaaaa;
             }
             td, th{
    
	height:auto;
    width:70px;
    border: 2px solid #aaaaaa !important;
    text-align: left;
    padding: 8px;
}
select{

font-size:12;
}

             th,.jour,.a {
    background-color: #dddddd;
    border: 2px solid #aaaaaa;
	width:100px;
}
             .seance{
 	               text-align:center;
                   background-color: #eeeeee;
                   font-size: 9px;
                   font-weight: bold;
                   border: 2px solid #aaaaaa !important;
}
#but{
	margin-top:10px;
	margin-right:10%;
	float:right;
}
        </style>
        
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
     
    
<div id="container">
    <div id="topbar" class="z-depth-2">

<img src="interface/img/logoAinchok.jpg" class="z-depth-3" id="ainchock" >
<img src="interface/img/logouh2c.jpg" class="z-depth-3" id="uh2c">
    <div id='top_div'>
       <h5 align="center" id="toptext" > Affichage </h5>
        </div>
        
        
         <div id="buttons"  align="center">
         <a class="btn waves-effect z-depth-3" href="<?php  if(isset($_SESSION['connect'])){
                                    if($_SESSION['connect']!=1)
         	                         {echo 'index.php';}
         	                         elseif ($_SESSION['connect']==1){
					         		switch($_SESSION['user_type']){
										case 'pr':echo 'ProfUI.php'; break;
										case 'cd':echo 'chefUI.php'; break;
									}}}
									else echo "index.php";  ?>
													" id='acceuil'>accueil</a>
         
  <?php       if(isset($_SESSION['connect'])){
                         if($_SESSION['connect']!=1)
         	             {echo "<a class='btn waves-effect z-depth-3' href='RechercheAv.php'>Recherche Avancee</a> <a  class='btn waves-effect z-depth-3' href='login.php ' id='login'> login</a>
         	             ";}
                          else echo " <a class='btn waves-effect z-depth-3' href='rechercheAvancee.php'>Recherche Avancee</a><a  class='btn waves-effect z-depth-3' href='logout.php' id='login'> log out</a>
                          ";
  			} else echo "<a class='btn waves-effect z-depth-3' href='RechercheAv.php'>Recherche Avancee</a> <a  class='btn waves-effect z-depth-3' href='login.php ' id='login'> login</a>";
        ?>
        </div>
        
        
</div>
    </div>

 <div id="tablediv" >
        
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

if(isset($_POST["filiere"])){
$conn=db_connect();
$jour_sem=1;
$seance=1;
$tab_jours[1]='Monday';$tab_jours[2]='Tuesday';$tab_jours[3]='Wednesday';
$tab_jours[4]='Thursday';$tab_jours[5]='Friday';$tab_jours[6]='Saturday';
$tab_joursfr[1]='Lundi';$tab_joursfr[2]='Mardi';$tab_joursfr[3]='Mercredi';
$tab_joursfr[4]='Jeudi';$tab_joursfr[5]='Vendredi';$tab_joursfr[6]='Samedi';
for($jour_sem=1;$jour_sem<7;$jour_sem++){
	echo "<tr><td class='jour'>$tab_joursfr[$jour_sem]</td>";
	
	for($seance=1;$seance<5;$seance++){
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
		if (isset($_POST["semestre"]) && isset($_POST["sous_filiere"]) && isset($_POST["module"]))
		{
			$sql = "select dayname(S.dateSeance) as jour,S.heureSeance ,Rep.nom,Rep.prenom,S.codeProf,ReG.nom as Groupe, m.codeMatiere,
			N.alias as Niveau,A.alias as Activite,M.nom as Module,ReS.nom as salle
			from enseignements E
			
			join matieres M on M.codeMatiere=E.codeMatiere
			join niveaux N on E.codeNiveau=N.codeNiveau
			join types_activites A on E.codeTypeActivite=A.codeTypeActivite
			join seances S on S.codeEnseignement=E.codeEnseignement
			left join ressources_profs Rep on Rep.codeProf=S.codeProf
			join seances_groupes SeG on S.codeSeance=SeG.codeSeance
			join ressources_groupes ReG on SeG.codeRessource=ReG.codeGroupe
			join seances_salles SeS on S.codeSeance=SeS.codeSeance
			join ressources_salles ReS on SeS.codeRessource=ReS.codeSalle
			and dayname(S.dateSeance)='$tab_jours[$jour_sem]'
			and S.heureSeance=$heureSeance
			where m.codeMatiere =".$_POST["module"]."";
		}
		
	$result = $conn->query($sql);
	$row_count=$result->num_rows;
	if ($row_count>0) {
			// output data of each row
			
		echo "<td><table >";
		$i=1;
		while($row = $result->fetch_assoc()) {
		
		
			echo "";
		
		
			echo "<tr><td class='seance'>".$row["Groupe"]."</td><td class='seance'><span style='font-size:12;'> "
					. $row["Module"]."</span></td><td class='seance'><span style='font-size:12;'> ".$row["Activite"]." ".$row["salle"];
					echo "</span></td><td class='seance'><span style='font-size:12;'>".$row["nom"]."-".$row["prenom"]."</span></td>";
						 			
		}
		echo"</table></td>";
		
			
		
		}else{
			echo '<td></td>'; 
		}
		
	}
	echo "</tr>";
	
	
}
}

?>
</table>
</div>








        
</body>
</html>