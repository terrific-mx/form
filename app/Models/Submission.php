<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Submission extends Model
{
    protected function casts(): array
    {
        return [
            'data' => 'array',
        ];
    }

    protected $guarded = [];

    public function form()
    {
        return $this->belongsTo(Form::class);
    }
}
