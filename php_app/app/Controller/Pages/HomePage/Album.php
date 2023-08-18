<?php

namespace App\Controller\Pages\HomePage;

use \App\Utils\View;

class Album extends PageH
{

    /** metodo para resgatar os dados da pagina de album (view)
     * @return string parent::getPageH
     *  */
    public static function getJRR(): string
    {


        $content = View::render('pages/homePage/album', [
            //view album
            'author' => 'J.R.R. Tolkien',
            'substitule' => 'Lorem ipsum dolor sit amet, consectetur adip incididunt',
            'src'   => '/resources/img/books/senhor dos aneis/SA1.jpg',
            'titule' => 'A sociedade do Anel',
            'describe' => 'Lorem ipsum dolor sit amet, consectet'

        ]);


        //retorna a view da pagina
        return parent::getPageH('Album de J.R.R. Tolkien ', $content);
    }

    /** metodo para resgatar os dados da pagina de album (view)
     * @return string parent::getPageH
     *  */
    public static function getJK(): string
    {


        $content = View::render('pages/homePage/album', [
            //view album
            'author' => 'J.K.Rowling',
            'substitule' => 'Lorem ipsum dolor sit amet, consectetur adip incididunt',
            'src'   => '/resources/img/books/hp/HP1.jpg',
            'titule' => 'A sociedade do Anel',
            'describe' => 'Lorem ipsum dolor sit amet, consectet adip incididunt desc Description Description Description Description Description Description Description Description Description Description Description Description Description Description Description Description Description',

        ]);


        //retorna a view da pagina
        return parent::getPageH('Album de J.K.Rowling', $content);
    }

    /** metodo para resgatar os dados da pagina de album (view)
     * @return string parent::getPageH
     *  */
    public static function getJMaas(): string
    {


        $content = View::render('pages/homePage/album', [
            //view album
            'author' => 'Sarah J Maas',
            'substitule' => 'Lorem ipsum dolor sit amet, consectetur adip incididunt',
            'src'   => '/resources/img/books/trono de vidro/TV1.jpg',
            'titule' => 'A sociedade do Anel',
            'describe' => 'Lorem ipsum dolor sit amet, consectet'
        ]);


        //retorna a view da pagina
        return parent::getPageH('Album de Sarah J Maas', $content);
    }
}
