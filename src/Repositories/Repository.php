<?php


namespace App\Repositories;

abstract class Repository
{

    protected $model ;

    abstract protected function setModel() : string ;

    /**
     * Repositories constructor.
     */
    public function __construct()
    {
        $model = $this->setModel();
        $this->model = new $model();
    }

    /**
     * @return mixed
     */
    public function all()
    {
        return $this->model->all();
    }

    /**
     * @return mixed
     */
    public function first()
    {
        return $this->model->first();
    }

    /**
     * @return mixed
     */
    public function last()
    {
        return $this->model->latest()->first();
    }

    /**
     * @param array $data
     * @return mixed
     */
    public function create(array $data)
    {
        return $this->model->create($data);
    }
    /**
     * @param array $data
     * @return mixed
     */
    public function createMultiple(array $data)
    {
        return $this->model->insert($data);
    }

    /**
     * @return mixed
     */
    public function getTrashed()
    {
        return $this->model->withTrashed();
    }

    /**
     * @param $primaryKey
     * @return mixed
     */
    public function find($primaryKey)
    {
        return $this->model->find($primaryKey);
    }

    /**
     * @param array $conditions
     * @param array $select
     * @return mixed
     */
    public function findWhere(array $conditions, $select = ['*'])
    {
        foreach ($conditions as $key => $value ) {

            if (is_array($value)) {
                $this->model = $this->model->where($value[0], $value[1], $value[2]);
            }else{
                $this->model = $this->model->where($key, $value);
            }
        }

        return $this->model->select($select);
    }
    public function findWhereFirst(array $data)
    {
        return $this->model->where($data)->first();
    }

    /**
     * @param array $data
     * @param int $primaryKey
     * @return mixed
     */
    public function update(int $primaryKey,array $data)
    {
        return $this->model->find($primaryKey)->update($data);
    }

    /**
     * @param array $data
     * @param array $conds
     * @return mixed
     */
    public function updateByFields(array $data, array $conditions)
    {
        foreach($conditions as $key => $value) {
            $this->model = $this->model->where($key, $value);
        }

        return $this->model->update($data);
    }

    /**
     * @param $column
     * @param $value
     * @return mixed
     */
    public function where($column, $value)
    {
        return $this->model->where($column,$value)->get();
    }

    /**
     * @param array $conds
     * @param array $select
     * @return mixed
     */
    public function getWhere($conds = [], $select = ['*'])
    {
        foreach ($conds as $key=>$val) {
            if (is_array($val)) {
                $data = $this->model->where($val[0], $val[1], $val[2]);
            }else{
                $data = $this->model->where($key, $val);
            }
        }
        $data = $this->model->get($select);
        return $data;
    }

    /**
     * @param $relationship
     * @return $this
     */
    public function with($relationship)
    {
        $this->model = $this->model->with($relationship)->get();

        return $this;
    }

    /**
     * @param $primaryKey
     * @return mixed
     */
    public function delete($primaryKey)
    {
        return $this->model->delete($primaryKey);
    }

    /**
     * @param array $conditions
     * @return mixed
     */
    public function findFirst(array $conditions)
    {
        $data = $this->model->where($conditions)->first();
        return $data;
    }

    /**
     * @param array $conditions
     * @return $this
     */
    public function deleteWhere(array $conditions)
    {
        $this->findWhere($conditions)->delete();

        return $this;
    }

    /**
     * @param $primaryKey
     * @return $this
     */
    public function exists($primaryKey)
    {
        $this->find($primaryKey)->exists();

        return $this;
    }

    /**
     * @param array $data
     * @return mixed
     */
    public function getInsertedId(array $data)
    {
        return $this->model->insertGetId($data);
    }

}
