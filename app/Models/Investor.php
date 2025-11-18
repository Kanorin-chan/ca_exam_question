<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Investor extends Model
{
    protected $fillable = [
        'name', 'contact_number', 'email',
    ];

    public function investments()
    {
        return $this->hasMany(Investment::class);
    }
}
