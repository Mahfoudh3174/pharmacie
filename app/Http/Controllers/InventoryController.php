<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InventoryController extends Controller
{
    public function index()
    {
        return view('inventory.index');
    }

    public function expired()
    {
        return view('inventory.expired');
    }

    public function lowStock()
    {
        return view('inventory.low-stock');
    }

    public function create()
    {
        return view('inventory.create');
    }
}
