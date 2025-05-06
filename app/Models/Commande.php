<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Commande extends Model
{
    protected $guarded = ['id'];

    public function medicaments()
    {
        return $this->belongsToMany(Medicament::class)
            ->using(CommandeMedicament::class)
            ->withPivot('quantity')
            ->withTimestamps();
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
