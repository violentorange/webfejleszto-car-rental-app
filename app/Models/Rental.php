<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Rental extends Model
{
    use HasFactory;

    protected $table ='rentals';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'car_id',
        'start_date',
        'end_date',
    ];

    public function car(): BelongsTo
    {
        return $this->belongsTo(Car::class, 'car_id', 'id');
    }
}
