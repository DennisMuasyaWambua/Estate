<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class caretaker extends Model
{
    use HasFactory;

    //make users occupants
    public function makeUsersOccupants(){}

    //remove occupants
    public function removeOccupants(){}
}
