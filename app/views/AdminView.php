<?php

class AdminView {

    public function renderAdmin(Navigation $navigation): string {
        $content = renderHeader($navigation, "Admin");

        $content .= "<div class=\"row mt-4\"><div class=\"col\"><ul class=\"list-group\">";

        $content .= "<li class=\"list-group-item text-center\">";
        $content .= "Nutribase Administation Is Coming Soon";
        $content .= "</li>";

        $content .= "</ul></div></div>" .  renderFooter();

        return bootstrapWrap($content);
    }
}