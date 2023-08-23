<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;

class Repository
{
    public Model $model;


    /**
     * @param $id
     * @return Model
     */
    public function find($id): Model
    {
        return $this->model->find($id);
    }

}
