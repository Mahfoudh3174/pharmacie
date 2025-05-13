@extends('layouts.template')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-2xl font-semibold text-gray-800">Liste des Médicaments</h2>
                    <div class="flex space-x-4">
                        <!-- Search Bar -->
                        <div class="flex items-center">
                            <form method="GET" action="{{ route('medicament.index') }}" class="flex">
                                <input type="text" name="search" 
                                    class="rounded-l-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" 
                                    placeholder="Rechercher un médicament..."
                                    value="{{ request('search') }}">
                                <button type="submit" class="px-4 py-2 bg-gray-100 border border-l-0 border-gray-300 rounded-r-md hover:bg-gray-200">
                                    <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                                    </svg>
                                </button>
                            </form>
                        </div>
                        <!-- Add Medicament Button -->
                        <a href="{{ route('medicament.create') }}" 
                           class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:border-indigo-900 focus:ring ring-indigo-300 disabled:opacity-25 transition ease-in-out duration-150">
                            Ajouter un Médicament
                        </a>
                    </div>
                </div>

                <!-- Messages de succès/erreur -->
                @if (session('success'))
                    <div class="mb-4 px-4 py-2 bg-green-100 border border-green-400 text-green-700 rounded">
                        {{ session('success') }}
                    </div>
                @endif

                <!-- Table des médicaments -->
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nom</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Description</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Prix</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Quantité</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Catégorie</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse ($medicaments as $medicament)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $medicament->nom }}</td>
                                    <td class="px-6 py-4">{{ Str::limit($medicament->description, 50) }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ number_format($medicament->prix, 2) }} DH</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $medicament->quantite }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $medicament->category->nom ?? 'N/A' }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <div class="flex space-x-2">
                                            <a href="{{ route('medicament.show', $medicament) }}" 
                                               class="text-indigo-600 hover:text-indigo-900">Voir</a>
                                            <a href="{{ route('medicament.edit', $medicament) }}" 
                                               class="text-yellow-600 hover:text-yellow-900">Modifier</a>
                                            <form action="{{ route('medicament.destroy', $medicament) }}" method="POST" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600 hover:text-red-900"
                                                        onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce médicament ?')">
                                                    Supprimer
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="px-6 py-4 text-center text-gray-500">
                                        Aucun médicament trouvé
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="mt-4">
                    {{ $medicaments->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection