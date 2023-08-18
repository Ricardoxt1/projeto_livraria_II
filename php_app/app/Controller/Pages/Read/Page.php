<?php

namespace App\Controller\Pages\Read;

use App\Http\Request;
use \App\Utils\View;
use WilliamCosta\DatabaseManager\Pagination;

class Page
{

    /**
     * método responsável por redenrizar o topo da página com a navbar
     * @return string View::render
     */
    private static function getNavBar(): string
    {
        return View::render('pages/list/navbar');
    }

    /**
     * método responsável por redenrizar a sidebar da página
     * @return string View::render
     */
    private static function getSideBar(): string
    {
        return View::render('pages/list/sidebar');
    }

    /**
     * método responsável por redenrizar o rodapé da página
     * @return string View::render
     */
    private static function getFooter(): string
    {
        return View::render('pages/list/footer');
    }

    /**
     * método responsável por redenrizar o layout de paginação
     * @param Request $request
     * @param Pagination $obPagination
     * @return string View::render
     */
    public static function getPagination(Request $request, Pagination $obPagination): string
    {
        //páginas
        $pages = $obPagination->getPages();

        //verifica a quantidade de páginas 
        if (count($pages) <= 1) return '';

        //links
        $links = '';

        //URL ATUAL (SEM GETS)
        $url = $request->getRouter()->getCurrentUrl();

        //GET
        $queryParams = $request->getQueryParams();

        //RENDERIZA OS LINKS
        foreach ($pages as $page) {
            //ALTERA A PÁGINA
            $queryParams['page'] = $page['page'];

            //LINK
            $link = $url . '?' . http_build_query($queryParams);

            //View
            $links .= View::render('pages/pagination/link', [

                'page' => $page['page'],
                'link' => $link,
                'active' => $page['current'] ? 'active' : '',
            ]);

            //redenriza box da pagina
            return View::render('pages/pagination/box', [
                'links' => $links
            ]);
        }
    }

    /** metodo para resgatar os dados da pagina genérica (view)
     * @return string View::render
     * @param string $titule
     * @param string $content
     *  */
    public static function getPage(string $titule, string $content): string
    {

        return View::render('pages/list/page', [
            //contéudo do tilulo
            'titule' => $titule,
            //contéudo do navbar
            'navbar' => self::getNavBar(),
            //contéudo do sidebar
            'sidebar' => self::getSidebar(),
            //conteúdo body
            'content' => $content,
            //conteúdo footer
            'footer' => self::getFooter(),

        ]);
    }

    /** metodo para resgatar os dados da pagina genérica (view)
     * @return string View::render
     * @param string $titule
     * @param string $content
     *  */
    public static function getPageHome(string $titule, string $content): string
    {

        return View::render('pages/list/page', [
            //contéudo do tilulo
            'titule' => $titule,
            //contéudo do navbar
            'navbar' => self::getNavBar(),
            //conteúdo body
            'content' => $content,
            //conteúdo footer
            'footer' => self::getFooter(),

            'sidebar' => '',

        ]);
    }
}
