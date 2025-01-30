<?php

class TaggedFoodsView {

    private function renderFoodAnchor(int $foodId, string $foodName, string $tagId): string {
        $url = "https://objectivedynamics.co.uk/nutribase/getfooditem?foodId=" . $foodId . "&tagId=" . $tagId;
        return "<a href=\"" . htmlspecialchars($url) . "\" class=\"text-decoration-none\">" . 
               htmlspecialchars($foodName) . "</a>";
    }

    public function renderFoods(string $tagId, string $tagName, array $foods, string $backLinkHref): string {
        $content = renderHeader($backLinkHref, "Add Food", $tagName);
        $content .= "<div class=\"row mt-4\"><div class=\"col\"><ul class=\"list-group\">";

        Logger::log("renderFoods - tagId: " . $tagId);

        foreach ($foods as $food) {
            $content .= "<li class=\"list-group-item text-center\">" .
                $this->renderFoodAnchor($food['FoodId'], $food['FoodName'], $tagId) .
                "</li>";
        }

        $content .= "</ul></div></div>" . renderFooter();
        return bootstrapWrap($content);
    }
}
