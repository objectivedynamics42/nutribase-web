<?php

class LoginController {
    private $repository;
    private $view;

    public function __construct(NutribaseRepository $repository) {
        $this->repository = $repository;
        $this->view = new LoginView();
    }

    public function login(){
        Logger::log("Processing login request");
        try {
            $html = $this->view->renderLogin();
            sendResponse($html, 'text/html');
        } catch (Exception $e) {
            sendResponse(["error" => $e->getMessage()], 'application/json', 500);
        }
    }

    public function handleLogin(string $userName, string $password){
        Logger::log("Posting login response");
        try {
            Logger::log("Rendering logged in page");
            $html = $this->view->renderLoggedIn();
            Logger::log("Sending logged in response");
            sendResponse($html, 'text/html');
        } catch (Exception $e) {
            sendResponse(["error" => $e->getMessage()], 'application/json', 500);
        }
    }
}