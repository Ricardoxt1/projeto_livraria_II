<?php

namespace App\Session\Admin;

class Login
{
    /**
     * método responsável por iniciar a sessão
     */
    private static function init()
    {
        //verifica se a sessão não está ativa
        if (session_status() != PHP_SESSION_ACTIVE) {
            session_start();
        }
    }
    /**
     * método responsável por criar o login do usuário
     * @param Register @obRegister
     * @return boolean 
     */
    public static function login($obRegister)
    {
        //inicia a sessão
        self::init();

        //define a sessão do usuário
        $_SESSION['client']['register'] = [
            'id' => $obRegister->id,
            'username' => $obRegister->username,
            'password' => $obRegister->password
        ];

        //sucesso
        return true;
    }

    /**
     * método responsável por verificar se o usuário está logado
     * @return boolean
     */
    public static function isLogged(){
        //inicia a sessão
        self::init();

        //retorna a verificação
        return isset($_SESSION['client']['register']['id']);

    }

    public static function logout(){
        //inicia a sessão
        self::init();

        //desloga o usuário
        unset($_SESSION['client']['register']);

        //sucesso
        return true;
    }
}
