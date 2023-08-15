<?php

namespace App\Controller\Pages\Read;

use \App\Utils\View;
use \App\Model\Entity\Publisher as EntityPublisher;
use \App\Controller\Pages\Client\Alert;

class Publisher extends Page
{
    private function getPublisherItems()
    {

        // dados da editora
        $itens = '';

        // resultados da pagina
        $results = EntityPublisher::getPublisher(null, 'id ASC');

        // renderiza o item
        while ($obPublisher = $results->fetchObject(EntityPublisher::class)) {
            $itens .= View::render('pages/list/publisher/item', [
                'id' => $obPublisher->id,
                'name' => $obPublisher->name,
            ]);
        }

        return $itens;
    }


    /** metodo para resgatar os dados da pagina de editora (view)
     * @return string
     *  */
    public static function getPublisher($request)
    {

        $content = View::render('pages/list/listPublishers', [
            //view publishers
            'item' => self::getPublisherItems(),
            'status' => self::getStatus($request)
        ]);


        //retorna a view da pagina
        return parent::getPage('Listagem de Editoras', $content);
    }

    /**
     * método responsável por retornar a mensagem de status
     * @param request $request
     * @return string
     */
    private static function getStatus($request)
    {
        //query params
        $queryParamns = $request->getQueryParams();

        //status
        if (!isset($queryParamns['status'])) return '';

        //Mensagem de Status
        switch ($queryParamns['status']) {
            case 'created':
                return Alert::getSuccess('Editora criado com sucesso!');
                break;
            case 'updated':
                return Alert::getSuccess('Editora atualizado com sucesso!');
                break;
            case 'deleted':
                return Alert::getSuccess('Editora deletada com sucesso!');
                break;
        }
    }

    /** metodo para realizar update dos dados da pagina de editora (view)
     * @return string
     *  */
    public static function getUpdatePublisher($request, $id)
    {

        //obtem os dados de editora no banco de dados
        $obPublisher = EntityPublisher::getPublisherById($id);

        //valida a instancia
        if (!$obPublisher instanceof EntityPublisher) {
            $request->getRouter()->redirect('/publisher');
        }

        $content = View::render('pages/update/updatePublisher', [
            //view publisher
            'id' => $obPublisher->id,
            'name' => $obPublisher->name,
            'status' => self::getStatus($request)
        ]);

        //retorna a view da pagina
        return parent::getPage('Editagem de Editora', $content);
    }


    /** metodo para realizar update dos dados da pagina de editora (view)
     * @return string
     * @param integer $id
     * @param Request $request
     * 
     *  */
    public static function setUpdatePublisher($request, $id)
    {
        //obtem os dados de livros no banco de dados
        $obPublisher = EntityPublisher::getPublisherById($id);

        //valida a instancia
        if (!$obPublisher instanceof EntityPublisher) {
            $request->getRouter()->redirect('/publisher');
        }

        //post vars
        $postVars = $request->getPostVars();

        //atualiza a instancia
        $obPublisher->name = $postVars['name'] ?? $obPublisher->name;

        $obPublisher->atualizar();


        //redireciona para editagem
        $request->getRouter()->redirect('/' . 'updatePublisher/' . $obPublisher->id . '/edit?status=updated');
    }
}
