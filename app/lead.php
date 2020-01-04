<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class lead extends Model
{

    protected $fillable = [
        'name', 'surname', 'email', 'phoneNumber', 'country', 'current_step', 'created_date', 'schedule', 'due_date', 'current_step',
    ];

    public function emailHistory()
    {

        return $this->hasMany(email::class);

    }

    public function callHistory()
    {

        return $this->hasMany(Call::class);

    }

    public function playbook()
    {
        return $this->belongsTo(playbook::class, 'schedule', 'name');
    }

    public function getCurrentStepNameAttribute()
    {
        return optional($this->currentPlaybookStep())->type;
    }

    public function currentPlaybookStep()
    {
        $step = PlaybookStep::where('playbook_id', $this->schedule)
            ->where('step', $this->current_step)->first();
        return $step;
    }
}
