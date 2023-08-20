<?php

namespace App\Session\Admin;

use App\Model\Entity\RegisterClient;

class Login
{
    /**
     * método responsável por iniciar a sessão
     */
    private static function init(): void
    {
        //verifica se a sessão não está ativa
        if (session_status() != PHP_SESSION_ACTIVE) {
            session_start();
        }
    }
    /**
     * método responsável por criar o login do usuário
     * @return boolean 
     * @param RegisterClient
     */
    public static function login($obRegister): bool
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
    public static function isLogged(): bool
    {
        //inicia a sessão
        self::init();

        //retorna a verificação
        return isset($_SESSION['client']['register']['id']);
    }

    public static function logout(): bool
    {
        //inicia a sessão
        self::init();

        //desloga o usuário
        unset($_SESSION['client']['register']);

        //sucesso
        return true;
    }
}
