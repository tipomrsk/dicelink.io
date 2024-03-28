<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlayerCampaing extends Model
{
    use HasFactory;

    protected $fillable = [
        'player_uuid',
        'campaing_uuid',
    ];

}
