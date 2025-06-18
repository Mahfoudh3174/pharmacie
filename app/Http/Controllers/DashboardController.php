<?php

namespace App\Http\Controllers;

use App\Models\Commande;
use App\Models\Medication;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();

        // Load pharmacy with counts and additional data
        $pharmacy = $user->pharmacy()->withCount([
            'medications',
            'medications as low_stock_count' => fn($q) => $q->whereBetween('medication_pharmacy.stock', [1, 9]),
            'medications as out_of_stock_count' => fn($q) => $q->where('medication_pharmacy.stock', 0)
        ])->first();

        // Get all medications for quick add modal
        $allMedications = Medication::orderBy('name')->get();

        // Enhanced commandes query with filtering and sorting
        $commandes = $pharmacy
            ? $pharmacy->commandes()
                ->with('user') // Eager load user relationship
                ->when($request->order_search, function($q, $search) {
                    $q->where(function($query) use ($search) {
                        $query->where('uuid', 'like', "%{$search}%")
                              ->orWhereHas('user', function($userQuery) use ($search) {
                                  $userQuery->where('name', 'like', "%{$search}%");
                              });
                    });
                })
                ->when($request->order_status, fn($q, $status) => $q->where('status', $status))
                ->when($request->order_date, fn($q, $date) => $q->whereDate('date', $date))
                ->when($request->order_sort, function($q, $sort) use ($request) {
                    $direction = $request->order_direction ?? 'desc';
                    $q->orderBy($sort, $direction);
                }, fn($q) => $q->latest())
                ->paginate(5)
                ->withQueryString()
            : collect();

        // Get medications if pharmacy exists with enhanced filtering
        $medications = $pharmacy 
            ? $pharmacy->medications()
                ->withPivot('stock', 'price')
                ->when($request->search, function($q, $search) {
                    $q->where(function($query) use ($search) {
                        $query->where('name', 'like', "%{$search}%")
                              ->orWhere('generic_name', 'like', "%{$search}%");
                    });
                })
                ->when($request->category, fn($q, $cat) => $q->where('category', $cat))
                ->when($request->stock_status, function($q, $status) {
                    if ($status === 'low') {
                        $q->whereBetween('medication_pharmacy.stock', [1, 9]);
                    } elseif ($status === 'out') {
                        $q->where('medication_pharmacy.stock', 0);
                    } elseif ($status === 'normal') {
                        $q->where('medication_pharmacy.stock', '>=', 10);
                    }
                })
                ->when($request->sort, function($q, $sort) use ($request) {
                    $direction = $request->direction ?? 'asc';
                    if ($sort === 'stock' || $sort === 'price') {
                        $q->orderBy("medication_pharmacy.{$sort}", $direction);
                    } else {
                        $q->orderBy($sort, $direction);
                    }
                }, fn($q) => $q->orderBy('name'))
                ->paginate(15)
                ->withQueryString()
            : collect();
    
        return view('dashboard', [
            'pharmacy' => $pharmacy,
            'medications' => $medications,
            'allMedications' => $allMedications,
            'commandes' => $commandes,
            'categories' => Medication::distinct()->pluck('category'),
            'sortDirection' => $request->direction === 'desc' ? 'desc' : 'asc',
            'currentSort' => $request->sort,
            'orderSortDirection' => $request->order_direction === 'asc' ? 'asc' : 'desc',
            'currentOrderSort' => $request->order_sort
        ]);
    }
}