<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Events extends Model
{
    use HasFactory;
     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded  =[];
    protected $fillable = [
        'title',
        'description',
        'max_participants',
        'current_participants',
        'event_start_date',
        'event_end_date',
        'latitude',
        'longitude',
        'for_adults',
        'users_id',
    ];

    public function user(){
        return $this->hasOne(User::class,'id', 'users_id');
    }
    public function participants(){
        return $this->belongsTo(Participants::class);
    }
    public function messages(){
        return $this->belongsTo(Messages::class);
    }
    public function images(){
        return $this->hasOne(Images::class);
    }

    }

