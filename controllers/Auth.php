<?php
namespace Controller;
/**
 * Définit la vue à proposer à l’utilisateur pour se connecter
 * @return array
 */
use Model\Auth as AuthModel;
class Auth {
    function getLogin(): array
    {
        return ['view' => 'views/getLogin.php'];
    }
    function getLogout()
    {
        $_SESSION = array();
        if (ini_get('session.use_cookies')) {
            $params = session_get_cookie_params();
            setcookie(session_name(), '', 1,
                $params['path'], $params['domain'],
                $params['secure'], $params['httponly']
            );
        }
        session_destroy();
        header('Location: http://devserv.app');
        exit;
    }

    function postLogin(): void
    {
        $_SESSION['user'] = null;
        $email = $_POST['email'];
        echo $password = sha1($_POST['password']);
        $authmodel = new AuthModel();
        $user = $authmodel->checkUser($email, $password);
        if (!$user) {
            header('Location: http://devserv.app/todolist/');
            exit;
        }
        $_SESSION['user'] = $user;
        header('Location: http://devserv.app/todolist/index.php?a=index&r=tasks');
        exit;
    }
}
