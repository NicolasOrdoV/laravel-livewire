<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactCompany extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'identificaction',
        'contact_general_id',
        'choices',
        'extra',
        'email'
    ];

    public function general()
    {
        return $this->belongsTo(ContactPerson::class, 'contact_general_id');
    }
}
