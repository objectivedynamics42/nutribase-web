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
        Logger::log("Processing tags request");
        try {
            syslog(LOG_ERR, "getTags called");            
            $tags = $this->repository->getAllTags();

            $navigation = $this->createNavigation();
            $html = $this->view->renderTags($tags, $navigation);

            sendResponse($html, 'text/html');
        } catch (Exception $e) {
            sendResponse(["error" => $e->getMessage()], 'application/json', 500);
        }
    }

    private function createNavigation() : Navigation {
        $menu = [
            "Hacker News" => "https://news.ycombinator.com/"
        ];
        var_dump($menu, "TagsController.createNavigation");
        die(); // Stop execution to inspect the output

        $navigation = new Navigation("XoX", $menu);

        return $navigation;
    }
}

