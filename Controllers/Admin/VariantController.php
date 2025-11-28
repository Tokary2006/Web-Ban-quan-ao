<?php
    class VariantController {
        public function index(){
            include "Views/Admin/Varient/index.php";
        }
        
        public function indexVariantId() {
            include "Views/Admin/Varient/indexVariantId.php";
        }

        public function create() {
            include "Views/Admin/Varient/create.php";
        }

        public function edit() {
            include "Views/Admin/Varient/edit.php";
        }
    }
?>