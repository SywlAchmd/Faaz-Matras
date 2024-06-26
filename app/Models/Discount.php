<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Discount extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function menus(): BelongsToMany
    {
        return $this->belongsToMany(Menu::class);
    }
}
