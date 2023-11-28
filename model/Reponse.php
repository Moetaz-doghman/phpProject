<?php
class Reponse {

    private $id;
    private $reclamationId;
    private $contenu;
    private $created_at;
    private $updated_at;

    public function __construct($reclamationId, $contenu) {
        $this->reclamationId = $reclamationId;
        $this->contenu = $contenu;
    }

    public function getId() {
        return $this->id;
    }

    public function getReclamationId() {
        return $this->reclamationId;
    }

    public function setReclamationId($reclamationId) {
        $this->reclamationId = $reclamationId;
    }

    public function getContenu() {
        return $this->contenu;
    }

    public function setContenu($contenu) {
        $this->contenu = $contenu;
    }

    public function getCreatedAt() {
        return $this->created_at;
    }

    public function getUpdatedAt() {
        return $this->updated_at;
    }
}
