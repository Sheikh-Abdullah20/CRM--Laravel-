<?php

namespace App\Models;

use App\Models\Contact;
use App\Models\Lead;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Meeting extends Model
{
    use HasFactory;

    protected $guarded = [];


    public function contacts(){
        return $this->belongsTo(Contact::class, 'meeting_participants_id','id');
    }


    public function leads(){
        return $this->belongsTo(Lead::class, 'meeting_participants_id','id');
    }
    public function accounts(){
        return $this->belongsTo(Account::class, 'meeting_participants_id','id');
    }

    public function user(){
        return $this->belongsTo(User::class,'meeting_creator_id','id');
    }


    protected $casts = [
        'meeting_from' => 'datetime',
        'meeting_to' => 'datetime',
    ];
}
