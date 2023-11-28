<?php

require_once(realpath($_SERVER["DOCUMENT_ROOT"]) .'../phpProject/config.php');
require_once(realpath($_SERVER["DOCUMENT_ROOT"]) .'../phpProject/model/Reponse.php');
require_once(realpath($_SERVER["DOCUMENT_ROOT"]) .'../phpProject/model/Reclamation.php');


class ReponseController {
    private $db;

    public function __construct() {
        $this->db = Config::getConnexion();
    }

    public function getAllResponses() {
        $sql = "SELECT r.id, r.reclamation_id, r.contenu, rc.sujet, rc.description
                FROM reponses r
                JOIN reclamations rc ON r.reclamation_id = rc.id";

        $result = $this->db->query($sql);

        $responses = [];

        if ($result !== false) {
            while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                // Créez d'abord la Réclamation
                $reclamation = new Reclamation($row['sujet'], $row['description']);
                $reclamation->setId($row['reclamation_id']);

                // Puis créez la Réponse en associant la Réclamation
                $response = new Reponse($reclamation, $row['contenu']);
                $response->setId($row['id']);

                $responses[] = $response;
            }
        }

        return $responses;
    }
}

    
