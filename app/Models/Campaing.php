<?php

namespace App\Models;

use App\Enums\Campaings\HasMaster;
use App\Enums\Campaings\IsOnline;
use App\Enums\Campaings\Status;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Campaing extends Model
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

    public function players(): BelongsToMany
    {
        return $this->belongsToMany(Player::class, 'player_campaings', 'campaing_uuid', 'player_uuid');
    }
}
