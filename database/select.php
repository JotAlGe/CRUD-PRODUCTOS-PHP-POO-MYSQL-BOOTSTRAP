<?php
require_once 'connection.php';

class Select extends Connection
{
    private $email;
    /* private $pass_user; */
    public $data;

    public function data_user($email, $pass)
    {
        $this->email = $email;
        $this->pass_user = md5($pass);
        $this->data = [];

        $sql = "SELECT `cod_us`, `cod_lev`, `name_us`, `nick_us`, `email`, `pass`, `photo_us` FROM `users` WHERE `email` = :email and `pass` = :pass";
        $user = $this->connect()->prepare($sql);
        $user->bindParam(':email', $this->email);
        $user->bindParam(':pass', $this->pass_user);
        $user->execute();
        $result = $user->fetchAll(PDO::FETCH_ASSOC);

        if (!empty($result)) {
            foreach ($result as $row) {
                $this->data['ID']  = $row['cod_us'];
                $this->data['ID_LEV']  = $row['cod_lev'];
                $this->data['NAME']  = $row['name_us'];
                $this->data['NICK']  = $row['nick_us'];

                if (empty($row['photo_us'])) {
                    $row['photo_us'] = 'user.png';
                }

                $this->data['PHOTO'] = $row['photo_us'];
            }
        }
        return $this->data;
    }
}
