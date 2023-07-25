<?php

namespace App\Controller\Pages;

use \App\Utils\View;


class Costumer extends Page
{

    /** metodo para resgatar os dados da pagina de consumidores (view)
     * @return string
     *  */
    public static function getCostumer()
    {

        $content = View::render('pages/listCostumers', [
            //view costumers
            'main' => '
            <main class="col-md-9 ms-sm col-lg-8 px-md-5">
                <div
                    class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2">Listagem de Usuarios</h1>
                </div>
                <div>

                </div>
                <div class="table-responsive">
                    <table class="table table-striped table-ls">
                        <thead>
                            <tr>
                                <th scope="col">Nome</th>
                                <th scope="col">Telefone</th>
                                <th scope="col">Endereço</th>
                                <th scope="col">Email</th>

                            </tr>
                        </thead>

                        <form action="" method="get">
                            <tbody>

                                <tr>
                                    <td name="name_costumers">{{name}}</td>
                                    <td name="phone_number_costumers">{{cpf}}</td>
                                    <td name="address_costumers">{{address}}</td>
                                    <td name="email_costumers">{{email}}</td>
                                    <td name="edit_name"><a href="../edit/editCostumer.php?id=$id"><svg
                                                xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor"
                                                class="bi bi-pencil-square" viewBox="0 0 16 16">
                                                <path
                                                    d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                                <path fill-rule="evenodd"
                                                    d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
                                            </svg>
                                        </a>
                                    <td name="delete_name">
                                        <a href="#" data-toggle="modal" data-target="#confirmDeleteModal$id">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor"
                                                class="bi bi-trash" viewBox="0 0 16 16">
                                                <path
                                                    d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6Z" />
                                                <path
                                                    d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1ZM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118ZM2.5 3h11V2h-11v1Z" />
                                            </svg>
                                        </a>

                                        <!-- Modal de confirmação de deleção -->
                                        <div class="modal fade" id="confirmDeleteModal$id" tabindex="-1" role="dialog"
                                            aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="confirmDeleteModalLabel">Confirmar Deleção</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        Tem certeza de que deseja excluir este livro?
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-dismiss="modal">Cancelar</button>
                                                        <a href="../../../controllerDB/delete/deleteCostumer.php?id=$id"
                                                            class="btn btn-danger">Excluir</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>

                            </tbody>
                        </form>
                    </table>
                </div>
            </main>',
        ]);


        //retorna a view da pagina
        return parent::getPage('Listagem de Usuarios',$content);
    }
}
