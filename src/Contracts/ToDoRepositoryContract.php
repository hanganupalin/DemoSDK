<?php
/**
 * Created by PhpStorm.
 * User: externaldev
 * Date: 14.08.18
 * Time: 09:44
 */
namespace DemoSDK\Contracts;

use DemoSDK\Models\ToDo;

/**
 * Class ToDoRepositoryContract
 * @package DemoSDK\Contracts
 */
interface ToDoRepositoryContract
{
    /**
     * Add a new task to the To Do list
     *
     * @param array $data
     * @return ToDo
     */
    public function createTask(array $data): ToDo;

    /**
     * List all tasks of the To Do list
     *
     * @return ToDo[]
     */
    public function getToDoList(): array;

    /**
     * Update the status of the task
     *
     * @param int $id
     * @return ToDo
     */
    public function updateTask($id): ToDo;

    /**
     * Delete a task from the To Do list
     *
     * @param int $id
     * @return ToDo
     */
    public function deleteTask($id): ToDo;
}
