<?php

// Controller Layer - Handles request processing and orchestration
class NutribaseController {
    private $repository;
    private $view;

    public function __construct(NutribaseRepository $repository, NutribaseView $view) {
        $this->repository = $repository;
        $this->view = $view;
    }
/*
    public function geetTags(): void {
        try {
            $tags = $this->repository->getAllTags();
            $html = $this->view->renderTags($tags);
            sendResponse($html, 'text/html');
        } catch (Exception $e) {
            sendResponse(["error" => $e->getMessage()], 'application/json', 500);
        }
    }

    public function geetFoods(int $tagId): void {
        try {
            $tagResult = $this->repository->getTagById($tagId);
            if (empty($tagResult)) {
                sendResponse(["error" => "Tag not found"], 'application/json', 404);
                return;
            }

            $foods = $this->repository->getFoodsByTagId($tagId);
            $html = $this->view->renderFoods($tagResult[0]['tagName'], $foods);
            sendResponse($html, 'text/html');
        } catch (Exception $e) {
            sendResponse(["error" => $e->getMessage()], 'application/json', 500);
        }
    }

    public function geetSingleFood(int $foodId): void {
        try {
            $food = $this->repository->getFoodById($foodId);
            if (empty($food)) {
                sendResponse(["error" => "Food not found"], 'application/json', 404);
                return;
            }

            $html = $this->view->renderSingleFood($food[0]);
            sendResponse($html, 'text/html');
        } catch (Exception $e) {
            sendResponse(["error" => $e->getMessage()], 'application/json', 500);
        }
    }

    public function loogin(){
        $html = "<html><body>Log In</body></html>";
        sendResponse($html, 'text/html');
    }
*/        
}

