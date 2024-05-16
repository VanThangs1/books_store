<?php
namespace App\Repositories;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Application;


abstract class BaseEloquentRepository 
{
   
    protected $app;

   
    protected $model;

    
    abstract public function model();

    
    public function __construct()
    {
        $this->app = app();
        $this->makeModel();
        $this->boot();
    }

   
    public function boot()
    {
    }

    
    public function makeModel()
    {
        $model = $this->app->make($this->model());

        if (!$model instanceof Model) {
            throw new RepositoryException("Class {$this->model()} must be an instance of Illuminate\\Database\\Eloquent\\Model");
        }

        return $this->model = $model;
    }

    
    public function resetModel()
    {
        $this->makeModel();
    }

    
    public function all($columns = array('*'))
    {
        if ($this->model instanceof Builder) {
            $results = $this->model->orderBy('created_at', 'ASC')->get($columns);
        } else {
            $results = $this->model->orderBy('created_at', 'DESC')->get($columns);
        }

        $this->resetModel();

        return $results;
    }

    public function findBySlug($slug, $columns = array('*'))
    {
        $results = $this->model->where('slug', '=', $slug)->first($columns);
        $this->resetModel();

        return $results;
    }

    public function create(array $attributes) {
        $model = $this -> model -> newInstance($attributes);
        $model -> save();
        return $model;
    }

    public function update(array $attributes, $id) {
        $model = $this -> model -> findOrfail($id);
        $model -> fill($attributes);
        $model -> save();

        $this -> resetModel();
        return $model;
    }

    public function delete($id) {
        $model = $this -> model -> find($id);
        $originModel = clone $model;

        $this -> resetModel();
        $deleted = $model -> delete();
        return $deleted;
    }

    public function findById($id, $columns = array('*'))
    {
        $results = $this->model->where('id', '=', $id)->first($columns);
        $this->resetModel();

        return $results;
    }

    public function deleteWhere(array $where)
    {
        foreach ($where as $field => $value) {
            if (is_array($value)) {
                list($field, $condition, $val) = $value;
                $this->model = $this->model->where($field, $condition, $val);
            } else {
                $this->model = $this->model->where($field, '=', $value);
            }
        }
        $results = $this->model->delete();
        $this->resetModel();
        return $results;
    }

    public function findWhere(array $where, $columns = array('*'))
    {
        $this->applyConditions($where);

        $results = $this->model->orderBy('id', 'DESC')->get($columns);
        $this->resetModel();

        return $results;
    }

    public function joinOne( $fieldjoin, $tablejoin, $columns = array('*'), $columjoin = array('*'))
    {
        $tableName = $this->model->getTable();
        $select = [];
        for($i = 0; $i < count($columns); $i ++){
            $item = $tableName.'.'.$columns[$i] . ' as f_' . $columns[$i];
            array_push($select, $item);
        }

        for($j = 0; $j < count($columjoin); $j ++){
            $itemPush = 'b.'.$columjoin[$j] . ' as ' . strtoupper($columjoin[$j]);
            array_push($select, $itemPush);
        }

        $results = $this->model
            ->where("$tableName.deleted_at", '=', null)
            ->leftjoin("$tablejoin as b", "b.id", '=', "$tableName.$fieldjoin")
            ->orderBy("$tableName.created_at", 'DESC')
            ->get($select);
        $this->resetModel();
        return $results;
    }

    public function joinFindId($field, $condition, $val, $tablejoin, $fieldjoin, $columns = array('*'))
    {
        $tableName = $this->model->getTable();
        $select = ["$tableName.*"];
        for($i = 0; $i < count($columns); $i ++){
            $itemPush = 'b.'.$columns[$i] . ' as ' . strtoupper($columns[$i]);
            array_push($select, $itemPush);
        }
        $results = $this->model
            ->where("$tableName.".$field, $condition, $val)
            ->leftjoin("$tablejoin as b", "b.id", '=', "$tableName.$fieldjoin")
            ->get($select);
        $this->resetModel();
        return $results;
    }

    public function countWhere(array $where, $columns = array('*'))
    {
        foreach ($where as $field => $value) {
            if (is_array($value)) {
                list($field, $condition, $val) = $value;
                $this->model = $this->model->where($field, $condition, $val);
            } else {
                $this->model = $this->model->where($field, '=', $value);
            }
        }

        $results = $this->model->select($columns)->count();
        $this->resetModel();

        return $results;
    }

    public function paginate($limit = null, $columns = array('*'))
    {
        $limit = is_null($limit) ? config('repository.pagination.limit', 20) : $limit;
        $results = $this->model->paginate($limit, $columns);
        $this->resetModel();

        return $results;
    }

    public function paginateOrderBy($limit = null, $columns = array('*'))
    {
        $limit = is_null($limit) ? config('repository.pagination.limit', 20) : $limit;
        $results = $this->model->orderBy('created_at', 'DESC')->paginate($limit, $columns);
        $this->resetModel();

        return $results;
    }

    public function paginateWhereOrderBy(array $where, $order_by = 'updated_at', $order = 'DESC', $current_page = null, $limit = null, $columns = array('*'))
    {
        $limit = is_null($limit) ? config('repository.pagination.limit', 10) : $limit;
        $current_page = is_null($current_page) ? config('repository.pagination.limit', 1) : $current_page;

        $this->applyConditions($where);

        $results = $this->model->orderBy($order_by, $order)->paginate($limit, $columns, 'page', $current_page);

        $this->resetModel();

        return $results;
    }

