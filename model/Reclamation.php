<?php
class Reclamation {
    private $id;
    private $sujet;
    private $description;
    private $responses = []; // tableau pour stocker les réponses associées
    private $created_at;
    private $updated_at;

    public function __construct($sujet, $description) {
        $this->sujet = $sujet;
        $this->description = $description;
    }

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getSujet() {
        return $this->sujet;
    }


    public function setSujet($sujet) {
        $this->sujet = $sujet;
    }

    public function getDescription() {
        return $this->description;
    }

    public function setDescription($description) {
        $this->description = $description;
    }

    public function addResponse(Response $response) {
        $this->responses[] = $response;
    }

    public function getResponses() {
        return $this->responses;
    }
    public function getCreatedAt() {
        return $this->created_at;
    }

    public function getUpdatedAt() {
        return $this->updated_at;
    }
}
