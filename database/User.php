<?php
require_once 'connection.php';

class User extends Connection
{
    private $cod_user;
    private $cod_level;
    private $name_user;
    private $nick_user;
    private $email_user;
    private $pass_user;
    private $photo_user;
    private $message;

    function set_user($cod_user, $cod_level, $name_user, $nick_user, $email_user, $pass_user, $pass_user1, $photo_user)
    {
        $this->cod_user = $cod_user;
        $this->cod_level = $cod_level;
        $this->name_user = $name_user;
        $this->nick_user = $nick_user;
        $this->email_user = $email_user;
        $this->pass_user = $pass_user;
        $this->pass_user1 = $pass_user1;
        $this->photo_user = $photo_user;
    }

    // validation
    function validation_fields_user()
    {
        $this->message = '';

        // username
        if (empty($this->name_user)) {
            $this->message .= 'Ingrese el nombre.<br>';
        } else {
            if (strlen($this->name_user) < 3) $this->message .= 'El nombre debe tener, al menos, 3 caractéres. <br>';
        }

        // nickname
        if (empty($this->nick_user)) {
            $this->message .= 'Ingrese un nick <br>';
        } else {
            if (strlen($this->nick_user) < 3) $this->message .= 'El nick debe tener, al menos, 3 caractéres. <br>';
        }

        //email
        if (empty($this->email_user)) {
            $this->message .= 'Ingrese el email.<br>';
        } else {
            if (!filter_var($this->email_user, FILTER_VALIDATE_EMAIL)) $this->message .= 'Ingrese un email válido. <br>';
        }

        // password
        if (empty($this->pass_user)) {
            $this->message .= 'Ingrese una contraseña. <br>';
        }

        // repeat password 
        if (empty($this->pass_user1)) {
            $this->message .= 'Debe repetir la contraseña. <br>';
        } else {
            if (strlen($this->pass_user) < 5 || strlen($this->pass_user1) < 5) {
                $this->message .= 'La contraseña debe tener, al menos, 5 caracteres. <br>';
            } else {
                if ($this->pass_user !== $this->pass_user1) $this->message .= 'Las contraseñas no coinciden <br>';
            }
        }


        return $this->message;
    }

    // insert user
    function insert_user()
    {
        $sql = "INSERT INTO `users`(`cod_lev`, `name_us`, `nick_us`, `email`, `pass`, `photo_us`) 
                VALUES (:cod_lev, :name_us, :nick_us, :email, :pass, :photo_us)";

        $statement = $this->connect()->prepare($sql);

        $statement->bindValue(':cod_lev', $this->cod_level);
        $statement->bindValue(':name_us', $this->name_user);
        $statement->bindValue(':nick_us', $this->nick_user);
        $statement->bindValue(':email', $this->email_user);
        $statement->bindValue(':pass', md5($this->pass_user));
        $statement->bindValue(':photo_us', empty($this->photo_user) ? null : $this->photo_user);

        return $statement->execute();
    }
}
