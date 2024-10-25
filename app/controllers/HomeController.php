<?php
class HomeController {
    public function index() {
        $this->loadView('common/header', ['title' => 'Welcome to the Home Page!']);
        $this->loadView('common/navbar', ['title' => 'Welcome to the Home Page!']);
        $this->loadView('home', ['title' => 'Welcome to the Home Page!']);
        $this->loadView('common/footer', ['title' => 'Welcome to the Home Page!']);
    }
    public function contact() {
        $this->loadView('common/header', ['title' => 'Welcome to the Home Page!']);
        $this->loadView('common/navbar', ['title' => 'Welcome to the Home Page!']);
        $this->loadView('contact', ['title' => 'Welcome to the Home Page!']);
        $this->loadView('common/footer', ['title' => 'Welcome to the Home Page!']);
    }

    public function about() {
        $this->loadView('common/header', ['title' => 'Welcome to the Home Page!']);
        $this->loadView('common/navbar', ['title' => 'Welcome to the Home Page!']);
        $this->loadView('about', ['title' => 'Welcome to the Home Page!']);
        $this->loadView('common/footer', ['title' => 'Welcome to the Home Page!']);
    }

    private function loadView($viewName, $data = []) {
        extract($data);
        require_once "views/{$viewName}.php";
    }
}
?>