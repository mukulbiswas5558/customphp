<?php
class HomeController {
    public function index() {
        $this->loadView('home', ['title' => 'Welcome to the Home Page!']);
    }

    public function about() {
        $this->loadView('about', ['title' => 'About Us']);
    }

    private function loadView($viewName, $data = []) {
        extract($data);
        require_once "views/{$viewName}.php";
    }
}
?>