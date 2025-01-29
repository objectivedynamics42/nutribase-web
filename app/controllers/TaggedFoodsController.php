<?php

require_once APP_ROOT . 'app/views/TaggedFoodsView.php';
require_once APP_ROOT . 'app/helpers/Navigation.php';

class TaggedFoodsController {
    private $repository;
    private $view;
    private $tagId;

    public function __construct(NutribaseRepository $repository, int $tagId) {
        $this->repository = $repository;
        $this->tagId = $tagId;
        $this->view = new TaggedFoodsView();
    }
    
    public function getTaggedFoods(): void {
        Logger::log("Processing tagged foods request");
        try {
            $tagResult = $this->repository->getTagById($this->tagId);
            if (empty($tagResult)) {
                sendResponse(["error" => "Tag not found"], 'application/json', 404);
                return;
            }

            Logger::log("getTaggedFoods - tagId: " . $this->tagId);

            $foods = $this->repository->getFoodsByTagId($this->tagId);
            $html = $this->view->renderFoods($this->tagId, $tagResult[0]['tagName'], $foods);
            sendResponse($html, 'text/html');
        } catch (Exception $e) {
            sendResponse(["error" => $e->getMessage()], 'application/json', 500);
        }
    }
}
