<?php

namespace App\Controller\Pages\Client;

use \App\Utils\View;

class Alert{

    /**
     * método responsável por retornar uma mensagem de erro
     * @param string $message
     * @return string
     */
    public static function getError($message){
        return View::render('pages/client/alert/status',[
            'tipo' => 'danger',
            'mensagem' => $message
        ]);
    }

    /**
     * método responsável por retornar uma mensagem de sucesso
     * @param string $message
     * @return string
     */
    public static function getSuccess($message){
        return View::render('pages/client/alert/status',[
            'tipo' => 'success',
            'mensagem' => $message
        ]);
    }
}