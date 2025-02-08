<?php

class AddUserController {
    private const PEPPER = "++67*Root*Thirteen*Taste*73++"; // Store this securely
    private const HASH_COST = 12; // Adjust based on the server's capabilities

    private $repository;

    public function __construct(AuthRepository $repository) {
        $this->repository = $repository;
    }
 
    public function addUser(string $email, string $password){
        Logger::log("AddUserController::addUser called for user: " . $email);

        $this->repository->createUser($email, $password);

        $html =
        "<html>" .
        "<title>Add User</title>" .
        "<body>" . $email . "</body>" .
        "</html>";

        sendResponse($html, 'text/html');
    }

    public function register(string $email, string $password): void {
        Logger::log("AddUserController::register called for email: " . $email);

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new Exception('Invalid email format');
        }
        
        // Check if email already exists
        if ($this->repository->findUserByEmail($email)) {
            throw new Exception('Email already registered');
        }
        
        // Hash password with pepper
        $hashedPassword = password_hash(
            $password . self::PEPPER,
            PASSWORD_DEFAULT,
            ['cost' => self::HASH_COST]
        );
        
        $this->repository->createUser($email, $hashedPassword);

        $html =
        "<html>" .
        "<title>Register User</title>" .
        "<body>" . $email . "</body>" .
        "</html>";

        sendResponse($html, 'text/html');
    }
}