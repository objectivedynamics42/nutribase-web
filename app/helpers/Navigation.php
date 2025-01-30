<?php

class Navigation {

    private string $backlinkUrl;
    private array $menu;

    public function __construct(string $backlinkUrl, array $menu) {
        $this->backlinkUrl = $backlinkUrl;
        $this->menu = $menu;
        var_dump($this->menu, "Navigation.__construct");
        die(); // Stop execution to inspect the output
    }

    public function getBacklinkUrl() : string{
        return $this->backlinkUrl;
    }

    //TODO this probably breaks encapsulation
    public function getMenu() : array {
        return $this->menu;
    }
}
