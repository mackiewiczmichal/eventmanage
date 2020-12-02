<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Messages extends Model
{
    use HasFactory;

    protected $guarded  =[];


    protected $fillable = [
        'events_id',
        'title',
        'content',
    ];
    public function events(){
        return $this->hasMany(Events::class);
    }
}
