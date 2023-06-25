<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CategoryGroup extends Model
{
    use HasFactory;

    public function categories(): hasMany
    {
        return $this->hasMany(Category::class);
    }
}
