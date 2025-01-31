<?php

class TagsView {
    private function renderAnchorForTaggedFoods(int $tagId, string $tagName): string {
        $url = "/nutribase/get-foods?cat=" . $tagId;
        return "<a href=\"" . htmlspecialchars($url) . "\" class=\"text-decoration-none\">" . 
               htmlspecialchars($tagName) . "</a>";
    }

    public function renderTags(array $tags, Navigation $navigation): string {
        $content = renderHeader($navigation, "Categories");  
        $content .= "<div class=\"row mt-4\"><div class=\"col\"><ul class=\"list-group\">";

        foreach ($tags as $tag) {
            $content .= "<li class=\"list-group-item text-center\">" .
                $this->renderAnchorForTaggedFoods($tag['TagId'], $tag['TagName']) .
                "</li>";
        }

        $content .= "</ul></div></div>" . "<!-- TagsView -->" . renderFooter();
        return bootstrapWrap($content);
    }
}
