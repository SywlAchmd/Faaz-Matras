<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Menu extends Model implements HasMedia

{
    use HasFactory, InteractsWithMedia;
    protected $guarded = [];

    // protected function casts(): array
    // {
    //     return [
    //         'status' => 'boolean',
    //     ];
    // }
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'categories_id');
    }

    public function discount(): BelongsToMany
    {
        return $this->belongsToMany(Discount::class);
    }

}
