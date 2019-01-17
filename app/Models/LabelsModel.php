<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class LabelsModel extends Model
{
    protected $table = 'labels';

    public function articles()
    {
        return $this->belongsToMany(ArticleModel::class,'article','label_id','article_id');
    }

    public function getLabelInfo()
    {
        return DB::table($this->table)
            ->whereNull('deleted_at')
            ->pluck('category_name','id')->toArray();
    }
}
