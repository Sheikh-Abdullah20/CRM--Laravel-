<?php

namespace App\Models;

use App\Models\Meeting;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reminder extends Model
{
    use HasFactory;
    protected $guarded = [];


    public function meetings(){
        return $this->belongsTo(Meeting::class, 'meeting_id','id');
    }
}
