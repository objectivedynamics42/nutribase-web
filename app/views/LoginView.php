<?php
class LoginView {

    public function renderLogin(): string {
        $content = renderHeader("Login");  
        $content .= "<div class=\"row mt-4\"><div class=\"col\"><ul class=\"list-group\">";

        $content .= "</ul></div></div>" . "<!-- LoginView -->" . renderFooter();
        return bootstrapWrap($content);
    }
   
}