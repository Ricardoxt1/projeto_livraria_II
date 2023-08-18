<?php

namespace App\Controller\Pages\Read;

use \App\Utils\View;
use \App\Model\Entity\Publisher as EntityPublisher;
use \App\Controller\Pages\Client\Alert;
use App\Http\Request;

class Publisher extends Page
{
    /** metodo para resgatar os dados de editoras (view)
     * @return string $itens
     *  */
    private function getPublisherItems(): string
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
     * @param Request $request
     * @return string parent::getPage
     *  */
    public static function getPublisher(Request $request): string
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
     * @param Request $request
     * @return string $queryParamns
     */
    private static function getStatus(Request $request): string
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
     * @param Request $request
     * @param integer $id
     * @return string parent::getPage
     *  */
    public static function getUpdatePublisher(Request $request, int $id): string
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
     * @return string updatePublisher
     * @param integer $id
     * @param Request $request
     * 
     *  */
    public static function setUpdatePublisher(Request $request, int $id): string
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

        $obPublisher->update();


        //redireciona para editagem
        $request->getRouter()->redirect('/' . 'updatePublisher/' . $obPublisher->id . '/edit?status=updated');
    }
}
