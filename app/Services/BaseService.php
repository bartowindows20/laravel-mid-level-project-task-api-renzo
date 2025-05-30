<?php

namespace App\Services;

use Illuminate\Database\Eloquent\Model;

class BaseService
{

    public function __construct(
        protected string $modelClass
    ) {
        //
    }

    public function create(array $data): Model
    {
        return $this->modelClass::create($data);
    }

    public function update($id, array $data)
    {
        $model = $this->modelClass::findOrFail($id);
        $model->update($data);
        return $model;
    }

    public function destroy($id)
    {
        $model = $this->modelClass::findOrFail($id);
        $model->delete();
    }

    public function find($id)
    {
        return $this->modelClass::findOrFail($id);
    }

    public function show($id)
    {

        return $this->modelClass::where('status', 'active')->findOrFail($id);
    }

    public function all()
    {
        return $this->modelClass::all();
    }

    public function delete(string $id): bool
    {
        return $this->modelClass::findOrFail($id)->update(['status' => 'inactive']);
    }

    public function getActives()
    {
        return $this->modelClass::where('status', 'active')->get();
    }
}
