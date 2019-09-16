<?php
//fetch.php

if(isset($_POST["action"]))
{
 $connect = mysqli_connect("localhost", "root", "", "mydb");
 $output = '';
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
 if($_POST["action"] == "semestre")
 {
  $query = "select T.nomFille,T.codeFille from (SELECT ReG.codeGroupe codeParent,ReG.nom nomParent,ReG2.nom nomFille,ReG2.codeGroupe codeFille
FROM 
 ressources_groupes ReG 
join hierarchies_groupes HG on HG.codeRessource=ReG.codeGroupe
join ressources_groupes ReG2 on ReG2.codeGroupe=HG.codeRessourceFille  
ORDER BY `nomParent` ASC) T WHERE codeParent  = '".$_POST["query"]."'";
  $result = mysqli_query($connect, $query);
  $output .= '<option value="">Select section</option>';
  while($row = mysqli_fetch_array($result))
  {
   $output .= '<option value="'.$row["codeFille"].'">'.$row["nomFille"].'</option>';
  }
 }
 if($_POST["action"] == "section")
 {
  $query = "select T.nomFille,T.codeFille from (SELECT ReG.codeGroupe codeParent,ReG.nom nomParent,ReG2.nom nomFille,ReG2.codeGroupe codeFille
FROM 
 ressources_groupes ReG 
join hierarchies_groupes HG on HG.codeRessource=ReG.codeGroupe
join ressources_groupes ReG2 on ReG2.codeGroupe=HG.codeRessourceFille  
ORDER BY `nomParent` ASC) T WHERE codeParent = '".$_POST["query"]."'";
  $result = mysqli_query($connect, $query);
  $output .= '<option value="">Select TD</option>';
  while($row = mysqli_fetch_array($result))
  {
   $output .= '<option value="'.$row["codeFille"].'">'.$row["nomFille"].'</option>';
  }
 }
if($_POST["action"] == "td")
 {
  $query = "select T.nomFille,T.codeFille from (SELECT ReG.codeGroupe codeParent,ReG.nom nomParent,ReG2.nom nomFille,ReG2.codeGroupe codeFille
FROM 
 ressources_groupes ReG 
join hierarchies_groupes HG on HG.codeRessource=ReG.codeGroupe
join ressources_groupes ReG2 on ReG2.codeGroupe=HG.codeRessourceFille  
ORDER BY `nomParent` ASC) T WHERE codeParent = '".$_POST["query"]."'";
  $result = mysqli_query($connect, $query);
  $output .= '<option value="">Select groupe</option>';
  while($row = mysqli_fetch_array($result))
  {
   $output .= '<option value="'.$row["codeFille"].'">'.$row["nomFille"].'</option>';
  }
 }
 echo $output;
}
?>