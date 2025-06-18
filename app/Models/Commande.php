<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Commande extends Model
{
    protected $fillable = [
        "user_id",
        "date",
        "status",
        "amount",
        "reject_reason",
        "pharmacy_id",
        "uuid",
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
