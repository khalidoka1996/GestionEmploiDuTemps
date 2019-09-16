<?php 
session_start();
include_once 'Methods.php';

$conn=db_connect();
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
            <link rel="stylesheet" type="text/css" href="interface/css/affectation.css">
            <script type="text/javascript" src="interface/js/jquery.min.js"></script>
            <script type="text/javascript" src="interface/js/materialize.min.js"></script>
         
         
           <script type="text/javascript" src="http://code.jquery.com/jquery-1.7.1.js"></script>
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.16/jquery-ui.js"></script>
    <link rel="stylesheet" type="text/css" href="/css/normalize.css">
    <link rel="stylesheet" type="text/css" href="/css/result-light.css">
    <link rel="stylesheet" type="text/css" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.17/themes/base/jquery-ui.css">

         
         
          
            
        
         <style>
        #formdel{
          margin-left:35%;
          margin-top:1%;
        }
         #delb{background-color:white;
       
         }
         #del{
         width:16px;
         height:16px;
         }
         #title{margin-top:10%;
         position:static;
         }
         #refresh{
         margin-left:50%;
         margin-top:0.7%;
         position:relative;
         margin-bot:0;
         height:2%;
         }
          #tablediv{
          margin-top:-7%;
      
        
          margin-left:3%;
             }
             
         #ainchock
{
    margin-right: 10%;
    margin-top: 20px;
    float: right;
    height: 100px;
    width: 100px;
    
}

#uh2c{
   
    margin-left:10%;
    margin-top: 20px;
     height: 100px;
    width: 100px;
    
}
#topbar{
     margin-top: 0px;
    height:22%;
    width:120%;
}
#top_div{
margin-top:-6%;
margin-left:21%;

			 }
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
            
             
             .pause{
                 width: 1px;
                 border: 2px solid #aaaaaa;
             }
             td, th{
    
	height:auto;

    border: 1px solid #aaaaaa;
    text-align: left;
    padding: 8px;
}
select{

font-size:12;
}

             th,.jour,.a {
    background-color: #dddddd;
    border: 1px solid #aaaaaa;
	
}
             .seance{
 	               text-align:center;
                   background-color: #eeeeee;
                   font-size: 9px;
                   font-weight: bold;
}
#but{
	margin-top:10px;
	margin-right:10%;
	float:right;
}
#logout{

	width:13%;
	font-size:75%;
	margin-right:15px;
	float:right;
	background-color:green;
}

			 #buttons{
				 margin-left:25%;
			 }	
			 
			 
			 #tablediv{
			 	width:70%;
			 }	 
        </style>
        
        
        
        <script>
  $( function() {
    $( "#dialog" ).dialog({
      autoOpen: false,
      show: {
        effect: "blind",
        duration: 1000
      },
      hide: {
        effect: "explode",
        duration: 1000
      }
    });
 
    $( "#opener" ).on( "click", function() {
      $( "#dialog" ).dialog( "open" );
    });
  } );
  </script>
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
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
       <div id="topbar" class="z-depth-2">

<img src="interface/img/logoAinchok.jpg" class="z-depth-3" id="ainchock" >
<img src="interface/img/logouh2c.jpg" class="z-depth-3" id="uh2c">
    <div id='top_div'>
       <h5 align="center" id="toptext" > Interface d'affectation</h5>
        </div>
        
        
         <div id="buttons" >

        <a class="btn waves-effect z-depth-3" href="ChefUI.php">Accueil</a>  
         <a class="btn waves-effect z-depth-3" href="rechercheAvancee.php">Recherche Avancee</a>
         <a class="btn waves-effect z-depth-3" href="gererUsers.php">Gerer utilisateurs</a>  
        
        <a  class="btn waves-effect z-depth-3" href='logout.php ' id='logout'> log out</a>
        </div>
        
        
