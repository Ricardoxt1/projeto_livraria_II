<?php

namespace App\Controller\Pages\Read;

use \App\Utils\View;


class Page
{

    /**
     * método responsável por redenrizar o topo da página com a navbar
     * @return string
     */
    private static function getNavBar()
    {
        return View::render('pages/list/navbar');
    }

    /**
     * método responsável por redenrizar a sidebar da página
     * @return string
     */
    private static function getSideBar()
    {
        return View::render('pages/list/sidebar');
    }

    /**
     * método responsável por redenrizar o rodapé da página
     * @return string
     */
    private static function getFooter()
    {
        return View::render('pages/list/footer');
    }

    /**
     * método responsável por redenrizar o layout de paginação
     * @param request $request
     * @param pagination $obPagination
     * @return string
     */
    public static function getPagination($request, $obPagination)
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
     * @return string
     *  */
    public static function getPage($titule, $content)
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
     * @return string
     *  */
    public static function getPageHome($titule, $content)
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

        ]);
    }
}
