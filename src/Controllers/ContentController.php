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
use Plenty\Plugin\Log\Loggable;
use DemoSDK\Contracts\ToDoRepositoryContract;
/**
 * Class ContentController
 * @package DemoSDK\Controllers
 */
class ContentController extends Controller
{
    use Loggable;
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
        return json_encode($packagistResult,true);
    }

    /**
     * @param Twig $twig
     * @param ToDoRepositoryContract $toDoRepo
     * @return string
     */
    public function showToDo(Twig $twig, ToDoRepositoryContract $toDoRepo): string
    {
        $toDoList = $toDoRepo->getToDoList();
        $templateData = array("tasks" => $toDoList);
        return $twig->render('DemoSDK::content.todo', $templateData);
    }

    /**
     * @param  \Plenty\Plugin\Http\Request $request
     * @param ToDoRepositoryContract       $toDoRepo
     * @return string
     */
    public function createToDo(Request $request, ToDoRepositoryContract $toDoRepo): string
    {
        $newToDo = $toDoRepo->createTask($request->all());
        $this
            ->getLogger('ContentController_createToDo')
            ->setReferenceType('toDoId')
            ->setReferenceValue($newToDo->id)
            ->info('DemoSDK::migration.createToDoInformation', ['userId' => $newToDo->createdForId ]);
        return json_encode($newToDo);
    }

    /**
     * @param int                    $id
     * @param ToDoRepositoryContract $toDoRepo
     * @return string
     */
    public function updateToDo(int $id, ToDoRepositoryContract $toDoRepo): string
    {
        $updateToDo = $toDoRepo->updateTask($id);
        $this
            ->getLogger('ContentController_updateToDo')
            ->setReferenceType('toDoId')
            ->setReferenceValue($id)
            ->info('DemoSDK::migration.updateToDoInformation', ['id' => $id ]);
        return json_encode($updateToDo);
    }

    /**
     * @param int                    $id
     * @param ToDoRepositoryContract $toDoRepo
     * @return string
     */
    public function removeToDo(int $id, ToDoRepositoryContract $toDoRepo): string
    {
        $deleteToDo = $toDoRepo->deleteTask($id);
        return json_encode($deleteToDo);
    }
}