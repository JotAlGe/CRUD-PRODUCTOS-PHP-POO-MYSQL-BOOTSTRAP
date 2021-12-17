<?php
require_once 'connection.php';

class Products extends Connection
{
    private $message;
    private $categories;
    private $products;
    private $id_product;

    // fields validation
    function validation_fields_products($name, $price, $photo, $categories)
    {
        $this->message = '';

        if (empty($name)) {
            $this->message .= 'Ingrese el nombre.<br>';
        } else {
            if (strlen($name) < 3) {
                $this->message .= 'El nombre debe tener 3 caractéres. <br>';
            }
        }

        if (empty($price)) {
            $this->message .= 'Ingrese el precio.<br>';
        } else {
            if (!is_numeric($price)) {
                $this->message .= 'El precio debe ser numérico.<br>';
            }
        }

        if (!empty($photo)) {
            if (!(strpos($photo, 'jpeg')  || strpos($photo, 'jpg') || strpos($photo, 'png'))) {
                $this->message .= 'La imagen debe ser png o jpg.<br>';
            }
        }

        if ($categories < 1) {
            $this->message .= 'Debe colocar una categoría.<br>';
        }

        return $this->message;
    }

    function show_categories()
    {
        $this->categories = [];
        $sql = "SELECT `cod_cat`, `desc_cat` FROM categories";
        $statement = $this->connect()->prepare($sql);
        $statement->execute();
        $this->categories = $statement->fetchAll(PDO::FETCH_ASSOC);

        return $this->categories;
    }

    function insert_product($cod_category, $cod_user, $name, $price, $obs = '', $photo = '')
    {

        $sql = "INSERT INTO `products`(`cod_cat`, `cod_us`, `name_prod`, `Price`, `obs_prod`, `photo_prod`)
                VALUES (:cod_cat, :cod_us, :name_prod, :price, :obs_prod, :photo)";

        $statement = $this->connect()->prepare($sql);
        $statement->bindParam(':cod_cat', $cod_category);
        $statement->bindParam(':cod_us', $cod_user);
        $statement->bindParam(':name_prod', $name);
        $statement->bindParam(':price', $price);
        $statement->bindParam(':obs_prod', $obs);
        $statement->bindParam(':photo', $photo);

        $insert = $statement->execute();
        return $insert ? true : false;
    }

    // show products
    function show_products()
    {
        $this->products = [];
        $sql = "SELECT p.cod_prod, p.cod_us, p.name_prod, p.Price, p.obs_prod, p.photo_prod,
                       c.cod_cat, c.desc_cat 
                FROM products as p, categories as c 
                WHERE p.cod_cat = c.cod_cat ORDER BY p.cod_prod";
        $statement = $this->connect()->prepare($sql);
        $statement->execute();
        $this->products = $statement->fetchAll(PDO::FETCH_ASSOC);

        return $this->products;
    }

    // delete products
    function delete_product($id)
    {
        $this->id_product = $id;
        $sql = "DELETE FROM `products` WHERE `cod_prod` = :id";
        $statement = $this->connect()->prepare($sql);
        $statement->bindParam(':id', $this->id_product);
        $statement->execute();

        return true;
    }

    // delete img
    function delete_img($img)
    {
        return unlink($img) ? true : false;
    }
}
