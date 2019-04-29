<?PHP
include "../core/livreurC.php";
$livreurC=new livreurC();
if (isset($_POST["id"])){
	$livreurC->supprimerLivreur($_POST["id"]);
	header('Location: afficherLivraison.php');
}

?>