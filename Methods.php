
<?php

function db_connect()
{
	// Connects to the database
	// Database name  : project
	// username = root
	// password =                    (blank)


	$conn=new mysqli('localhost','root','','mydb');
	if($conn->error){
		echo "<script type='text/javascript'>window.alert('La connexion a echoue.');</script>";
		return null;
	} else //echo "Connected.";
		return $conn;

}



function user_list(){


$conn=db_connect();
$codeDep=$_SESSION['dept'];
	$sql = "SELECT U.id_user,substr(U.login_user,1,length(U.login_user)-5) as nom_user,lower(ReP.prenom) as prenom,
		U.type_user,D.nom departement,replace(U.login_user,' ','') as login
			from users U
            join ressources_profs ReP on U.id_user=ReP.codeProf+5
			join chef_departement C on ReP.codeDept=C.codeDept
            join departement D on ReP.codeDept=D.codeDept 
			where type_user='pr' and ReP.codeDept=$codeDep";
	$result = $conn->query($sql);

	if ($result->num_rows > 0) {
		// output data of each row
		echo "<div id='result_tab'><table id='myTable' >
					 <tr class='header'><th onclick='sortTable(0)'>Id</th>
					 <th onclick='sortTable(1)'>Nom</th>
					 <th onclick='sortTable(2)'>Prenom</th>
				     <th onclick='sortTable(3)'>Login</th>
					 <th>Actions</th></tr>
					";
		while($row = $result->fetch_assoc()) {
			$id=$row["id_user"];
			echo "<form action='gererUsers.php' Method='POST' id='$id'><tr><td>" . $row["id_user"]. " </td><td> " . rtrim($row["nom_user"]). "</td><td> " . $row["prenom"]."</td><td> " . $row["login"]."</td><td>
				 
				  <input type='number' style='visibility:hidden; width:0px; height:0px;' name='id' value='$id' >
				  <input type='submit' name='delete_button' value='Delete'>";
		          
			      
				 
				  
			echo	 " </td></tr>
				  </form>"
					;
		}
		echo"</table></div>";
	} else {
		echo "0 results";
	}
}


?>
<html>
<head>
<script type="text/javascript" src="interface/js/methods.js"></script>
</head>
<body>

</body>

</html>