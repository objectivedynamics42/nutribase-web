<?php

class TaggedFoodsView {

    private function renderFoodAnchor(int $foodId, string $foodName, string $tagId): string {
        //TODO can we use a relative link for the below?
        $url = "/nutribase/get-food-item?foodId=" . $foodId . "&tagId=" . $tagId;
        return "<a href=\"" . htmlspecialchars($url) . "\" class=\"text-decoration-none\">" . 
               htmlspecialchars($foodName) . "</a>";
    }

    public function renderFoods(string $tagId, string $tagName, array $foods, Navigation $navigation): string {
        $content = renderHeader($navigation, $tagName);
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
