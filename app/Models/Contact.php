<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Contact extends Model
{
    use HasFactory , Notifiable;
    protected $guarded = [];



    public function deals(){
        return $this->hasOne(Deal::class, 'contact_id');
    }


    public function account(){
        return $this->belongsTo(Account::class, 'account_id');
    }



   
}
