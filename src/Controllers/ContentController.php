<?php
/**
 * Created by PhpStorm.
 * User: externaldev
 * Date: 14.08.18
 * Time: 08:09
 */

namespace DemoSDK\Controllers;

use Plenty\Plugin\Controller;
use Plenty\Plugin\Templates\Twig;
use Plenty\Modules\Plugin\Libs\Contracts\LibraryCallContract;
use Plenty\Plugin\Http\Request;

/**
 * Class ContentController
 * @package DemoSDK\Controllers
 */
class ContentController extends Controller
{
    /**
     * @param Twig $twig
     * @param LibraryCallContract $libCall
     * @param Request $request
     * @return string
     */
    public function seyHi(
        Twig $twig,
        LibraryCallContract $libCall,
        Request $request
    )
    {

        $packagistResult =
            $libCall->call(
                'DemoSDK::items_list',
                ['packagist_query' => $request->get('search')]
            );
        return $twig->render('DemoSDK::content.index', $packagistResult);
    }
}