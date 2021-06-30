<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Foods extends Model
{
    protected $table = 'foods';
    
    public function __construct()
    {
        $this->table = 'foods';
    }

    public function get_where_id($id)
    {
        return DB::table($this->table)
            ->where($this->table . '.id', '=', $id)
            ->first();
    }

}
