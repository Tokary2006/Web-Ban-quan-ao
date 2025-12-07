<?php
require_once 'Models/CartModel.php';

class CartControlller
{
    private $cartModel;

    public function __construct($connection)
    {
        // $this->cartModel = new cartModel($connection);
    }

    public function index(){
        if (!isset($_SESSION['user'])) {
            header("location: index.php?page=login");
            return;
        }

        include 'Views/Client/cart.php';
    }
}