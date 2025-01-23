<?php

class TaggedFoodsView {

    private function renderFoodAnchor(int $foodId, string $foodName, string $tagId): string {
        $url = "https://objectivedynamics.co.uk/nutribase/getfooditem?foodId=" . $foodId . "&tagId=" . $tagId;
        return "<a href=\"" . htmlspecialchars($url) . "\" class=\"text-decoration-none\">" . 
               htmlspecialchars($foodName) . "</a>";
    }

    private function renderTaggedFoodsBackLink(): string {
        return "/nutribase";//TODO refactor so that we don't have to specify nutribase everywhere
    }

    public function renderFoods(string $tagId, string $tagName, array $foods): string {
        $backLinkHref = $this->renderTaggedFoodsBackLink();
        $content = renderHeader($backLinkHref, $tagName);
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
