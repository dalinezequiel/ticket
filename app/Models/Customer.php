<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;
    protected $fillable = [
        'firstname', 
        'surname',
        'gender', 
        'email', 
        'birthday',
        'status',
        'description', 
        'path',
    ];
    protected $appends = ['image'];

    public function getImageAttribute()
    {
        return asset('/storage/attachment/' . $this->path);
    }
}