</div>

        <div id="container">
      <form action="choisir.php" method="post">
      <input type="hidden" name="filiere" value="<?php if(isset($_POST['filiere'])) echo $_POST['filiere'];?>">
      <input type="hidden" name="section" value="<?php if(isset($_POST['section'])) echo $_POST['section'];?>">
      <input type="hidden" name="semestre" value="<?php if(isset($_POST['semestre'])) echo $_POST['semestre'];?>">
      <div id='refresh'>
      <input type="submit"  class="btn waves-effect z-depth-3 bu" value="Rafraichir">
      <a href="Statistics.php" target="_blank"><input type="button" class="btn waves-effect z-depth-3 bu" id='bton' value="Statistiques"></a>
      </div>
      </form>
      
      
             
             <form action="affectation.php" method="post">
           	<input type="hidden" name="Ok">
           	<div id="tablediv">
           	<?php 
           	if(!empty($_POST["section"])&&!empty($_POST["semestre"])&&!empty($_POST["filiere"])){
           		$sqllegend="select distinct T.nomParent from (SELECT ReG.codeGroupe codeParent,ReG.nom nomParent,ReG2.nom nomFille,ReG2.codeGroupe codeFille
				FROM 
				 ressources_groupes ReG 	
				join hierarchies_groupes HG on HG.codeRessource=ReG.codeGroupe
				join ressources_groupes ReG2 on ReG2.codeGroupe=HG.codeRessourceFille  
				ORDER BY `nomParent` ASC) T WHERE codeParent=".$_POST["section"];
           		$reslegend=$conn->query($sqllegend);
           		$rowlegend=$reslegend->fetch_assoc();
           	echo "<div id='title'><h3>".$rowlegend["nomParent"].'	:</h3></div>';
           	}
           	
           	
           	?>
            <table>
                <tr>
                    <th><p align="center">Jour/Seance</p></th>
                    <th><p align="center">Seance 1</p></th>
                    <th><p align="center">Seance 2</p></th>
                    <!--<td class="pause"></td>-->
                    <th><p align="center">Seance 3</p></th>
                    <th><p align="center">Seance 4</p></th>
                </tr>
              
                <?php 
