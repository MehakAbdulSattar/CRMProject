<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    use HasFactory;
    protected $fillable = ['name','model_type', 'user_id', 'model_id'];

    public function user()
    {
        
        return $this->belongsTo(User::class);
    }
}
