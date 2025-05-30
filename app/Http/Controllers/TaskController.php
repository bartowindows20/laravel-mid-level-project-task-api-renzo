<?php

namespace App\Http\Controllers;

use App\Http\Requests\Task\StoreRequest;
use App\Http\Requests\Task\UpdateRequest;
use App\Services\TaskService;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function __construct(protected TaskService $taskService)
    {
        //
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = $this->taskService->all();
        return response()->json([
            'success' => true,
            'message' => 'Lista de tareas obtenida correctamente.',
            'data' => $data
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        $data = $request->validated();
        $this->taskService->create($data);
        return response()->json([
            'success' => true,
            'message' => 'Tarea creada correctamente.'
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = $this->taskService->find($id);
        return response()->json([
            'success' => true,
            'message' => 'Tarea obtenida correctamente.',
            'data' => $data
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, string $id)
    {
        $data = $request->validated();
        $this->taskService->update($id, $data);
        return response()->json([
            'success' => true,
            'message' => 'Tarea actualizada correctamente.'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->taskService->destroy($id);
        return response()->json([
            'success' => true,
            'message' => 'Tarea eliminada correctamente.'
        ]);
    }
}
