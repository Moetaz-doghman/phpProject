<?php

require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . '../phpProject/controlleur/ReclamationController.php');
$reclamationC = new ReclamationController();

// Vérifiez si l'ID est présent dans l'URL
if (isset($_GET['id'])) {
    $reclamationId = $_GET['id'];

    $reclamationC->deleteReclamation($reclamationId);

    header("Location: backReclamation.php");
    exit();
} else {
    header("Location: backReclamation.php");
    exit();
}
?>
