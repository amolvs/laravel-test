<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = "category";
    protected $primaryKey = "id";
    protected $guarded = ["id"];

    public function scopeGetMasterCategory($query)
    {
        return $query->where('category.parent_category_id', 0);
    }

    public function masterCategory()
    {
        return $this->hasOne('App\Category', 'id', 'parent_category_id');
    }
}
