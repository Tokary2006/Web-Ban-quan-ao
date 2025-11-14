<?php
class CategoryController {
    public function index() {
        require "Views/Admin/Category/index.php";
    }

    public function create() {
        require "Views/Admin/Category/create.php";
    }
    public function store() {
        require "Views/Admin/Category/edit.php";
    }
}
?>