<?php

class TagsView {
    private function getAnchorForTaggedFoods(int $tagId, string $tagName): string {
        $url = "https://objectivedynamics.co.uk/nutribase/getFoods?tagId=" . $tagId;
        return "<a href=\"" . htmlspecialchars($url) . "\" class=\"text-decoration-none\">" . 
               htmlspecialchars($tagName) . "</a>";
    }

    private function renderFooter(): string {
        return "</div>" .
            "<script src=\"https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js\"></script>";
    }

    public function renderTags(array $tags): string {
        $content = renderHeader("Categories");  
        $content .= "<div class=\"row mt-4\"><div class=\"col\"><ul class=\"list-group\">";

        foreach ($tags as $tag) {
            $content .= "<li class=\"list-group-item text-center\">" .
                $this->getAnchorForTaggedFoods($tag['TagId'], $tag['TagName']) .
                "</li>";
        }

        $content .= "</ul></div></div>" . "<!-- TagsView -->" . $this->renderFooter();
        return bootstrapWrap($content);
    }
}
