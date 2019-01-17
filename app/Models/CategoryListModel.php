<?php

namespace App\Models;

use Encore\Admin\Traits\AdminBuilder;
use Encore\Admin\Traits\ModelTree;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class CategoryListModel extends Model
{
    use SoftDeletes;
    use ModelTree, AdminBuilder;
    protected $table = 'category_list';

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->setParentColumn('parent_id');
        $this->setOrderColumn('sort');
        $this->setTitleColumn('category_name');
    }

    public function getCategoryInfo()
    {
        return DB::table($this->table)
            ->whereNull('deleted_at')
            ->pluck('category_name','id')->toArray();
    }
}
