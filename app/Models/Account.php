<?php

namespace App\Models;

use App\Models\Deal;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    use HasFactory;
    protected $guarded = [];


   

    public function deals(){
        return $this->hasOne(Deal::class, 'account_id');
    }


    public function contacts(){
        return $this->hasOne(Contact::class, 'account_id');
    }
}
