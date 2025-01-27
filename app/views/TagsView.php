<?php

class TagsView {
    private function getAnchorForTaggedFoods(int $tagId, string $tagName): string {
        $url = "https://objectivedynamics.co.uk/nutribase/getFoods?tagId=" . $tagId;
        return "<a href=\"" . htmlspecialchars($url) . "\" class=\"text-decoration-none\">" . 
               htmlspecialchars($tagName) . "</a>";
    }

    public function renderTags(array $tags): string {
        $backLink = "";
        $content = renderHeader($backLink, "Add Tag", "Categories");  
        $content .= "<div class=\"row mt-4\"><div class=\"col\"><ul class=\"list-group\">";

        foreach ($tags as $tag) {
            $content .= "<li class=\"list-group-item text-center\">" .
                $this->getAnchorForTaggedFoods($tag['TagId'], $tag['TagName']) .
                "</li>";
        }

        $content .= "</ul></div></div>" . "<!-- TagsView -->" . renderFooter();
        return bootstrapWrap($content);
    }
}
