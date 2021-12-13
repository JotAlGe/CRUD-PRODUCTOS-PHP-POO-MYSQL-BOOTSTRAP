<?php
require_once 'connection.php';

class Products extends Connection
{
    private $message;
    private $categories;
    private $table;

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
            if ($photo != 'image/jpg' || $photo != 'image/png') {
                $this->message .= 'La imagen debe ser png o jpg.<br>';
            }
        }

        if (empty($categories)) {
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
}
