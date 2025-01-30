<?php

function renderMenu(array $menu) : string{

    $menuMarkup = "";
    foreach ($menu as $caption => $url) {
        $menuItemMarkup = 
        "<li><a class=\"dropdown-item\" href=\"" . $url . "\">". $caption ."</a></li>";

        $menuMarkup .= $menuItemMarkup;
    }

    return $menuMarkup;
}

function renderNavigation(array $menu){
    return
    "<!-- helpers.renderNavigation -->" .
    "<div class=\"col d-flex justify-content-end\">" .
        "<div class=\"dropdown\">" .
            "<a href=\"#\" class=\"btn btn-link text-white text-decoration-none dropdown-toggle\" " .
            "id=\"accountDropdown\" " .
            "role=\"button\" " .
            "data-bs-toggle=\"dropdown\" " .
            "aria-expanded=\"false\" " .
            "aria-label=\"Account\">" .
                "<img src=\"/images/account.svg\" alt=\"Account\" width=\"30\" height=\"30\">" .
            "</a>" .
            "<ul class=\"dropdown-menu dropdown-menu-end\" aria-labelledby=\"accountDropdown\">" .
                renderMenu($menu) .
            "</ul>" .
        "</div>" .
    "</div>";
}

function renderBacklink(string $backLinkHref){
    $backLink = "";
    if( !empty($backLinkHref)){
        $backLink = 
        "<!-- helpers.renderBacklink -->" .
        "<a href=" .
            $backLinkHref .
        " class=\"btn btn-link text-white text-decoration-none\" aria-label=\"Go back\">" .
        "<img src=\"/images/back-svgrepo-com.svg\" alt=\"Go back\" width=\"30\" height=\"30\">" .
      "</a>";
    }

    return $backLink;
}

function renderHeader(Navigation $navigation, string $title): string {
    $backLink = renderBacklink($navigation->getBacklinkUrl());

    $navigation = renderNavigation($navigation->getMenu());

    $timestamp = date("F d, Y H:i:s", filemtime(__FILE__));

    return "<!-- renderHeader: " . $timestamp . " -->" .
        "<div class=\"container\">" .
            "<div class=\"row custom-blue-bg text-white py-3 align-items-center\">" .
                // Left empty column for spacing
                "<div class=\"col d-flex justify-content-start\">" .
                    $backLink .
                "</div>" .
                // Centered heading
                "<div class=\"col-auto text-center\">" .
                    "<h1 class=\"mb-0\">nutribase</h1>" .
                "</div>" .
                // Account icon on the right with same width as left column
                $navigation .
            "</div>" .
        // Subheading
        "<div class=\"row bg-secondary text-white py-2\">" .
            "<div class=\"col d-flex justify-content-center\">" .
                "<h2 class=\"text-center mb-0\">" . htmlspecialchars($title) . "</h2>" .
            "</div>" .
        "</div>";
}

function renderFooter(): string {
    return "</div>" .
        "<script src=\"https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js\"></script>";
}

function bootstrapWrap(string $content): string {
    $bootstrapUrl = "https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css";

    $customBackground = 
    "<style>" .
        ".custom-blue-bg {" .
            "background-color: #17a2b8;" .
        "}" .
    "</style>";

    $preContent = "<!DOCTYPE html>" .
        "<html lang=\"en\">" .
        "<!-- Version 1 -->" .
        "<head>" .
        "<meta charset=\"UTF-8\">" .
        "<meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">" .
        "<title>Nutribase</title>" .
        "<link href=\"" . $bootstrapUrl . "\" rel=\"stylesheet\">" .
        $customBackground .
        "</head><body>";
    $postContent = "</body></html>";

    return $preContent . $content . $postContent;
}

/**
 * Response Helper Functions
 */
function sendResponse($content, string $contentType = 'application/json', int $httpStatus = 200): never {

    // Set HTTP response code and content type
    http_response_code($httpStatus);
    header("Content-Type: $contentType");
    
    // Ensure we handle different content types appropriately
    if (is_array($content) && $contentType === 'application/json') {
        // Handle array content (e.g., JSON response)
        echo json_encode($content);
    } elseif (is_string($content) && $contentType === 'text/html') {
        // Handle string content (e.g., HTML response)
        echo $content;
    } else {
        // Handle any other types or defaults
        echo $content; // Default output if no specific type is found
    }

    // Terminate script
    exit;
}

 