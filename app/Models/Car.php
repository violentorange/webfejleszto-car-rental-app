<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Car extends Model
{
    use HasFactory;

    protected $table = 'cars';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'plate_number',
        'owner',
        'model',
        'make',
        'performance',
    ];

    public function rentals(): HasMany
    {
        return $this->hasMany(Rental::class, 'car_id', 'id');
    }
}
