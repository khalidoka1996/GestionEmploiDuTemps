<?php
//fetch.php
if(isset($_POST["action"]))
{
 $connect = mysqli_connect("localhost", "root", "", "mydb");
 $output = '';
 //-----------------------------------------------------------------------
 if($_POST["action"] == "filiere")
 { 
  $query = "select T.nomFille,T.codeFille from (SELECT ReG.codeGroupe codeParent,ReG.nom nomParent,ReG2.nom nomFille,ReG2.codeGroupe codeFille
FROM 
 ressources_groupes ReG 
join hierarchies_groupes HG on HG.codeRessource=ReG.codeGroupe
join ressources_groupes ReG2 on ReG2.codeGroupe=HG.codeRessourceFille  
ORDER BY `nomParent` ASC) T WHERE codeParent = '".$_POST["query"]."'";
  $result = mysqli_query($connect, $query);
  $output .= '<option value="">Select semestre</option>';
  while($row = mysqli_fetch_array($result))
  {
   $output .= '<option value="'.$row["codeFille"].'">'.$row["nomFille"].'</option>';
  }
 }
 //---------------------------------------------------------------
 if($_POST["action"] == "semestre")
 {
  $query = "select T.nomFille,T.codeFille from (SELECT ReG.codeGroupe codeParent,ReG.nom nomParent,ReG2.nom nomFille,ReG2.codeGroupe codeFille
FROM 
 ressources_groupes ReG 
join hierarchies_groupes HG on HG.codeRessource=ReG.codeGroupe
join ressources_groupes ReG2 on ReG2.codeGroupe=HG.codeRessourceFille  
ORDER BY `nomParent` ASC) T WHERE codeParent  = '".$_POST["query"]."'";
  $result = mysqli_query($connect, $query);
  $output .= '<option value="">Select sous filiere</option>';
  while($row = mysqli_fetch_array($result))
  {
   $output .= '<option value="'.$row["codeFille"].'">'.$row["nomFille"].'</option>';
  }
 }
 //---------------------------------------------------------
 if($_POST["action"] == "sous_filiere")
 {
  $query = "select DISTINCT M.codeMatiere,M.nom nomModule from seances S join enseignements E on S.codeEnseignement=E.codeEnseignement
						join enseignements_groupes EG on E.codeEnseignement=EG.codeEnseignement
                        join ressources_groupes ReG on ReG.codeGroupe=EG.codeRessource
                        join matieres M on M.codeMatiere=E.codeMatiere
                        where ReG.codeGroupe ='".$_POST["query"]."'";
  $result = mysqli_query($connect, $query);
  $output .= '<option value="">Select Module</option>';
  while($row = mysqli_fetch_array($result))
  {
   $output .= '<option value="'.$row["codeMatiere"].'">'.$row["nomModule"].'</option>';
  }
 }

 echo $output;
}
?>