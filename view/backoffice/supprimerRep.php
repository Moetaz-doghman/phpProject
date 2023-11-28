<?php

require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . '../phpProject/controlleur/ReponseController.php');
$reponseC = new ReponseController();

// Vérifiez si l'ID est présent dans l'URL
if (isset($_GET['id'])) {
    $reponseId = $_GET['id'];

    $reponseC->deleteResponseById($reponseId);

    header("Location: index.php");
    exit();
} else {
    header("Location: index.php");
    exit();
}
?>
