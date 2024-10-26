<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Supplements extends Model
{
    use SoftDeletes;
    protected $table = 'supplements';
    protected $fillable = ['name','price','available_qty','image','description'];
    
}
