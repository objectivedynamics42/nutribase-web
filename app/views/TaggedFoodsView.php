<?php

class TaggedFoodsView {

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
        $content = renderHeader($tagName);
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
