<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PelayanMisa extends Model
{
    use HasFactory;
    protected $table = 'pelayan_misa';

    /**
     * Get the misdinar associated with the PelayanMisa
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function misdinar(): HasOne
    {
        return $this->hasOne(Misdinar::class, 'id', 'id_misdinar');
    }

}
