<?PHP
include "../core/livraisonL.php";
include '../ti.php';
include '../core/UserController.php';
include '../core/Config.php';
include '../entities/User.php';

if(!isset($_SESSION))
{
	session_start();
}

if ( Config::getUserSession() == null ) {
	header( 'Location: ../login.php' );
} elseif ( Config::getUserSession()->getRole() != "admin" and Config::getUserSession()->getRole() != "livreur") {
	header( 'Location: ../profile/index.php' );
}

$livraisonL=new livraisonL();
if (isset($_POST["id"])){
	$idl=Config::getUserSession()->getId();
	//$id=$_POST["id"];
	

	$livraisonL->affecterLivraison($idl,$_POST["id"]);
	
}

?>