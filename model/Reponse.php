<?php

class Reponse {

    private $id;
    private $reclamation;
    private $contenu;
    private $created_at;
    private $updated_at;

    public function __construct(Reclamation $reclamation, $contenu) {
        $this->reclamation = $reclamation;
        $this->contenu = $contenu;
    }

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getReclamation() {
        return $this->reclamation;
    }

    public function setReclamation($reclamation) {
        $this->reclamation = $reclamation;
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
