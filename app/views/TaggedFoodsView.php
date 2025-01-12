<?php

class TaggedFoodsView {

    private function renderHeader(string $title): string {
        return "<div class=\"container\">" .
            "<div class=\"row custom-blue-bg text-white py-3 align-items-center\">" .
                // Left empty column for spacing
                "<div class=\"col\"></div>" .
                // Centered heading
                "<div class=\"col-auto text-center\">" .
                    "<h1 class=\"mb-0\">nutribase</h1>" .
                "</div>" .
                // Account icon on the right with same width as left column
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
                            "<li><a class=\"dropdown-item\" href=\"/login\">Log In</a></li>" .
                            "<!-- Add more menu options here if needed -->" .
                        "</ul>" .
                    "</div>" .
                "</div>" .
            "</div>" .
            // Subheading
            "<div class=\"row bg-secondary text-white py-2\">" .
                "<div class=\"col d-flex justify-content-center\">" .
                    "<h2 class=\"text-center mb-0\">" . htmlspecialchars($title) . "</h2>" .
                "</div>" .
            "</div>";
    }

    private function renderFooter(): string {
        return "</div>" .
            "<script src=\"https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js\"></script>";
    }

    private function getAnchorForFood(int $foodId, string $foodName): string {
        $url = "https://objectivedynamics.co.uk/nutribase/getSingleFood?foodId=" . $foodId;
        return "<a href=\"" . htmlspecialchars($url) . "\" class=\"text-decoration-none\">" . 
               htmlspecialchars($foodName) . "</a>";
    }

    public function renderFoods(string $tagName, array $foods): string {
        $content = $this->renderHeader($tagName);
        $content .= "<div class=\"row mt-4\"><div class=\"col\"><ul class=\"list-group\">";

        foreach ($foods as $food) {
            $content .= "<li class=\"list-group-item text-center\">" .
                $this->getAnchorForFood($food['FoodId'], $food['FoodName']) .
                "</li>";
        }

        $content .= "</ul></div></div>" . $this->renderFooter();
        return bootstrapWrap($content);
    }
}
