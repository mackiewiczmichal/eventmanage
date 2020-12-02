<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Images extends Model
{
    use HasFactory;
    protected $guarded  =[];
    protected $fillable = [
        'name',
        'image_path'
    ];

    public function events(){
        return $this->belongsTo(Events::class);
    }
    public function setFilenamesAttribute($value)
    {
        $this->attributes['imageFile'] = json_encode($value);
    }
}

