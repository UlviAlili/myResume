<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Portfolios_Images;

class Portfolio extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function featuredImage()
    {
        return $this->hasOne(Portfolios_Images::class, 'portfolio_id', 'id')
                    ->where('featured', 1);
    }
}
