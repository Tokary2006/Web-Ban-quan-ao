<?php
class BlogController {
    public function index() {
        include "Views/Admin/Blog/index.php";
    }

    public function create() {
        include "Views/Admin/Blog/create.php";
    }

    public function store() {
        include "Views/Admin/Blog/edit.php";
    }
}
?>