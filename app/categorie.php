<?php

namespace App;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class categorie extends Model
{
    //

    protected $table = "categories";
    protected $fillable = [
        'id',
        'name'
    ];

    public function getUser(): HasMany
    {
        return $this->hasMany(User::class, 'categories_id', 'id');
    }
}
