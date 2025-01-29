<?php

class Navigation {

    private string $backlinkUrl;
    private array $menu;

    public function __construct(string $backlinkUrl, array $menu) {
        $this->backlinkUrl = $backlinkUrl;
        $this->menu = $menu;
    }

    public function getBacklinkUrl() : string{
        return $this->backlinkUrl;
    }

    public function getMenu() : array {
        return $this->menu;
    }
}
