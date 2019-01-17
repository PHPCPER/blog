<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ArticleLabelModel extends Model
{
    use SoftDeletes;
    protected $table = 'artisan_label';
}
