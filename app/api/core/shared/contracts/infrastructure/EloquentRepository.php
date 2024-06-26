<?php

/*
Author: David
Fecha: 20/05/2024
*/


namespace App\api\core\shared\contracts\infrastructure;
use App\api\core\shared\contracts\domain\BaseDomain;
use App\api\core\shared\contracts\domain\RepositoryBD;
use Faker\Provider\Base;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;


class EloquentRepository implements RepositoryBD
{
    protected $model;
    protected $domain;

    public function __construct(Model $model,BaseDomain $domain)
    {
        $this->model=$model;
        $this->domain=$domain;
    }

    public function find($id):?BaseDomain{
        $this->model=$this->model::findOrFail($id);
        if($this->model){
            return $this->domain::create($this->model->toArray());
        }
        return null;
    }

    public function where($params):Collection{

        $return=new Collection();

        $query = clone $this->model; // Clonar la instancia original del modelo

        if(count($params)>0){
           foreach ($params as $key => $value) {
               $query = $this->model->where($key, $value);
            }

        }

        $collection=$query->get();

         if ($collection->count()>0){
            foreach($collection as $row){
                $return->push($this->domain::create($row->toArray()));
            }
        }

        return $return;

    }

    public function save(BaseDomain $domain):?BaseDomain{


        $this->model=$this->model->create((array) $domain);
        return $this->domain::create($this->model->toArray());

    }

    public function update(BaseDomain $domain ):BaseDomain{

        $this->model=$this->model::findOrFail($domain->getId());

        $this->model->update((array)$domain);

        return $this->domain::create($this->model->toArray());
    }

    public function remove($id):bool{

        return $this->model::findOrFail($id)
            ->delete();

    }

    public function get():Array
    {
        $collect=$this->model::all();
        return $collect->toArray();
    }

    public function paginate($perPage = 15):Array
    {
        return $this->model->paginate($perPage)->toArray();
    }

    public function getModel(){
        return $this->model;
    }


}
