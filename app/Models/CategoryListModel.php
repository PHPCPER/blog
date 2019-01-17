<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class CategoryListModel extends Model
{
    protected $table = 'category_list';

    public function getCategoryInfo()
    {
        return DB::table($this->table)
            ->whereNull('deleted_at')
            ->pluck('category_name','id')->toArray();
    }
}
