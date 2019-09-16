<?php 
session_start();

if(isset($_SESSION['connect'])){
if($_SESSION['connect']!=1)
{
	echo"<script type='text/javascript'>alert('Vous devez etre connecte pour acceder a cette page !');
			document.location.href='index.php';</script>";


}else{
	if($_SESSION['user_type']!='cd'){

		echo"<script type='text/javascript'>alert('Redirection vers la page adequate.');
			document.location.href='index.php';</script>";
	}
}
}else 
	echo"<script type='text/javascript'>window.alert('Vous devez etre connecte pour acceder a cette page !');
			document.location.href='index.php';</script>";

?>
<?php
include ("/jpgraph-4.0.2/src/jpgraph.php");
include ("/jpgraph-4.0.2/src/jpgraph_bar.php");


define('MYSQL_HOST', 'localhost');
define('MYSQL_USER', 'root');
define('MYSQL_PASS', '');
define('MYSQL_DATABASE', 'mydb');

$code=$_SESSION['dept'];


//$code=$_SESSION['dept'];
$sql = "
	SELECT  
		nom AS nom,
		ROUND(volumeMax,2) AS vh  
		
	FROM ressources_profs
	where codedept=$code
	order by volumeMax Desc;
	";


$mysqlCnx = @mysql_connect(MYSQL_HOST, MYSQL_USER, MYSQL_PASS) or die('Pb de connxion mysql');

@mysql_select_db(MYSQL_DATABASE) or die('Pb de sélection de la base');

$mysqlQuery = @mysql_query($sql, $mysqlCnx) or die('Pb de requête');
$tab1=array();
$tab2=array();

while ($row = mysql_fetch_array($mysqlQuery,  MYSQL_ASSOC)) {
	array_push($tab1, $row['nom']);
	//$tab1[$row['nom']] = ' ' . $row['nom'];
	$tab2[] = $row['vh'];
}

/*
printf('<pre>%s</pre>', print_r($tableauAnnees,1));
printf('<pre>%s</pre>', print_r($tableauNombreVentes,1));
*/

// *******************
// Création du graphique
// *******************


// Construction du conteneur
// Spécification largeur et hauteur
$graph = new Graph(1500,800);

// Réprésentation linéaire
$graph->SetScale("textlin");

// Ajouter une ombre au conteneur
$graph->SetShadow();

// Fixer les marges
$graph->img->SetMargin(40,20,50,120);

// Création du graphique histogramme
$bplot = new BarPlot($tab2);

// Spécification des couleurs des barres
$bplot->SetFillColor(array('red', 'blue', 'green'));
// Une ombre pour chaque barre
$bplot->SetShadow();

// Afficher les valeurs pour chaque barre
$bplot->value->Show();
// Fixer l'aspect de la police
$bplot->value->SetFont(FF_ARIAL,FS_NORMAL,9);
// Modifier le rendu de chaque valeur
$bplot->value->SetFormat('%f');

// Ajouter les barres au conteneur
$graph->Add($bplot);

// Le titre
$graph->title->Set("VH de professeurs du département");
$graph->title->SetFont(FF_FONT1,FS_BOLD);

// Titre pour l'axe horizontal(axe x) et vertical (axe y)
//$graph->xaxis->title->Set("Années");
//$graph->yaxis->title->Set("Nombre de ventes");
 
$graph->xaxis->SetTickLabels($tab1); 
$graph->xaxis->SetLabelAngle(90);
//$graph->yaxis->title->SetFont(FF_FONT1,FS_BOLD);
//$graph->xaxis->title->SetFont(FF_FONT1,FS_BOLD);

// Légende pour l'axe horizontal
//$graph->xaxis->SetTickLabels($tableauAnnees);

// Afficher le graphique
$graph->Stroke();

?>