if(isset($_POST["filiere"])||isset($_POST["Ok"])){
include_once 'Methods.php';
$codeDept=$_SESSION['dept'];
$jour_sem=1;
$selected=$_POST["section"];
$seance=1;
$tab_jours[1]='Monday';$tab_jours[2]='Tuesday';$tab_jours[3]='Wednesday';
$tab_jours[4]='Thursday';$tab_jours[5]='Friday';$tab_jours[6]='Saturday';
$tab_joursfr[1]='Lundi';$tab_joursfr[2]='Mardi';$tab_joursfr[3]='Mercredi';
$tab_joursfr[4]='Jeudi';$tab_joursfr[5]='Vendredi';$tab_joursfr[6]='Samedi';
$tab2=array();
$tabprof=array();
for($jour_sem=1;$jour_sem<7;$jour_sem++){
	echo "<tr><td class='jour'>$tab_joursfr[$jour_sem]</td>";
	
	for($seance=1;$seance<5;$seance++){
		//$code_prof=$_SESSION['code_prof'];
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
		if(empty($_POST["section"])&&empty($_POST["semestre"])){
			echo " <script type='text/javascript'>window.alert('Veuillez donner plus de precision sur la recherche');
			document.location.href='choisir.php';</script>";
		}
		else 
		
	if(empty($_POST["section"]))
		{
			
			if($_POST["filiere"]==288){
				$sql = "select dayname(S.dateSeance) as jour,S.heureSeance ,S.codeProf,ReG.nom as Groupe,
					   N.alias as Niveau,A.alias as Activite,M.nom as Module,M.codeMatiere,ReS.nom as salle,S.codeSeance as code_seance
																					from enseignements E 

											join matieres M on M.codeMatiere=E.codeMatiere 
											join niveaux N on E.codeNiveau=N.codeNiveau
                                            join types_activites A on E.codeTypeActivite=A.codeTypeActivite
											join seances S on S.codeEnseignement=E.codeEnseignement 
                                            join seances_groupes SeG on S.codeSeance=SeG.codeSeance 
					 						join ressources_groupes ReG on SeG.codeRessource=ReG.codeGroupe
											join seances_salles SeS on S.codeSeance=SeS.codeSeance 
					 						join ressources_salles ReS on SeS.codeRessource=ReS.codeSalle
								            
											where dayname(S.dateSeance)='$tab_jours[$jour_sem]' 
											and S.heureSeance=$heureSeance
	                                        and ReG.codeGroupe=".$_POST["semestre"];
			} else {
				echo " <script type='text/javascript'>window.alert('Veuillez preciser la Section');
			document.location.href='choisir.php';</script>";
			}
		}
		else {
		
		$sql = "select dayname(S.dateSeance) as jour,S.heureSeance ,S.codeProf,ReG.nom as Groupe,
					   N.alias as Niveau,A.alias as Activite,M.nom as Module,M.codeMatiere,ReS.nom as salle,S.codeSeance as code_seance
																					from enseignements E 

											join matieres M on M.codeMatiere=E.codeMatiere 
											join niveaux N on E.codeNiveau=N.codeNiveau
                                            join types_activites A on E.codeTypeActivite=A.codeTypeActivite
											join seances S on S.codeEnseignement=E.codeEnseignement 
                                            join seances_groupes SeG on S.codeSeance=SeG.codeSeance 
					 						join ressources_groupes ReG on SeG.codeRessource=ReG.codeGroupe
											join seances_salles SeS on S.codeSeance=SeS.codeSeance 
					 						join ressources_salles ReS on SeS.codeRessource=ReS.codeSalle
								            
											and dayname(S.dateSeance)='$tab_jours[$jour_sem]' 
											and S.heureSeance=$heureSeance
	                                        where ReG.codeGroupe in (".$_POST["section"].")
					or ReG.codeGroupe in ( select T.codeFille from (SELECT ReG.codeGroupe codeParent,ReG.nom nomParent,ReG2.nom nomFille,ReG2.codeGroupe codeFille
																	FROM 
																	 ressources_groupes ReG 
																	join hierarchies_groupes HG on HG.codeRessource=ReG.codeGroupe
																	join ressources_groupes ReG2 on ReG2.codeGroupe=HG.codeRessourceFille  
																	ORDER BY `nomParent` ASC) T WHERE codeParent =".$_POST["section"].")";
		}
		$result = $conn->query($sql);
	
	
	if ($result) {
			// Ecriture du 2eme tableau
			
	
	
	
	
	
	
			echo "<td><table>";
			$i=1;
			while($row = $result->fetch_assoc()) {
				
				$todeletep=-1;
				$todeletesc=-1;
				echo "";
				
				
				echo "<tr><td class='seance'>".$row["Groupe"]."</td><td><span style='font-size:12;'> " 
					  . $row["Module"]."</span></td><td><span style='font-size:12;'> ".$row["Activite"]." ".$row["salle"];
					  echo "</span></td>";
					  
					  
					  $sqldep="select M.codeDept from matieres M
    						join ressources_profs ReP on ReP.codeDept=M.codeDept
    						where M.codeMatiere=".$row["codeMatiere"];
					  $resdep=$conn->query($sqldep);
					  $rowdep=$resdep->fetch_assoc();
					  if($rowdep["codeDept"]!=$codeDept){
					  	echo "<td><div><select class='browser-default' name='prof_seance".$jour_sem.$seance."_".$i."' disabled>
				  				 		<option value='-1'>-Selectionner prof-</option>
				  				 		</select></div></td>
				  			";
					  }
					  else {
					  
					  
				$s="select codeProf,nom,prenom from ressources_profs where codeDept=$codeDept";
				$resu = $conn->query($s);
				
				echo "<td><div>
				
				 <select class='browser-default' name='prof_seance".$jour_sem.$seance."_".$i."'>"
				."<option value='-1'>-Selectionner prof-</option>";
				while($r = $resu->fetch_assoc()) {
					
				$sqlprof="select ReP.codeProf from ressources_profs ReP 
						join seances S on S.codeProf=ReP.codeProf where ReP.codeDept=$codeDept 
                   		and dayname(S.dateSeance)='$tab_jours[$jour_sem]' 
						and S.heureSeance=$heureSeance";
				$resp=$conn->query($sqlprof);
				if($resp){
						$rowcount=mysqli_num_rows($resp);
						if($rowcount!=0) {
						
						$rowp=$resp->fetch_assoc();
						
						$sqlprofex="select ReP.codeProf from ressources_profs ReP 
        				join seances S on S.codeProf=ReP.codeProf 
						where 
						S.codeProf=".$r["codeProf"]."
           				and S.codeSeance=".$row["code_seance"];
						
						$respex=$conn->query($sqlprofex);
						$p=true;
						if($respex){
							$rowcountex=mysqli_num_rows($respex);
							if($rowcountex!=0){
							echo " <option style='background-color:red' value=".$r["codeProf"]." selected>".$r["nom"]." ".$r['prenom']."</option>";	
							$todeletep=$r["codeProf"];
							$todeletesc=$row["code_seance"];
							$p=false;
							}
						
						
						
						}
						
						
						
						if($rowp["codeProf"]!=$r["codeProf"])
						{
						echo " <option value=".$r["codeProf"].">".$r["nom"]." ".$r['prenom']."</option>";
						
						}
						else {
							if($p==true)
							echo " <option style='background-color:red' value=".$r["codeProf"].">".$r["nom"]." ".$r['prenom']."</option>";
							array_push($tabprof,$row["code_seance"]);
							array_push($tabprof,$rowp["codeProf"]);
							
					}
						}				else 	echo " <option value=".$r["codeProf"].">".$r["nom"]." ".$r['prenom']."</option>";
				}
				else 	echo " <option value=".$r["codeProf"].">".$r["nom"]." ".$r['prenom']."</option>";
				
					
					
					
					
				} 
				echo "</select></div>";
				if($todeletep!=-1&&$todeletesc!=-1)
					echo "<div id='formdel'>
           					<input type='hidden' name='codePrDel' value='".$todeletep."'>
                    		<input type='hidden' name='codeScDel' value='".$todeletesc."'>
                    		
           					<a href='affectationdel.php?SI4HB1=$todeletep&NS1BS9=$todeletesc' target='_blank' ><button type='button' id='delb'>
             				<img id='del' src='interface/img/Delete.png'>
                    		</button>
                    		</a></div>";
				
				
           		echo 	"</td></tr>";

				
				array_push($tab2,$row["code_seance"],"prof_seance".$jour_sem.$seance."_".$i);
					  }
			
					  
				$i++;
			} 
			echo"</table></td>";
		
		}else{
			echo '<td></td>'; 
		}
		
	}
	echo "</tr>";
	
	
}
}
else echo " <script type='text/javascript'>window.alert('Veuillez donner plus de precision sur la recherche, retour vers la recherche');
			document.location.href='choisir.php';</script>";
