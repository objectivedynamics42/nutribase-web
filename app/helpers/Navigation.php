<?php

class Navigation {

    private string $backlinkUrl;

    public function __construct(string $backlinkUrl) {
        $this->backlinkUrl = $backlinkUrl;
    }

    public function getBacklinkUrl() : string{
        return $this->backlinkUrl;
    }
}