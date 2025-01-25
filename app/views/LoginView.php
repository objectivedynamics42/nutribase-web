<?php
class LoginView {

    public function renderLogin(): string {
        $content = renderHeader("/nutribase", "Login");  //TODO what backLink should we use here?
        $content .= "<div class=\"row mt-4\"><div class=\"col\"><ul class=\"list-group\">";

        $form = "<div class=\"row justify-content-center mt-4\">
            <div class=\"col-12 col-md-6 col-lg-4\">
            <form action=\"/login\" method=\"POST\">            
                <div class=\"mb-3\">
                <label for=\"username\" class=\"form-label\">Username</label>
                <input type=\"text\" class=\"form-control\" id=\"username\" name=\"username\" required>
                </div>
                <div class=\"mb-3\">
                <label for=\"password\" class=\"form-label\">Password</label>
                <input type=\"password\" class=\"form-control\" id=\"password\" name=\"password\" required>
                </div>
                <div class=\"d-grid\">
                <button type=\"submit\" class=\"btn btn-primary\">Login</button>
                </div>
            </form>
            </div>
        </div>";

        $content .= "</ul></div></div>" . "<!-- LoginView -->" . $form . renderFooter();
        return bootstrapWrap($content);
    }

    public function renderLoggedIn(){
        $content = renderHeader("/nutribase", "Logged in");  //TODO what backLink should we use here?
        $content .= "<div class=\"row mt-4\"><div class=\"col\"><ul class=\"list-group\">";

        $content .= "</ul></div></div>" . "<!-- LoginView -->" . renderFooter();
        return bootstrapWrap($content);
    }
   
}