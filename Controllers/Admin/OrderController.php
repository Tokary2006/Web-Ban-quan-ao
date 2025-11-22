<?php
class OrderController {
    public function index() {
        include "Views/Admin/Order/index.php";
    }

    public function create() {
        include "Views/Admin/Order/create.php";
    }

    public function store() {
        include "Views/Admin/Order/edit.php";
    }
}
?>