<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class OrderDetails extends Model
{

    protected $table = 'order_details';

    public function __construct()
    {
        $this->table    = 'order_details';
    }

    public function get_where_id($id)
    {
        return DB::table($this->table)
            ->where($this->table . '.id', '=', $id)
            ->first();
    }

}
