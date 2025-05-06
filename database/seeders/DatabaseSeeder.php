<?php

namespace Database\Seeders;

use App\Models\Commande;
use App\Models\Medicament;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $m1 = Medicament::create([
            'nom' => 'Paracetamol',
            'description' => 'Pain reliever and fever reducer',
            'prix' => 10.00,
            'quantite' => 100,
            'date_expiration' => '2026-05-06'
        ]);

        $m2 = Medicament::create([
            'nom' => 'Ibuprofen',
            'description' => 'Anti-inflammatory medication',
            'prix' => 15.00,
            'quantite' => 50,
            'date_expiration' => '2026-05-06'
        ]);

        $user = User::create([
            'name' => 'admin',
            'email' => 'admin@example.com',
            'password' => bcrypt('admin'),
        ]);

        $commande = Commande::create([
            'user_id' => $user->id,
            'total' => 55.00,
            'status' => 'pending',
            'mode_paiement' => 'cash',
            'adresse_livraison' => '123 Main St'
        ]);

        // Attach medicaments to commande with quantities
        $commande->medicaments()->attach([
            $m1->id => ['quantity' => 2],
            $m2->id => ['quantity' => 3]
        ]);
    }
}
