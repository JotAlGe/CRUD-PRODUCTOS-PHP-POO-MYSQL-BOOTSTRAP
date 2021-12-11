<?php
require_once 'connection.php';

class Products extends Connection
{
    private $message;
    function validation_fields_products($name, $price, $photo, $comment)
    {
        $this->message = '';
        if (empty($name)) {
            $this->message = 'Ingrese el nombre';
        } else {
            if (strlen($name) < 3) {
                $this->message = 'El nombre debe tener 3 caractéres. ';
            }
        }

        if (empty($price)) {
            $this->message = 'Ingrese el precio.';
        } else {
            if (!is_numeric($price)) {
                $this->message = 'El precio debe ser un número';
            }
        }

        if (!empty($photo)) {
            if ($photo != 'image/jpg' || $photo != 'image/png') {
                $this->message = 'La imagen debe ser png o jpg';
            }
        }

        return $this->message;
    }
}
