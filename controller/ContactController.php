<?php
require_once __DIR__ . '/../model/ContactModel.php';

class ContactController {

    private $contactModel;

    public function __construct() {
        $this->contactModel = new ContactModel();
    }

    public function submitForm($postData) {
        // Validate input (this could be further enhanced)
        if (empty($postData['name']) || empty($postData['email']) || empty($postData['message'])) {
            $_SESSION['message'] = "All fields are required!";
            header('Location: ' . BASE_URL . 'view/contact.php');
            exit;
        }

        // Insert contact form data into the database
        $isSubmitted = $this->contactModel->submitForm($postData);

        if ($isSubmitted) {
            $_SESSION['message'] = "Thank you for contacting us! We'll get back to you shortly.";
        } else {
            $_SESSION['message'] = "There was an error submitting your message. Please try again.";
        }

        header('Location: ' . BASE_URL . 'view/contact.php');
        exit;
    }
}
