<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Experience extends Model
{
    use HasFactory;

    protected $table   = "experience";
    protected $guarded = [];

    public function scopeStatus($query)
    {
        return $query->where('status', 1);
    }
}
