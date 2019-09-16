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
<html>
<head>
<style>
#options_container{
    margin-top: 100px;
    width: 60%;
    margin:auto;
    margin-left: 26%

}
    .select{
    float:left;
    width:150px;
    margin: auto;
    margin-right: 2%;
    margin-top: 3%;
}
      .select1{
    float:left;
    width:200px;
    margin: auto;
    margin-right: 2%;
    margin-top: 3%;
}
#typerech{
margin-top:1%;
margin-left:40%;
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
margin-left:15%;
	}
#buttons{
	width:70%;
	float:right;
	margin-right:1%;
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
#tablediv{
                 width: 80%;
                 margin: auto;
                 margin-top: 15%;
             
                 
             }
             table {
   
    border: 1px solid #aa0000;
    width: 80%;
    
}
 .pause{
                 width: 1px;
                 border: 2px solid #aaaaaa;
             }
 .tdc, .thc{
   text-align: center;
	height:auto;
    width:auto;
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
       

</style>

    
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta charset="UTF-8">
<script type="text/javascript" src="js/jquery.min.js"></script>
<link rel="stylesheet" type="text/css" href="interface/css/materialize.min.css">

<script type="text/javascript" src="interface/js/jquery.min.js"></script>
<script type="text/javascript" src="interface/js/materialize.min.js"></script>
</head>
    <body> 
        <div id="container">
    <div id="topbar" class="z-depth-2">

<img src="interface/img/logoAinchok.jpg" class="z-depth-3" id="ainchock" >
<img src="interface/img/logouh2c.jpg" class="z-depth-3" id="uh2c">
    
    <div id="top_div">
     <div>
       <h5 align="center" id="toptext" > Changement de seance </h5>
        </div>
        
        
         <div id="buttons"  align="center">
         
         <a class="btn waves-effect z-depth-3" href="<?php 
         		if(isset($_SESSION['connect']))
         	{
         		if($_SESSION['connect']==1)
         		{
         			switch($_SESSION['user_type']){
					case 'pr':echo 'ProfUI.php'; break;
					case 'cd':echo 'chefUI.php'; break;
					}
        	 	}
			}?>									
		">accueil</a>
         
  
          <a  class="btn waves-effect z-depth-3" href='logout.php' id='logout'> log out</a>
        </div>
        
        </div>
       </div>
            
       <?php 
include_once 'Methods.php';
  $connect=db_connect();
       $seanceAmodifier='';
       if (isset($_POST["jour"])&& isset($_POST["seance"])){

       	
       $sql="select s.codeProf,pr.nom nomprof, dayname(s.dateSeance) as jour,s.dateSeance as jourFull,s.codeSeance,e.codeEnseignement,s.heureSeance ,e.nom ensg ,rs.codeSalle,tss.nom nomType,rs.nom,tss.codeTypeSalle from ressources_salles rs 
       																join seances_salles ss on rs.codeSalle=ss.codeRessource 
																	join seances s on s.codeSeance=ss.codeSeance
																	join enseignements e on e.codeEnseignement=s.codeEnseignement
																	JOIN typage_salles ts ON ts.codeSalle=rs.codeSalle
																	JOIN types_salles tss on tss.codeTypeSalle=ts.codeType
																	join ressources_profs pr on s.codeProf=pr.codeProf
																	WHERE s.codeProf=".$_SESSION["code_prof"]."
																	and dayname(s.dateSeance)='".$_POST['jour']."'
																	and s.heureseance=".$_POST['seance'].";";
       $result = mysqli_query($connect, $sql);
       if(mysqli_num_rows($result)==0){
       	echo "<script type='text/javascript'>alert('La seance selectionnee n existe pas.');
								document.location.href='modifierProf.php';
					</script>";
       }
       $row=$result->fetch_assoc();
       $seance='';
      
       switch ($row["heureSeance"]){
      	 case 830:$seance='08h30-10h00';
      	    break;
      	 case 1015:$seance='10h15-11h45';
      	    break;
      	 case 1245:$seance='12h45-14h15';
      	    break;
      	 case 1430:$seance='14h30-16h00';
      	    break;
       }
       
       $seanceAmodifier.='<td class="thc">'.$row["jour"].'</td><td class="thc">'.$seance.'</td><td class="thc">'.$row["ensg"].'</td><td class="thc">'.$row["nomType"].'->'.$row["nom"].'</td><td class="thc">Seance a modifier</td>';
       
       
       }
       
       ?>     
           
            
            
            
            
            <div id="tablediv">
            
            <table >
                <tr>
                    <th class="thc">
                                    Jour      
                    </th>
                    <th class="thc">
                    Seance
                    </th>
                    <th class="thc">enseignement</th>
                    <th class="thc">
                Salle
                    </th>
                    <th class="thc">Modifier/Ajouter</th>
                </tr>
                <tr>
                <?php echo $seanceAmodifier;?>
                </tr>
                <tr>
                <?php 
                $tab_jours[1]='Monday';$tab_jours[2]='Tuesday';$tab_jours[3]='Wednesday';
				$tab_jours[4]='Thursday';$tab_jours[5]='Friday';$tab_jours[6]='Saturday';
				//nspj=nombre de seances par jour
				$nspj=array();
				
				for($jour_sem=1;$jour_sem<7;$jour_sem++){
                $sql2="select s.codeProf,pr.nom nomprof, dayname(s.dateSeance) as jour,s.heureSeance ,e.nom ensg ,rs.codeSalle,tss.nom nomType,rs.nom,tss.codeTypeSalle from ressources_salles rs 
       																join seances_salles ss on rs.codeSalle=ss.codeRessource 
																	join seances s on s.codeSeance=ss.codeSeance
																	join enseignements e on e.codeEnseignement=s.codeEnseignement
																	JOIN typage_salles ts ON ts.codeSalle=rs.codeSalle
																	JOIN types_salles tss on tss.codeTypeSalle=ts.codeType
																	join ressources_profs pr on s.codeProf=pr.codeProf
                                                                    WHERE s.codeProf=".$_SESSION['code_prof']."
                                                                    and dayname(s.dateSeance)='".$tab_jours[$jour_sem]."' ;";
               $result2 = $connect->query($sql2);
            
                $nspj[$jour_sem-1] = $result2->num_rows;
				}
				
$jours='';
$jour_s=0;
$row3=array();

for($jour_s=0;$jour_s<6;$jour_s++){
			
				if ($nspj[$jour_s]<4){
				array_push($row3,$tab_jours[$jour_s+1]);
				
				}
				
			
				
						
        
               }
                   
                

                
                ?>
                
                
                
                
                
                
                <form method="post" action="modifExec.php" target="_blank">
                
        	    <input type="hidden" name="codeSeance" value="<?php echo $row["codeSeance"];?>">   
             
                
                    <td class="thc">    <div class="select">
   
                                              <select name="jours" id="jours"  class="browser-default form-control action">
                                                <option value="" disabled selected>Select Jour</option>
                                               <?php foreach($row3 as $val){
              													 echo "<option value=".$val.">".$val."</option>";
               																}         
                                               ?>


                                              </select>
                                           </div>
                    </td>
                    <td class="thc">   <div class="select">
                              <select name="seance" id="seance" class="browser-default form-control action">
                                <option value="" disabled selected>select Seance</option>
                             
                              </select>
                        </div>
                    </td>
                    <td class="thc"><?php echo $row["ensg"];?></td>
                    <td class="thc">   
                          <div class="select">
                                              <select name="salle"  id="salle" class="browser-default form-control ">
                                                  <option value="" disabled selected>Select Salle</option></select>
                                            </div></td>
                    <td class="thc"><button class="btn waves-effect z-depth-3" type="submit">Modifier</button></td>
                    </form>
                </tr>
            </table>
                </div>
    
    
        </div>
    </body>
</html><script>
$(document).ready(function(){
 $('.action').change(function(){
  if($(this).val() != '')
  {
   var action = $(this).attr("id");
   var query = $(this).val();
   var result = '';
   if(action == "jours")
   {
    result = 'seance';
   }
   if(action == "seance")
   {
    result = 'salle';
   }
  var query2=$('#jours').val();
   $.ajax({
    url:"fetchmodifier.php",
    method:"POST",
    data:{action:action, query:query,query2:query2},
    success:function(data){
     $('#'+result).html(data);
    }
   })
  }
 });
});
</script>
