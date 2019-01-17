<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ArticleModel extends Model
{
    use SoftDeletes;
    protected $table = 'articles';

    public function labels()
    {
        return $this->belongsToMany(LabelsModel::class,'set_artitle_label','article_id','label_id');
    }
    public function category()
    {
        return $this->belongsToMany(CategoryListModel::class,'set_artitle_sort','article_id','category_id');
    }
}
