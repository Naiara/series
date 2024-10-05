<?php

class Controller
{
    public function __construct()
    {
        $this->checkSession();
    }

    protected function checkSession()
    {
        session_start();
        if (!isset($_SESSION['user'])) {
            // Redirect to login page if session is not set
            header('Location: /index.php?controller=UsuarioController&action=login');
            exit();
        }
    }
}
?>