?>
                
            </table>
        </div>
        <div id="but">
        	
        	<input type="hidden" name="filiere" value="<?php if(isset($_POST['filiere'])) echo $_POST['filiere'];?>">
        	<input type="hidden" name="section" value="<?php if(isset($_POST['section'])) echo $_POST['section'];?>">
        	<input type="hidden" name="semestre" value="<?php if(isset($_POST['semestre'])) echo $_POST['semestre'];?>">
 	
            <input class="btn waves-effect z-depth-3 bu" type="reset" value="reset">
            <input class="btn waves-effect z-depth-3 bu" type="submit" value="affecter">
        	</div>
            </form>
            
        </div>
    
    
    
    

    
    
    
    
   
    
        
    </body>
</html>
<?php 
	

if(isset($_POST["Ok"]))
{
	$added=0;
	$not=0;
for($j=0;$j<count($tab2);$j++)
{
	$z=$j+1;
	$cp=$_POST["$tab2[$z]"];
	if($cp!=-1)
		{
					$dont=false;
				for($compt=0;$compt<count($tabprof);$compt++){
					$comptaux=$compt+1;
					if(($tabprof[$compt]==$tab2[$j]) && ($tabprof[$comptaux]==$cp)){
						$dont=true;
					}


					$compt++;
				}


				if($dont==false){	
				$sqlupdate="update seances set codeProf=$cp where codeSeance=$tab2[$j]";
				if($conn){
					$resul = $conn->query($sqlupdate);
					if($resul){
						$added++;
						}
					}else $not++;
				}else {
					//requete pour vérifier si prof=prof/seance=seance
					$sqlcheck="select * from seances 
								where codeSeance=$tab2[$j] 
								and codeProf=$cp";
					$rescheck=$conn->query($sqlcheck);
					
					if($rescheck){
						$rowcheck=mysqli_num_rows($rescheck);
						if($rowcheck==0){
							$sqlgetJH="select dayname(S.dateSeance) as jour,S.heureSeance from seances S where codeSeance=$tab2[$j]";
								
							$resJH=$conn->query($sqlgetJH);
							$rowJH=$resJH->fetch_assoc();
								
							$sqldont="select dayname(S.dateSeance) as jour,ReP.nom as nomProf,ReP.prenom as prenomProf,S.heureSeance ,S.codeProf,ReG.nom as Groupe,
											   N.alias as Niveau,A.alias as Activite,M.nom as Module,ReS.nom as salle,S.codeSeance as code_seance
																											from enseignements E
				
																	join matieres M on M.codeMatiere=E.codeMatiere
																	join niveaux N on E.codeNiveau=N.codeNiveau
						                                            join types_activites A on E.codeTypeActivite=A.codeTypeActivite
																	join seances S on S.codeEnseignement=E.codeEnseignement
						                                            join seances_groupes SeG on S.codeSeance=SeG.codeSeance
											 						join ressources_groupes ReG on SeG.codeRessource=ReG.codeGroupe
																	join seances_salles SeS on S.codeSeance=SeS.codeSeance
											 						join ressources_salles ReS on SeS.codeRessource=ReS.codeSalle
														            join ressources_profs ReP on ReP.codeProf=S.codeProf
																	where dayname(S.dateSeance)='".$rowJH["jour"]."'
							                                         and S.heureSeance=".$rowJH["heureSeance"]."
													                                         and S.codeProf=$cp";
							$resdont=$conn->query($sqldont);
							$rowdont=$resdont->fetch_assoc();
							switch ($rowdont["jour"]) {
								case 'Monday':
									$jourdont='Lundi';
									break;
								case 'Tuesday':
									$jourdont='Mardi';
									break;
								case 'Wednesday':
									$jourdont='Mercredi';
									break;
								case 'Thursday':
									$jourdont='Jeudi';
									break;		
								case 'Friday':
									$jourdont='Vendredi';
									break;
								case 'Saturday':
									$jourdont='Samedi';
									break;
							}




							echo "<script type='text/javascript'>
							var r=confirm('Ce professeur: ".$rowdont["nomProf"]." ".$rowdont["prenomProf"]." a deja une autre seance avec ".$rowdont["Groupe"]." > ".$rowdont["Niveau"]. " de : "
															. $rowdont["Module"]." de type ".$rowdont["Activite"]." le : ".$jourdont.">".$rowdont["heureSeance"]." Voulez vous ecraser l autre seance quand meme ? (ceci ouvrira un nouvel onglet pour permettre la modification de l autre seance.)');
															if(r==true){
							
															var win = window.open('ExecAffec.php?cY71DH=$cp&UD4nf16=$tab2[$j]&B183AxZ=".$rowdont["code_seance"]."', '_blank');
							
							}
							else {
							
							}
							</script>";
																
							
						}
					}
					
				}
		}

$j++;
}
echo "<script type='text/javascript'> alert('$added profs ajoute. $not champs saute.');
	</script>";
echo "<form id='form_choisir' method='POST' action='choisir.php'>
       <input type='hidden' name='filiere' value='".$_POST['filiere']."'>
	<input type='hidden' name='section' value='".$_POST['section']."'>
	<input type='hidden' name='semestre' value='".$_POST['semestre']."'>   
             		
             		
      </form>"	;
echo "<script type='text/javascript'>
	document.getElementById('form_choisir').submit();
	</script>";


}

?>
	

