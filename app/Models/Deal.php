<?php

namespace App\Models;

use App\Models\Account;
use App\Models\Contact;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Deal extends Model
{
    use HasFactory;
    protected $guarded = [];


    public function account(){
        return $this->belongsTo(Account::class,'account_id');
    }

    public function contact(){
        return $this->belongsTo(Contact::class,'contact_id');
    }
}
