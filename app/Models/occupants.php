<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class occupants extends Model
{
    use HasFactory;
    protected $fillable = [
        'caretakerId',
        'name',
        'email',
        'phone',
        'password',
        'estate',
        'blockNumber',
        'flatNumber'];
}
