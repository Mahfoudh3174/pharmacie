<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class CommandeMedicament extends Pivot
{
    protected $table = 'commande_medicament';
    
    protected $fillable = [
        'commande_id',
        'medicament_id',
        'quantity'
    ];
}