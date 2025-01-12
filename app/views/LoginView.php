<?php
class LoginView {

    private function renderFooter(): string {
        return "</div>" .
            "<script src=\"https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js\"></script>";
    }

    public function renderLogin(): string {
        $content = renderHeader("Login");  
        $content .= "<div class=\"row mt-4\"><div class=\"col\"><ul class=\"list-group\">";

        $content .= "</ul></div></div>" . "<!-- LoginView -->" . $this->renderFooter();
        return bootstrapWrap($content);
    }
   
}