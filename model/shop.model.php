<?php
require_once "base.model.php";
class ShopModel extends BaseModel {
    // --- PUBLIC METHODS ---
    public function getShopContent() {
        $sql = "SELECT * FROM product";
        return $this->crud->readAll($sql);
    }

    public function getItemContent($id) {
        $sql = "SELECT * FROM product WHERE id = ?";
        $var = [$id];
        return $this->crud->read($sql, $var);
    }

    public function updateCartContent() {
        $updateCart = [];
        $updateCart["product_id"] = $_POST['product_id'];
        $updateCart["quantity"] = $_POST['quantity'];

        // create/update the session variable for the cart
        if (isset($_SESSION['cart'])) {
            if (array_key_exists($updateCart["product_id"], $_SESSION['cart'])) {
                // product exists in cart: update the quanity
                $_SESSION['cart'][$updateCart["product_id"]] += $_POST['quantity'];
            } else {
                // product is not in cart: add it
                $_SESSION['cart'][$updateCart["product_id"]] = $_POST['quantity'];
            }
        } else {
            // no products in cart: this will add the first product to cart (set session)
            $_SESSION['cart'] = array($updateCart["product_id"] => $updateCart["quantity"]);
        }

        // return set array
        return $updateCart;
    }

    public function getCartContent() {
        if (isset($_SESSION['cart'])) {
            $keys = implode(",", array_keys($_SESSION['cart']));
            $sql = "SELECT * FROM product WHERE id IN (" . $keys . ")";
            return $this->crud->readAll($sql);
        }
    }

    public function checkout() {
        if (!empty($_SESSION['cart'])) { 
            // set variables
            $totalPrice = 0;
            $orderStatus = 'ordered';

            // create new order
            $sql = "INSERT INTO order_set (user_id, order_status) VALUES (?, ?)";
            $var = [$_SESSION['id'], $orderStatus];
            $lastId = $this->crud->create($sql, $var);

            // get data
            $product = $this->getCartContent();

            // insert into created order
            foreach ($product as $content => $product) {
                $sql = "INSERT INTO order_detail (order_set_id, product_id, price, quantity) VALUES (?, ?, ?, ?)";
                $var = [$lastId, $product["id"], $product["price"], $_SESSION['cart'][$product["id"]]];
                $this->crud->create($sql, $var);

                // count total price
                $totalPrice += $_SESSION['cart'][$product["id"]] * $product["price"];
            }

            // update total price in set order
            $sql = "UPDATE order_set SET amount = ? WHERE id = ?";
            $var = [$totalPrice, $lastId];
            $this->crud->update($sql, $var);
            
            // clear cart
            unset($_SESSION['cart']);

        }
    }
}