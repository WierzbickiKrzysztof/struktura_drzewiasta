<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tree extends Model
{
    use HasFactory;

    protected $table = 'tree';
    protected $fillable = ['name', 'parent_id', 'position'];
    public function children()
    {
        return $this->hasMany(Tree::class, 'parent_id', 'id');
    }

    public function parent()
    {
        return $this->belongsTo(Tree::class, 'parent_id');
    }

}
