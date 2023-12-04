<?php

require_once(realpath($_SERVER["DOCUMENT_ROOT"]) .'../phpProject/config.php');
require_once(realpath($_SERVER["DOCUMENT_ROOT"]) .'../phpProject/model/Reclamation.php');

class ReclamationController {
    private $db;

    public function __construct() {
        $this->db = new Config(); // Utilisez le nom de classe correct, Config au lieu de config
    }

    public function createReclamation($sujet, $description,$id_user) {
        $reclamation = new Reclamation($sujet, $description,$id_user);

        $sql = "INSERT INTO reclamations (sujet, description , id_user) VALUES ('$sujet', '$description' , '$id_user')";
        $result = $this->db->executeQuery($sql);

        if ($result) {
            $reclamationId = $this->db->getLastInsertedId();
            $reclamation->setId($reclamationId);
            return $reclamation;
        } else {
            return false;
        }
    }

    public function getReclamation($id) {
        $sql = "SELECT * FROM reclamations WHERE id = $id";
        $result = $this->db->executeQuery($sql);

        if ($result && $result->rowCount() > 0) { // Utilisez rowCount() au lieu de num_rows
            $row = $result->fetch();
            $reclamation = new Reclamation($row['sujet'], $row['description'] , $row['id_user']);
            $reclamation->setId($row['id']);
            // Ajoutez les réponses associées à la réclamation ici si nécessaire
            return $reclamation;
        } else {
            return false;
        }
    }

    public function updateReclamation($id, $sujet, $description) {
        $sql = "UPDATE reclamations SET sujet = '$sujet', description = '$description' WHERE id = $id";
        return $this->db->executeQuery($sql);
    }

    public function deleteReclamation($id) {
        $sql = "DELETE FROM reclamations WHERE id = $id";
        return $this->db->executeQuery($sql);
    }

  

    public function getAllReclamations() {
        $sql = "SELECT * FROM reclamations";
        $result = $this->db->executeQuery($sql);

        $reclamations = [];

        if ($result && $result->rowCount() > 0) {
            while ($row = $result->fetch()) {
                $reclamation = new Reclamation($row['sujet'], $row['description'] ,  $row['id_user']);
                $reclamation->setId($row['id']);
                $reclamation->setCreatedAt($row['created_at']); 
                $reclamations[] = $reclamation;
            }
        }

        return $reclamations;
    }

    public function getReclamationsByUserId($userId) {
        $sql = "SELECT * FROM reclamations WHERE id_user = $userId";
        $result = $this->db->executeQuery($sql);
    
        $reclamations = [];
    
        if ($result && $result->rowCount() > 0) {
            while ($row = $result->fetch()) {
                $reclamation = new Reclamation($row['sujet'], $row['description'], $row['id_user']);
                $reclamation->setId($row['id']);
                $reclamation->setCreatedAt($row['created_at']); 
                $reclamations[] = $reclamation;
            }
        }
    
        return $reclamations;
    }
    

  
 
    
}
