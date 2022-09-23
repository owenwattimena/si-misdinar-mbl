<?php

namespace App\Models;

use App\Models\PelayanMisa;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class Misa extends Model
{
    use HasFactory;
    protected $table = 'misa';

    /**
     * Get the pelayanMisa that owns the Misa
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function pelayanMisa(): BelongsTo
    {
        return $this->belongsTo(PelayanMisa::class, 'id_misa', 'id');
    }

    /**
     * Get all of the pelayan for the Misa
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasManyThrough
     */
    public function pelayan()
    {
        return $this->hasMany(PelayanMisa::class, 'id_misa', 'id');
    }
}
