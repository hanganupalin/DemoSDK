<?php
/**
 * Created by PhpStorm.
 * User: externaldev
 * Date: 14.08.18
 * Time: 10:08
 */
namespace DemoSDK\Repositories;

use Plenty\Exceptions\ValidationException;
use Plenty\Modules\Plugin\DataBase\Contracts\DataBase;
use DemoSDK\Contracts\ToDoRepositoryContract;
use DemoSDK\Models\ToDo;
use DemoSDK\Validators\ToDoValidator;
use Plenty\Modules\Frontend\Services\AccountService;


class ToDoRepository implements ToDoRepositoryContract
{
    /**
     * @var AccountService
     */
    private $accountService;
    /**
     * @var DataBase
     */
    private $db;

    /**
     * UserSession constructor.
     * @param AccountService $accountService
     */
    public function __construct(AccountService $accountService)
    {
        $this->accountService = $accountService;
        $this->db = pluginApp(DataBase::class);
    }

    /**
     * Get the current contact ID
     * @return int
     */
    public function getCurrentContactId(): int
    {
        return $this->accountService->getAccountContactId();
    }

    /**
     * @return array
     */
    public function getToDoList(): array
    {
        $id = $this->getCurrentContactId();

        $toDoList = $this->db->query(ToDo::class)->where('createdForId', '=', $id)->get();
        return $toDoList;
    }

    /**
     * @param array $data
     * @return ToDo
     * @throws ValidationException
     * @throws \DatabaseModelException
     * @throws \ErrorException
     */
    public function createTask(array $data): ToDo
    {
        try {
            ToDoValidator::validateOrFail($data);
        } catch (ValidationException $e) {
            throw $e;
        }


        $toDo = pluginApp(ToDo::class);
        $toDo->name = $data['name'];
        $toDo->createdById = $this->getCurrentContactId();
        $toDo->createdForId = $this->getCurrentContactId();
        $toDo->createdAt = time();

        $this->db->save($toDo);

        return $toDo;
    }

    /**
     * @param int $id
     * @return ToDo
     */
    public function updateTask($id): ToDo
    {
        $toDoList = $this->db->query(ToDo::class)
            ->where('id', '=', $id)
            ->get();

        $toDo = $toDoList[0];
        $toDo->isDone = true;
        $this->db->save($toDo);

        return $toDo;
    }

    /**
     * @param int $id
     * @return ToDo
     * @throws \ErrorException
     */
    public function deleteTask($id): ToDo
    {

        $toDoList = $this->db->query(ToDo::class)
            ->where('id', '=', $id)
            ->get();

        $toDo = $toDoList[0];
        $this->db->delete($toDo);

        return $toDo;
    }

}
