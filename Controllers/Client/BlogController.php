<?php
require_once 'Models/BlogModel.php';
require_once 'Models/BlogsCommentModel.php';

class BlogController
{
    private $BlogModel;
    private $commentModel;
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
        $blogs = $this->BlogModel->getAll();
        $comments = $this->BlogModel->getByBlogSlug($slug);

        if (!$blog) {
            require "Views/Client/error_404.php";
            return;
        }

        require "Views/Client/blog-single.php";
    }
}
