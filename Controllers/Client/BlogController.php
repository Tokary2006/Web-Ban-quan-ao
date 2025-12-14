<?php
require_once 'Models/BlogModel.php';

class BlogController
{
    private $BlogModel;
    public function __construct($connection)
    {
        $this->BlogModel = new BlogModel($connection);
    }

    public function blog()
    {
        $blogs = $this->BlogModel->getAll();
        require "Views/Client/blog.php";
    }

    public function blog_detail()
    {
        if (!isset($_GET['slug'])) {
            require "Views/Client/error_404.php";
            return;
        }

        $slug = $_GET["slug"];
        $blog = $this->BlogModel->getBySlug($slug);

        if (!$blog) {
            require "Views/Client/error_404.php";
            return;
        }

        require "Views/Client/blog-single.php";
    }
}
