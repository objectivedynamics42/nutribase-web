<?php

require_once APP_ROOT . 'app/views/FoodItemView.php';

class FoodItemController {
    private $repository;
    private $view;
    private $foodId;
    private $tagId;

    public function __construct(NutribaseRepository $repository, int $foodId, int $tagId) {
        $this->repository = $repository;
        $this->foodId = $foodId;
        $this->tagId = $tagId;
        $this->view = new FoodItemView();
    }

    public function getFoodItem(): void {
        Logger::log("Processing food item request");
        try {
            $food = $this->repository->getFoodById( $this->foodId);
            if (empty($food)) {
                sendResponse(["error" => "Food not found"], 'application/json', 404);
                return;
            }

            $html = $this->view->renderFoodItem($this->tagId, $food[0]);
            sendResponse($html, 'text/html');
        } catch (Exception $e) {
            sendResponse(["error" => $e->getMessage()], 'application/json', 500);
        }
    }
}
