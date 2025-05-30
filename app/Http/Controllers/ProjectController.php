<?php

namespace App\Http\Controllers;

use App\Http\Requests\Project\StoreRequest;
use App\Http\Requests\Project\UpdateRequest;
use App\Http\Resources\ProjectResource;
use App\Services\ProjectService;
use Illuminate\Database\Eloquent\Casts\Json;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function __construct(
        protected ProjectService $projectService
    ) {
        //
    }
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $data = $this->projectService->getActives();
        return response()->json([
            'success' => true,
            'message' => 'Lista de proyectos obtenida correctamente.',
            'data' => ProjectResource::collection($data)
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        $data = $request->validated();
        $this->projectService->create($data);
        return response()->json([
            'success' => true,
            'message' => 'Proyecto creado correctamente.'
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = $this->projectService->find($id);
        return response()->json([
            'success' => true,
            'message' => 'Proyecto obtenido correctamente.',
            'data' => new ProjectResource($data)
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, string $id)
    {
        $data = $request->validated();
        $this->projectService->update($id, $data);
        return response()->json([
            'success' => true,
            'message' => 'Proyecto actualizado correctamente.'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->projectService->delete($id);
        return response()->json([
            'success' => true,
            'message' => 'Proyecto eliminado correctamente.'
        ]);
    }
}
