<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class playbook extends Model
{
    protected $fillable = [
        'name',
    ];

    public function steps()
    {
        return $this->hasMany(PlaybookStep::class);
    }
    public function gaps()
    {
        return $this->hasMany(PlaybookStep::class);
    }
}
