<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    protected $table = "products";
    protected $fillable = ['id', 'name', 'idcategory'];
    protected $hidden = ['password', 'remember_token'];
    public $timestamps = false;

}
