<?php

namespace App\Services;

use App\Models\Task;

class TaskService extends BaseService
{
    public function __construct()
    {
        parent::__construct(Task::class);
    }

    public function getTasksByProjectId(int $projectId)
    {
        return $this->modelClass::where('project_id', $projectId)->get();
    }
}
