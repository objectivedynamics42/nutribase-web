<?php

require_once APP_ROOT . 'app/views/TagsView.php';

class TagsController {
    private $repository;
    private $view;

    public function __construct(NutribaseRepository $repository) {
        $this->repository = $repository;
        $this->view = new TagsView();
    }

    public function getTags(): void {
        try {
            $tags = $this->repository->getAllTags();
            $html = $this->view->renderTags($tags);
            sendResponse($html, 'text/html');
        } catch (Exception $e) {
            sendResponse(["error" => $e->getMessage()], 'application/json', 500);
        }
    }

    public function login(){
        $html = "<html><body>Log In</body></html>";
        sendResponse($html, 'text/html');
    }
}

