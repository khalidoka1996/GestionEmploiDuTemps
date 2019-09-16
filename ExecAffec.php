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
         #buttns{
         margin-top:1%;
         margin-left:55%;
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
          margin-top:5%;
          position:static;
          width: 80%;
          margin-left:13%;
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
            
             table {
   border: 0px solid #aaaaaa;
    width: 80%;
}
             .pause{
                 width: 1px;
                 border: 2px solid #aaaaaa;
             }
             td, th{
    
	height:auto;
    width:70px;
    border: 2px solid #aaaaaa;
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
       <h5 align="center" id="toptext" > Chef Interface </h5>
        </div>
        
        
         <div id="buttons" >
         <a class="btn waves-effect z-depth-3" href="rechercheAvancee.php">Recherche Avancee</a>
         <a class="btn waves-effect z-depth-3" href="choisir.php">Modifier</a>
        <a class="btn waves-effect z-depth-3" href="gererUsers.php">Gerer utilisateurs</a>  
        
        <a  class="btn waves-effect z-depth-3" href='logout.php ' id='logout'> log out</a>
        </div>
        
        
</div>


<?php 
if(isset($_GET["cY71DH"]) && isset($_GET["UD4nf16"])&&isset($_GET["B183AxZ"])){
	$codeDept=$_SESSION['dept'];
	$cp=$_GET["cY71DH"];
	$cs=$_GET["UD4nf16"];
	$csnot=$_GET["B183AxZ"];
	
	$sqlupdate="update seances set codeProf=$cp where codeSeance=$cs";
	$resul = $conn->query($sqlupdate);
	if($resul){
		echo "<script type='text/javascript'>
				var r=confirm('Prof ecrase avec succes, voulez vous choisir un autre prof pour la seance ?');
						if(r==false){window.close();}
				</script>";
	}else echo "<script type='text/javascript'>
				var s=confirm('il y a eu un probleme lors de la modification. Voulez vous quand memechoisir un autre prof pour la seance ?');
				if(r==false){window.close();}
				</script>";
	
	
	
	
	// code Seance > day/heure
	
	$sqlgetJH="select dayname(S.dateSeance) as jour,S.heureSeance from seances S where codeSeance=$cs";
	
	$resJH=$conn->query($sqlgetJH);
	$rowJH=$resJH->fetch_assoc();
	
	$sqlsc="select dayname(S.dateSeance) as jour,ReP.nom as nomProf,ReP.codeDept as codeDeptProf,ReP.prenom as prenomProf,S.heureSeance ,S.codeProf,ReG.nom as Groupe,
											   N.alias as Niveau,A.alias as Activite,M.codeMatiere,M.codeDept as codeDeptMatiere,M.nom as Module,ReS.nom as salle,S.codeSeance as code_seance
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
																	where S.codeSeance=$csnot";
	$ressc=$conn->query($sqlsc);
	if($ressc){
		$rowsc=$ressc->fetch_assoc();
			switch($rowsc["jour"]){
				case 'Monday'    : $jour='Lundi'; break;
				case 'Tuesday'   : $jour='Mardi'; break;
				case 'Wednesday' : $jour='Mercredi'; break;
				case 'Thursday'  :$jour='Jeudi'; break;
				case 'Friday'    :$jour='Vendredi'; break;
				case 'Saturday'  :$jour='Samedi'; break;
			}



		echo "<form action='ExecAffec.php' method='POST'>
 
    		
    		
    		<div id='tablediv'>
    		<table><tr><th><p align='center'>Jour/Seance</p></th>
                    <th><p align='center'>Seance </p></th></tr>
    		<tr><td class='seance'>".$jour."</td><td class='seance'>
          		<table><tr><td class='seance'>".$rowsc["Groupe"]."</td><td><span style='font-size:12;'> " 
				 . $rowsc["Module"]."</span></td><td><span style='font-size:12;'> "
    			.$rowsc["Activite"]." ".$rowsc["salle"];
				  echo "</span></td>";
				  
				  //on teste si on essai bien de moddifier le bon departement
          			$sqldep="select M.codeDept from matieres M 
    						join ressources_profs ReP on ReP.codeDept=M.codeDept
    						where M.codeMatiere=".$rowsc["codeMatiere"];
          			$resdep=$conn->query($sqldep);
          			$rowdep=$resdep->fetch_assoc();
          			if($rowdep["codeDept"]!=$codeDept){
          				echo "<td><div><select class='browser-default' name='prof_seanceSC' disabled>
				  				 		<option value='-1'>-Selectionner prof-</option>
				  				 		</select></div></td>
				  			";
          			}
				  else {
				  
				  $s="select codeProf,nom,prenom from ressources_profs where codeDept=$codeDept";
				  $resu = $conn->query($s);
				  
				  echo "<td><div>
				  
				 <select class='browser-default' name='prof_seanceSC'>"
				  				 		."<option value='-1'>-Selectionner prof-</option>";
				  				 		while($r = $resu->fetch_assoc()) {
				  				 				
				  				 			$sqlprof="select ReP.codeProf from ressources_profs ReP
				  				 			join seances S on S.codeProf=ReP.codeProf where ReP.codeDept=$codeDept
				  				 			and dayname(S.dateSeance)='".$rowsc["jour"]."'
				  				 			and S.heureSeance=".$rowsc["heureSeance"];
				  				 			$resp=$conn->query($sqlprof);
				  				 			if($resp){
				  				 				$rowcount=mysqli_num_rows($resp);
				  				 				if($rowcount!=0) {
				  
				  				 					$rowp=$resp->fetch_assoc();
				  
				  							$sqlprofex="select ReP.codeProf from ressources_profs ReP
        						join seances S on S.codeProf=ReP.codeProf
								where
								S.codeProf=".$r["codeProf"]."
           						and S.codeSeance=".$rowsc["code_seance"];
				  
				  				 					$respex=$conn->query($sqlprofex);
				  				 					$p=true;
				  				 					if($respex){
				  				 						$rowcountex=mysqli_num_rows($respex);
				  				 						if($rowcountex!=0){
				  				 							echo " <option style='background-color:red' value=".$r["codeProf"]." 
        													selected>".$r["nom"]." ".$r['prenom']."</option>";
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
				  				 					}
				  				 				}				else 	echo " <option value=".$r["codeProf"].">".$r["nom"]." ".$r['prenom']."</option>";
				  				 			}				  				 				
				  				 				
				  				 				
				  				 				
				  				 		}
				  				 		echo "</select></div>";
				  } 
				  
				  
				  
				  
				  
				  
				  
				  
				  
     		
     		
     		
   echo 	"</table>
    			</td></tr>
    		</table>
        		</div>
        	<input type='hidden' name='cp' value='$cp'>
 		    <input type='hidden' name='csnot' value='$csnot'>
 <div id='buttns'>
 			<button type='button' class='btn waves-effect z-depth-3 bu'
        		onclick='window.close();'>Annuler</button>
            <input class='btn waves-effect z-depth-3 bu' type='submit' value='affecter'>	
 </div>
 			</form>
    		";
		
		
	}

	
	
	
}else
	if(isset($_POST["prof_seanceSC"])){
		$cp=$_POST["cp"];
		$csnot=$_POST["csnot"];
		
		$sqlup="update seances S set codeProf=".$_POST["prof_seanceSC"]."
		where codeProf=$cp
		and S.codeSeance=$csnot";
		$resuld = $conn->query($sqlup);
		if($resuld){
			echo "<script type='text/javascript'>alert('Le nouveau prof a bien ete affecte');
			window.close();
			</script>";
		}
	
	}
?>











</body></html>
