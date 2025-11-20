<?php
Class UserController {
    public function index(){
        include "Views/Admin/User/index.php";
    }
    public function store(){
        include "Views/Admin/User/edit.php";
    }
    public function create(){
        include "Views/Admin/User/create.php";
    }
}
?>