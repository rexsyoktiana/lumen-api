<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class Orders extends Model
{
    protected $table = 'orders';

    public function __construct()
    {
        $this->table = 'orders';
    }

    public function get_where($status)
    {
        return DB::table($this->table)
            ->where('order_status', '=', $status)
            ->get();
    }

    public function get_last_order()
    {
        return DB::table($this->table)
            ->orderBy('created_at', 'DESC')
            ->limit(1)
            ->get();
    }

    public function create($data)
    {
        return DB::table($this->table)
            ->insert($data);
    }

    public function get_where_id($id)
    {
        return DB::table($this->table)
            ->where($this->table . '.id', '=', $id)
            ->first();
    }

    public function get_all()
    {
        return DB::table($this->table)
            ->join('order_details', 'order_details.id_order', '=', $this->table.'.id')
            ->join('foods', 'foods.id', '=', 'order_details.id_food')
            ->get();
    }

    public function get_all_by_id($id)
    {
        return DB::table($this->table)
            ->where($this->table.'.id', '=', $id)
            ->join('order_details', 'order_details.id_order', '=', $this->table.'.id')
            ->join('foods', 'foods.id', '=', 'order_details.id_food')
            ->get();
    }

    public function get_all_waiters($id)
    {
        return DB::table($this->table)
            ->where($this->table.'.id_user', '=', $id)
            ->join('order_details', 'order_details.id_order', '=', $this->table.'.id')
            ->join('foods', 'foods.id', '=', 'order_details.id_food')
            ->get();
    }

    public function edit($id, $data)
    {
        return DB::table($this->table)
            ->where($this->table.'.id', '=', $id)
            ->update($data);
    }
}
