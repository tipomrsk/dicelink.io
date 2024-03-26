<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Table extends Model
{
    use HasFactory, HasUuids;

    public function uniqueIds(): array
    {
        return ['uuid'];
    }

    protected $fillable = [
        'name',
        'description',
        'status',
        'seats',
        'has_master',
        'start_date',
        'is_online',
        'address',
        'city',
        'state',
        'country',
        'obs',
    ];
}
