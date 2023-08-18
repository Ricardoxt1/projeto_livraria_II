<?php

namespace App\Controller\Pages\Read;

use \App\Http\Request;
use \App\Utils\View;
use \App\Model\Entity\Costumer as EntityCostumer;
use \App\Controller\Pages\Client\Alert;


class Costumer extends Page
{

    /**
     * metodo para resgatar os itens dos consumidores
     * @return string $itens
     */
    private function getCostumerItems(): string
    {
        // dados do usuario
        $itens = '';

        // resultados da pagina
        $results = EntityCostumer::getCostumer(null, 'id ASC');

        // renderiza o item
        while ($obCostumer = $results->fetchObject(EntityCostumer::class)) {
            $itens .= View::render('pages/list/costumer/item', [
                'id' => $obCostumer->id,
                'name' => $obCostumer->name,
                'cpf' => $obCostumer->cpf,
                'phone_number' => $obCostumer->phone_number,
                'address' => $obCostumer->address,
                'email' => $obCostumer->email,
            ]);
        }
        //retorna os dados
        return $itens;
    }

    /** metodo para resgatar os dados da pagina de consumidores (view)
     * @return string parent::getPage
     * @param Request $request
     *  */
    public static function getCostumer(Request $request): string
    {

        $content = View::render('pages/list/listCostumers', [
            //view costumers
            'item' => self::getCostumerItems(),
            'status' => self::getStatus($request)
        ]);


        //retorna a view da pagina
        return parent::getPage('Listagem de Usuarios', $content);
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
                return Alert::getSuccess('Usuario criado com sucesso!');
                break;
            case 'updated':
                return Alert::getSuccess('Usuario atualizado com sucesso!');
                break;
            case 'deleted':
                return Alert::getSuccess('Usuario deletado com sucesso!');
                break;
        }
    }

    /** metodo para realizar update dos dados da pagina de usuario (view)
     * @param Request $request
     * @param integer $id
     * @return string parent::getPage
     *  */
    public static function getUpdateCostumer(Request $request, int $id): string
    {

        //obtem os dados de usuarios no banco de dados
        $obCostumer = EntityCostumer::getCostumerById($id);

        //valida a instancia
        if (!$obCostumer instanceof EntityCostumer) {
            $request->getRouter()->redirect('/costumer');
        }

        $content = View::render('pages/update/updateCostumer', [
            //view costumer
            'id' => $obCostumer->id,
            'name' => $obCostumer->name,
            'cpf' => $obCostumer->cpf,
            'phone_number' => $obCostumer->phone_number,
            'address' => $obCostumer->address,
            'email' => $obCostumer->email,
            'status' => self::getStatus($request)

        ]);

        //retorna a view da pagina
        return parent::getPage('Editagem de Usuario', $content);
    }

    /** metodo para realizar update dos dados da pagina de consumidor (view)
     * @return string updateCostumer
     * @param integer $id
     * @param Request $request
     * 
     *  */
    public static function setUpdateCostumer(Request $request, int $id): string
    {
        //obtem os dados de livros no banco de dados
        $obCostumer = EntityCostumer::getCostumerById($id);

        //valida a instancia
        if (!$obCostumer instanceof EntityCostumer) {
            $request->getRouter()->redirect('/costumer');
        }

        //post vars
        $postVars = $request->getPostVars();

        //atualiza a instancia
        $obCostumer->name = $postVars['name'] ?? $obCostumer->name;
        $obCostumer->cpf = $postVars['cpf'] ?? $obCostumer->cpf;
        $obCostumer->phone_number = $postVars['phone_number'] ?? $obCostumer->phone_number;
        $obCostumer->address = $postVars['address'] ?? $obCostumer->address;
        $obCostumer->email = $postVars['email'] ?? $obCostumer->email;

        $obCostumer->update();


        //redireciona para editagem
        $request->getRouter()->redirect('/' . 'updateCostumer/' . $obCostumer->id . '/edit?status=updated');
    }
}
