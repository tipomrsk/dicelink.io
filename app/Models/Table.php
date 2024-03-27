<?php

namespace App\Models;

use App\Enums\Tables\HasMaster;
use App\Enums\Tables\IsOnline;
use App\Enums\Tables\Status;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Table extends Model
{
    use HasFactory, HasUuids;

    protected $primaryKey = 'uuid';

    protected $casts = [
        'status' => Status::class,
        'has_master' => HasMaster::class,
        'is_online' => IsOnline::class,
        'start_date' => 'datetime:d/m/Y',
    ];

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

    public function uniqueIds(): array
    {
        return ['uuid'];
    }
}