    public function paginateWhere(array $where, $current_page = null, $limit = null, $columns = array('*'))
    {
        $limit = is_null($limit) ? config('repository.pagination.limit', 10) : $limit;
        $current_page = is_null($current_page) ? config('repository.pagination.limit', 1) : $current_page;

        foreach ($where as $field => $value) {
            if (is_array($value)) {
                list($field, $condition, $val) = $value;
                $this->model = $this->model->where($field, $condition, $val);
            } else {
                $this->model = $this->model->where($field, '=', $value);
            }
        }
        $results = $this->model->orderBy('updated_at', 'DESC')->paginate($limit, $columns, 'page', $current_page);

        $this->resetModel();

        return $results;
    }

    public function whereLimit(array $where, $orderField, $orderType, $limit = null, $columns = array('*'))
    {
        $limit = is_null($limit) ? 10 : $limit;
        foreach ($where as $field => $value) {
            if (is_array($value)) {
                list($field, $condition, $val) = $value;
                $this->model = $this->model->where($field, $condition, $val);
            } else {
                $this->model = $this->model->where($field, '=', $value);
            }
        }
        $results = $this->model->orderBy($orderField, $orderType)
            ->limit($limit)
            ->get( $columns);

        $this->resetModel();
        return $results;
    }

    protected function applyConditions(array $where)
    {
        foreach ($where as $field => $value) {
            if (is_array($value)) {
                if (count($value) == 2) {
                    $condition = '=';
                    list($field, $val) = $value;
                } elseif (count($value) == 1) {
                    $field = $value[0];
                    $condition = null;
                    $val = null;
                } else {
                    list($field, $condition, $val) = $value;
                }
                //smooth input
                $condition = preg_replace('/\s\s+/', ' ', trim($condition));

                //split to get operator, syntax: "DATE >", "DATE =", "DAY <"
                $operator = explode(' ', $condition);
                if (count($operator) > 1) {
                    $condition = $operator[0];
                    $operator = $operator[1];
                } else $operator = null;
                switch (strtoupper($condition)) {
                    case 'IN':
                        if (!is_array($val)) throw new \Exception("Input {$val} mus be an array");
                        $this->model = $this->model->whereIn($field, $val);
                        break;
                    case 'NOTIN':
                        if (!is_array($val)) throw new \Exception("Input {$val} mus be an array");
                        $this->model = $this->model->whereNotIn($field, $val);
                        break;
                    case 'DATE':
                        if (!$operator) $operator = '=';
                        $this->model = $this->model->whereDate($field, $operator, $val);
                        break;
                    case 'DAY':
                        if (!$operator) $operator = '=';
                        $this->model = $this->model->whereDay($field, $operator, $val);
                        break;
                    case 'MONTH':
                        if (!$operator) $operator = '=';
                        $this->model = $this->model->whereMonth($field, $operator, $val);
                        break;
                    case 'YEAR':
                        if (!$operator) $operator = '=';
                        $this->model = $this->model->whereYear($field, $operator, $val);
                        break;
                    case 'EXISTS':
                        if (!($val instanceof \Closure)) throw new \Exception("Input {$val} must be closure function");
                        $this->model = $this->model->whereExists($val);
                        break;
                    case 'HAS':
                        if (!($val instanceof \Closure)) throw new \Exception("Input {$val} must be closure function");
                        $this->model = $this->model->whereHas($field, $val);
                        break;
                    case 'HASMORPH':
                        if (!($val instanceof \Closure)) throw new \Exception("Input {$val} must be closure function");
                        $this->model = $this->model->whereHasMorph($field, $val);
                        break;
                    case 'DOESNTHAVE':
                        if (!($val instanceof \Closure)) throw new \Exception("Input {$val} must be closure function");
                        $this->model = $this->model->whereDoesntHave($field, $val);
                        break;
                    case 'DOESNTHAVEMORPH':
                        if (!($val instanceof \Closure)) throw new \Exception("Input {$val} must be closure function");
                        $this->model = $this->model->whereDoesntHaveMorph($field, $val);
                        break;
                    case 'BETWEEN':
                        if (!is_array($val)) throw new \Exception("Input {$val} mus be an array");
                        $this->model = $this->model->whereBetween($field, $val);
                        break;
                    case 'BETWEENCOLUMNS':
                        if (!is_array($val)) throw new \Exception("Input {$val} mus be an array");
                        $this->model = $this->model->whereBetweenColumns($field, $val);
                        break;
                    case 'NOTBETWEEN':
                        if (!is_array($val)) throw new \Exception("Input {$val} mus be an array");
                        $this->model = $this->model->whereNotBetween($field, $val);
                        break;
                    case 'NOTBETWEENCOLUMNS':
                        if (!is_array($val)) throw new \Exception("Input {$val} mus be an array");
                        $this->model = $this->model->whereNotBetweenColumns($field, $val);
                        break;
                    case 'RAW':
                        $this->model = $this->model->whereRaw($val);
                        break;
                    default:
                        if (empty($condition)) {
                            $this->model = $this->model->where($field);
                        } else {
                            $this->model = $this->model->where($field, $condition, $val);
                        }
                }
            } else {
                $this->model = $this->model->where($field, '=', $value);
            }
        }
    }
}