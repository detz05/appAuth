<?php

namespace App;

use App\categorie;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'name',
        'lstname',
        'document_type',
        'document_number',
        'phone',
        'email',
        'categories_id',
        'country',
        'street',
    ];

    public function getCategorie(): BelongsTo
    {
        return $this->belongsTo(categorie::class, 'categories_id', 'id');
    }
}
