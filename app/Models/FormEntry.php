<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormEntry extends Model
{
    use HasFactory;
    protected $fillable = ['form_id', 'data'];

    protected $casts = [
        'data' => 'array',
    ];
    protected $dates = ['submitted_at'];
    public function form()
    {
        return $this->belongsTo(Form::class);
    }
}
