<?php
//fetch.php
if(isset($_POST["action"]))
{echo "oui";
 $connect = mysqli_connect("localhost", "root", "", "mydb");
 $output = '';
 if($_POST["action"] == "a")
 { 
  $query = "SELECT rs.codesalle,rs.nom as nomSalle,ts.codeTypeSalle,ts.nom as nomTypeSalle FROM
            types_salles ts join typage_salles typa on ts.codetypesalle=typa.codeType
							join ressources_salles rs on rs.codeSalle=typa.codeSalle 
							where codeTypeSalle = '".$_POST["query"]."'";
  $result = mysqli_query($connect, $query);
  $output .= '<option value="">Select Salle</option>';
  while($row = mysqli_fetch_array($result))
  {
   $output .= '<option value="'.$row["codesalle"].'">'.$row["nomSalle"].'</option>';
  }
 }
 
 echo $output;
}
?>