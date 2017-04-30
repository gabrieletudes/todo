<?php
namespace Model;
class Auth extends Model{
    function checkUser(string $email, string $password)
    {
        //$this parceque on herite de Model
        $pdo = $this->connectDB();
        if ($pdo) {
            try {
                $pdoSt =
                    $pdo->prepare(
                        'SELECT * FROM todo.users WHERE email = :email AND password = :password'
                    );
                $pdoSt->execute([
                    ':email' => $email,
                    ':password' => $password
                ]);
                return $pdoSt->fetch();
            } catch (PDOException $exception) {
                return null;
            }
        }
    }
}
