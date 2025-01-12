<?php

require_once APP_ROOT . 'app/views/LoginView.php';

class LoginController {
    private $repository;
    private $view;

    public function __construct(NutribaseRepository $repository) {
        $this->repository = $repository;
        $this->view = new LoginView();
    }

    public function login(){
        try {
            $html = $this->view->renderLogin();
            sendResponse($html, 'text/html');
        } catch (Exception $e) {
            sendResponse(["error" => $e->getMessage()], 'application/json', 500);
        }
    }
}