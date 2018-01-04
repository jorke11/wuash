<?php

namespace App\Models\Operation;

use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    protected $fillable = [
        'user_id', 'type_vehicle_id', 'status_id', 'created', 'leaved',"address","services","day","hour","plate"
    ];
}
