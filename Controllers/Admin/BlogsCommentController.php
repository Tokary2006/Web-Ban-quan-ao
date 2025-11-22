<?php
class BlogsCommentController {
    public function index() {
        require "Views/Admin/BlogsComment/index.php";
    }

    public function create() {
        require "Views/Admin/BlogsComment/create.php";
    }
    public function store() {
        require "Views/Admin/BlogsComment/edit.php";
    }
}
?>