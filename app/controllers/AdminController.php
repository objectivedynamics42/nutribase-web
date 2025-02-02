<?php

class AdminController {
    private $view;

    public function __construct() {
        $this->view = new AdminView();
    }

    public function handleAdmin() {
        Logger::log("Processing admin request");
        try {
            $navigation = $this->createNavigation();
            $html = $this->view->renderAdmin($navigation);
            sendResponse($html, 'text/html');
        } catch (Exception $e) {
            sendResponse(["error" => $e->getMessage()], 'application/json', 500);
        }
    }

    private function createNavigation() : Navigation {
        $backLink = SharedConstants::RELATIVE_BASE_URL;
        $menu = [];

        return new Navigation($backLink, $menu);
    }
}
