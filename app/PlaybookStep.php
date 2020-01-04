<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PlaybookStep extends Model
{
    public function playbook()
    {
        return $this->belongsTo(playbook::class);
    }
}
