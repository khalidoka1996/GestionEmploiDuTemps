<?php
include_once 'Methods.php';
$conn=db_connect();
if(isset($_POST['OK']))
{
	if($_POST['OK']=='Valider')
	{






						$sqlmodifs="select codeSeance,date,heure,salle from seances_mod 
								where codeModification=".$_POST['idd'];
						$resmodifs=$conn->query($sqlmodifs);
						$rowmodifs=$resmodifs->fetch_assoc();
							$sqldate="select Distinct dayname(dateSeance) as jour,dateSeance 
									from seances where dateSeance<'2016-10-09'
									and dayname(dateSeance)='".$rowmodifs["date"]."'";
							$resdate=$conn->query($sqldate);
							$rowdate=$resdate->fetch_assoc();



					// on teste si la salle demandée est pleine a ce moment ou pas

						$sqltestsalle="select S.codeSeance 
									from seances S join seances_salles SS on S.codeSeance=SS.codeSeance
									where
										 S.heureSeance=".$rowmodifs["heure"]." 
									and  S.dateSeance='".$rowdate["dateSeance"]."'
									and SS.codeRessource=".$rowmodifs["salle"];
						$restestsalle=$conn->query($sqltestsalle);
						$numrowstestsalle=mysqli_num_rows($restestsalle);
						if($numrowstestsalle>0)
							echo "<script type='text/javascript'> 
									alert('Impossible d\'accepter la demande, la salle demandee est deja pleine en ce moment');
									document.location.href='Notifications.php';
									</script>";







				$sqlv="update seances_mod set Valide=1 where codeModification=".$_POST['idd'];
				$sqls="update seances_mod set status=1 where codeModification=".$_POST['idd'];
				$result=$conn->query($sqlv);
				$ress=$conn->query($sqls);
					if($result)
					{
						
						
							$sqlupsalle="update seances_salles set codeRessource=".$rowmodifs["salle"]." where codeSeance=".$rowmodifs["codeSeance"];
							$resup2=mysqli_query($conn,$sqlupsalle);
							if(!$resup2) echo "<script type='text/javascript'>alert('".mysqli_error($conn)."')</script>";
						$sqlup="update seances set dateSeance='".$rowdate["dateSeance"]."',
								heureSeance=".$rowmodifs["heure"]." 
								where codeSeance=".$rowmodifs["codeSeance"];
						$resup1=$conn->query($sqlup);
						
							
							
								if($resup2){
									echo"<script type='text/javascript' >document.location.href='Notifications.php';

										</script>";
								}else echo "<script type='text/javascript' >alert('Ce changement de salle est impossible ".$rowmodifs["salle"]." ".$rowmodifs["codeSeance"]."');
										document.location.href='Notifications.php';
										</script>";
								
						
						}
					else{
						echo"<script type='text/javascript'>alert('Un probleme est survenu.');
								document.location.href='Notifications.php';
								</script>";
					}






	}
	else 
	{
		$sqlr="update seances_mod set status=1 where codeModification=".$_POST['idd'];
		$resr=$conn->query($sqlr);
	                if($resr)
					{
						echo"<script>alert('La Seance a ete refusee');
								document.location.href='Notifications.php';
								</script>";
					}
					else{
						echo"<script>alert('Un probleme est survenu.');
								document.location.href='Notifications.php';
								</script>";
					}
	}
	
}