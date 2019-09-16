<?php
session_start();

//fetch.php

if(isset($_POST["action"]))
{
$hrsc[1]=830;
$hrsc[2]=1015;
$hrsc[3]=1245;
$hrsc[4]=1430;
$jourselected='';
 $connect = mysqli_connect("localhost", "root", "", "mydb");
 $output = '';
  $output2 = '';
 if($_POST["action"] == "jours")
 {
		
  $output .= '<option value="">Select seance</option>';
//$jourselected=$_POST['query'];
// on teste pour chaque seance si le groupe qu'on cherche y a une seance, si on trouve rien on marque la seance , sinon on la saute
 for($k=0;$k<5;$k++){
  $query = "select ReG.codeGroupe,S.heureSeance
							from ressources_groupes ReG join seances_groupes SG on ReG.codeGroupe=SG.codeRessource
                            							join seances S on SG.codeSeance=S.codeSeance
                            where dayname(S.dateSeance)='".$_POST["query"]."'
                            and heureSeance=".$hrsc[$k]."
                            and codeGroupe=
                            		";
  $result = mysqli_query($connect, $query);
  $nrow = mysqli_num_rows($result);
  // si on trouve ligne>0 -> le groupe a deja une autre seance ici et donc on ecrit rien
  
  
 }
 /*   if($nrow>0){
  while($row = mysqli_fetch_array($result))
  {for ($i=1;$i<5;$i++){
  if($hrsc[$i]!=$row["heureSeance"]){
					  $nsc='';
					  switch($hrsc[$i]){
					  case 830:$nsc='seance 1';
					  break;
					  case 1015:$nsc='seance 2';
					  break;
					  case 1245:$nsc='seance 3';
					  break;
					  case 1430:$nsc='seance 4';
					  break;
  						 }
  						 
  
   $output .= '<option value="'.$hrsc[$i].'">'.$nsc.'</option>';
  }
 

  
  }
  
  }
  
  }else {
*/
  for ($j=1;$j<5;$j++){
 
					  $nsca='';
					  switch($hrsc[$j]){
					  case 830:$nsca='seance 1';
					  break;
					  case 1015:$nsca='seance 2';
					  break;
					  case 1245:$nsca='seance 3';
					  break;
					  case 1430:$nsca='seance 4';
					  break;
  					
  						 
					    }
   $output2 .= '<option value="'.$hrsc[$j].'">'.$nsca.'</option>';
    
 

  
  }
  
  
 }
 

if($_POST["action"] == "seance")
 { 

  $query = "select rs.codeSalle,tss.nom nomType,rs.nom from ressources_salles rs 
											JOIN typage_salles ts ON ts.codeSalle=rs.codeSalle 
											JOIN types_salles tss on tss.codeTypeSalle=ts.codeType 
											where rs.codeSalle 
											not in
											( select rs.codeSalle from ressources_salles rs 
											join seances_salles ss on rs.codeSalle=ss.codeRessource 
											join seances s on s.codeSeance=ss.codeSeance 
											join enseignements e on e.codeEnseignement=s.codeEnseignement 
											JOIN typage_salles ts ON ts.codeSalle=rs.codeSalle 
											JOIN types_salles tss on tss.codeTypeSalle=ts.codeType 
											where dayname(s.dateSeance)='".$_POST["query2"]."' and s.heureSeance = ".$_POST['query'].")";
  $result = mysqli_query($connect, $query);
  $output .= '<option value="">Select salle</option>';
  while($row = mysqli_fetch_array($result))
  {
   $output .= '<option value="'.$row["codeSalle"].'">'.$row["nom"].'</option>';
  }
 }
 echo $output;
  echo $output2;
}
?>