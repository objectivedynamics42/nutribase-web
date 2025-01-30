<?php

class FoodItemView {

    public function renderFoodItem(string $tagId, array $food, Navigation $navigation): string {
        $content = renderHeader($navigation, "Edit", $food['FoodName']);
        $content .= "<div class=\"row mt-4\"><div class=\"col\"><ul class=\"list-group\">";

        $unit = $food['override'] ?? 'Per 100g';
        $content .= "<h3 class=\"text-center\">" . htmlspecialchars($unit) . "</h3>";

        $content .= "<li class=\"list-group-item d-flex justify-content-between align-items-center\">" .
            "<span>Calories:</span>" .
            "<span class=\"ms-4\">" . htmlspecialchars($food['kCal']) . "</span>" .
            "</li>";

        $content .= "<li class=\"list-group-item d-flex justify-content-between align-items-center\">" .
            "<span>Grams of Protein:</span>" .
            "<span class=\"ms-4\">" . htmlspecialchars($food['protein'] ?? '0.0') . "</span>" .
            "</li>";

        $content .= "</ul></div></div>" . renderFooter();
        return bootstrapWrap($content);
    }
}