<?php

namespace Database\Seeders;

use App\Models\Commande;
use App\Models\CommandeDetails;
use App\Models\Medicament;
use App\Models\Pharmacy;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {

        User::create([
            'name' => 'admin',
            'email' => 'admin@example.com',
            'password' => 'admin',
        ]);

        
        $pharmacy = Pharmacy::create([
            'name' => 'Pharmacy One',
            'address' => '123 Main St',
            'city' => 'Anytown',
            'state' => 'CA',
        ]);
        
        $user = User::create([
            'name' => 'test',
            'email' => 'test@example.com',
            'password' => 'test',
            'pharmacy_id' => $pharmacy->id,
        ]);
        
        $commande = Commande::create([
            'user_id' => $user->id,
            'uuid' => \Illuminate\Support\Str::uuid(),
            'date' => now(),
            'amount' => 290,
            'status' => "pending",
            'pharmacy_id' => $pharmacy->id
        ]);

        $medicament =[
             [
            'commande_id' => $commande->id,
            'name' => "test",
            'price' => 20,
            'quantity' => 2,
             ],
             [
            'commande_id' => $commande->id,
            'name' => "test2",
            'price' => 56,
            'quantity' => 5,
             ],
             [
            'commande_id' => $commande->id,
            'name' => "test3",
            'price' => 19,
            'quantity' => 10,
             ],
             [
            'commande_id' => $commande->id,
            'name' => "test 4",
            'price' => 18.5,
            'quantity' => 1,
             ],
    ];

        CommandeDetails::insert($medicament);

    }
}
