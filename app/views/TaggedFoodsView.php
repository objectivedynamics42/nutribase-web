<?php

class TaggedFoodsView {

    private function getAnchorForFood(int $foodId, string $foodName): string {
        $url = "https://objectivedynamics.co.uk/nutribase/getfooditem?foodId=" . $foodId;
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

        $content .= "</ul></div></div>" . renderFooter();
        return bootstrapWrap($content);
    }
}
