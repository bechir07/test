<?PHP
include "../core/livraisonL.php";
$livraisonL=new livraisonL();
if (isset($_POST["id"])){
	$livraisonL->supprimerLivraison($_POST["id"]);
	
}

?>