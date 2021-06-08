<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Jenssegers\Mongodb\Eloquent\Model;

class Search extends Model
{
    static public function search($table, $fields)
    {
        return DB::collection($table)->where($fields)->get();
    }
}
