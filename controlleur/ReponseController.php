<?php

require_once(realpath($_SERVER["DOCUMENT_ROOT"]) .'../phpProject/config.php');
require_once(realpath($_SERVER["DOCUMENT_ROOT"]) .'../phpProject/model/Reponse.php');

class ReponseController {
    private $db;

    public function __construct() {
        $this->db = new config();
    }

    public function createResponse($reclamationId, $contenu) {
        $response = new Reponse($reclamationId, $contenu);

        $sql = "INSERT INTO reponses (reclamation_id, contenu) VALUES ('$reclamationId', '$contenu')";
        $result = $this->db->executeQuery($sql);

        if ($result) {
            $responseId = $this->db->getLastInsertedId();
            $response->setId($responseId);
            return $response;
        } else {
            return false;
        }
    }

    public function getResponse($id) {
        $sql = "SELECT * FROM reponses WHERE id = $id";
        $result = $this->db->executeQuery($sql);

        if ($result && $result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $response = new Reponse($row['reclamation_id'], $row['contenu']);
            $response->setId($row['id']);
            return $response;
        } else {
            return false;
        }
    }

    public function updateResponse($id, $contenu) {
        $sql = "UPDATE reponses SET contenu = '$contenu' WHERE id = $id";
        return $this->db->executeQuery($sql);
    }

    public function deleteResponse($id) {
        $sql = "DELETE FROM reponses WHERE id = $id";
        return $this->db->executeQuery($sql);
    }

    // Ajoutez d'autres méthodes au besoin
}
