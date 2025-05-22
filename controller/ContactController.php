<?php
require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../model/ContactModel.php';

class ContactController {
    private $contactModel;

    public function __construct() {
        $this->contactModel = new ContactModel();
    }

    public function submitContactForm($data) {
        return $this->contactModel->submitForm($data);
    }
}
