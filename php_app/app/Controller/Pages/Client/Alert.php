<?php

namespace App\Controller\Pages\Client;

use \App\Utils\View;

class Alert{

    /**
     * método responsável por retornar uma mensagem de erro
     * @param string $message
     * @return string View::render
     */
    public static function getError(string $message) : string
    {
        return View::render('pages/client/alert/status',[
            'tipo' => 'danger',
            'mensagem' => $message
        ]);
    }

    /**
     * método responsável por retornar uma mensagem de sucesso
     * @param string $message
     * @return string View::render
     */
    public static function getSuccess(string $message) : string
    {
        return View::render('pages/client/alert/status',[
            'tipo' => 'success',
            'mensagem' => $message
        ]);
    }
}