<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use SoftDeletes;
    
    public $timestamps = true;
    protected $fillable = ['user_id', 'order_no'];
    protected $dates = ['deleted_at'];
    
}