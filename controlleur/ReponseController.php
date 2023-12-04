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
        $sql = "SELECT r.id, r.reclamation_id, r.contenu , rc.id_user, rc.sujet, rc.description
                FROM reponses r
                JOIN reclamations rc ON r.reclamation_id = rc.id";

        $result = $this->db->query($sql);

        $responses = [];

        if ($result !== false) {
            while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                // Créez d'abord la Réclamation
                $reclamation = new Reclamation($row['sujet'], $row['description'] , $row['id_user']);
                $reclamation->setId($row['reclamation_id']);

                // Puis créez la Réponse en associant la Réclamation
                $response = new Reponse($reclamation, $row['contenu']);
                $response->setId($row['id']);

                $responses[] = $response;
            }
        }

        return $responses;
    }

    public function deleteResponseById($responseId) {
        $sql = "DELETE FROM reponses WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id', $responseId, PDO::PARAM_INT);

        try {
            $stmt->execute();
            return true; // La suppression s'est bien déroulée
        } catch (PDOException $e) {
           
            return false;
        }
    }

    public function createReponse($reclamationId, $contenu) {
        try {
            // Préparez votre requête SQL avec des paramètres nommés
            $sql = 'INSERT INTO reponses (reclamation_id, contenu) VALUES (:reclamation_id, :contenu)';

            // Utilisez la méthode préparée pour éviter les injections SQL
            $stmt = Config::getConnexion()->prepare($sql);

            // Liez les valeurs aux paramètres de la requête
            $stmt->bindParam(':reclamation_id', $reclamationId, PDO::PARAM_INT);
            $stmt->bindParam(':contenu', $contenu, PDO::PARAM_STR);

            // Exécutez la requête
            $stmt->execute();

            // Si vous avez besoin de l'ID de la réponse nouvellement ajoutée, vous pouvez le récupérer
            $lastInsertedId = Config::getLastInsertedId();
            
            // Vous pouvez effectuer d'autres actions si nécessaire, comme rediriger l'utilisateur ou afficher un message de réussite
        } catch (PDOException $e) {
            // En cas d'erreur, vous pouvez gérer l'exception ici (par exemple, journalisation, affichage d'un message d'erreur, etc.)
            die('Erreur lors de l\'ajout de la réponse : ' . $e->getMessage());
        }
    }

    public function updateReponse($responseId, $contenu) {
        try {
            $sql = 'UPDATE reponses SET contenu = :contenu WHERE id = :responseId';
    
            $stmt = Config::getConnexion()->prepare($sql);
    
            $stmt->bindParam(':responseId', $responseId, PDO::PARAM_INT);
            $stmt->bindParam(':contenu', $contenu, PDO::PARAM_STR);
    
            $stmt->execute();
    
        } catch (PDOException $e) {
            die('Erreur lors de la mise à jour de la réponse : ' . $e->getMessage());
        }
    }

    public function getReponseById($responseId) {
        $sql = "SELECT r.id, r.reclamation_id, r.contenu, rc.sujet, rc.description , rc.id_user
                FROM reponses r
                JOIN reclamations rc ON r.reclamation_id = rc.id
                WHERE r.id = :responseId";
    
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':responseId', $responseId, PDO::PARAM_INT);
        $stmt->execute();
    
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
    
        if ($row !== false) {
            // Créez d'abord la Réclamation
            $reclamation = new Reclamation($row['sujet'], $row['description'] , $row['id_user']);
            $reclamation->setId($row['reclamation_id']);
    
            // Puis créez la Réponse en associant la Réclamation
            $response = new Reponse($reclamation, $row['contenu']);
            $response->setId($row['id']);
    
            return $response;
        } else {
            // La réponse n'a pas été trouvée
            return null;
        }
    }
    
    

   

   

  
}

    
