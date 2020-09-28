<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookEntry extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'surename', 'street', 'housenumber', 'location', 'zipcode', 'email', 'phonenumber'];
}
