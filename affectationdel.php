<?php 
include_once 'Methods.php';
$conn=db_connect();
if(isset($_GET['SI4HB1'])&&isset($_GET['NS1BS9'])){
	$sqldel="update seances set codeProf=NULL where codeSeance=".$_GET["NS1BS9"]."
												and codeProf=".$_GET["SI4HB1"]."
			";
	$resdel=$conn->query($sqldel);
	if($resdel){
	
		echo "<script type='text/javascript'>alert('Le professeur a bien ete enleve de la seance, Veuillez appuyer sur le bouton Rafraichir pour voir l effet de cette action !');
		window.close();
							
					</script>";
	}
	

}