<x-app-layout title="Ajouter un Médicament">
    <!-- Conteneur du formulaire -->
    <div class="max-w-2xl mx-auto p-6 bg-white rounded-lg shadow-lg -mt-6 relative z-20">
        <form action="{{ route('medications.store') }}" method="POST" class="space-y-4" enctype="multipart/form-data">
            @csrf

            <!-- Section de téléchargement de l'image -->
            <div class="space-y-4">
                <label class="block text-sm font-medium text-gray-700">Image du Médicament</label>
                <div class="mt-1 flex flex-col items-center">
                    <div class="mb-3 w-48 h-48 border-2 border-dashed border-gray-300 rounded-lg flex items-center justify-center bg-gray-50 overflow-hidden">
                        <div id="imagePreview" class="w-full h-full flex items-center justify-center">
                            <svg class="h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                        </div>
                    </div>

                    <div class="flex items-center gap-3">
                        <label class="cursor-pointer bg-white py-2 px-3 border border-gray-300 rounded-lg shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50">
                            <span>Sélectionner une image</span>
                            <input id="image" name="image" type="file" class="sr-only" accept="image/*">
                        </label>
                        <button type="button" id="removeImage" class="text-sm text-red-600 hover:text-red-800 hidden">Supprimer</button>
                    </div>
                </div>
                @error('image')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
                <p class="text-xs text-gray-500">Taille recommandée : 500×500px (Max 2 Mo)</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Colonne de gauche -->
                <div class="space-y-4">
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Nom du Médicament *</label>
                        <input type="text" id="name" name="name" value="{{ old('name') }}" required 
                               class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-green-500 @error('name') border-red-500 @enderror">
                        @error('name')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="generic_name" class="block text-sm font-medium text-gray-700 mb-1">Nom Générique</label>
                        <input type="text" id="generic_name" name="generic_name" value="{{ old('generic_name') }}"
                               class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-green-500 @error('generic_name') border-red-500 @enderror">
                        @error('generic_name')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="category" class="block text-sm font-medium text-gray-700 mb-1">Catégorie *</label>
                        <select id="category" name="category" required
                                class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-green-500 @error('category') border-red-500 @enderror">
                            <option value="">Choisir une catégorie</option>
                            <option value="Antibiotics" {{ old('category') == 'Antibiotics' ? 'selected' : '' }}>Antibiotiques</option>
                            <option value="Analgesics" {{ old('category') == 'Analgesics' ? 'selected' : '' }}>Analgésiques</option>
                            <option value="Antidepressants" {{ old('category') == 'Antidepressants' ? 'selected' : '' }}>Antidépresseurs</option>
                            <option value="Antihistamines" {{ old('category') == 'Antihistamines' ? 'selected' : '' }}>Antihistaminiques</option>
                            <option value="Antacids" {{ old('category') == 'Antacids' ? 'selected' : '' }}>Antiacides</option>
                            <option value="Other" {{ old('category') == 'Other' ? 'selected' : '' }}>Autre</option>
                        </select>
                        @error('category')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Colonne de droite -->
                <div class="space-y-4">
                    <div>
                        <label for="dosage_form" class="block text-sm font-medium text-gray-700 mb-1">Forme *</label>
                        <select id="dosage_form" name="dosage_form" required
                                class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-green-500 @error('dosage_form') border-red-500 @enderror">
                            <option value="">Choisir une forme</option>
                            <option value="Tablet" {{ old('dosage_form') == 'Tablet' ? 'selected' : '' }}>Comprimé</option>
                            <option value="Capsule" {{ old('dosage_form') == 'Capsule' ? 'selected' : '' }}>Capsule</option>
                            <option value="Liquid" {{ old('dosage_form') == 'Liquid' ? 'selected' : '' }}>Liquide</option>
                            <option value="Injection" {{ old('dosage_form') == 'Injection' ? 'selected' : '' }}>Injection</option>
                            <option value="Cream" {{ old('dosage_form') == 'Cream' ? 'selected' : '' }}>Crème</option>
                            <option value="Other" {{ old('dosage_form') == 'Other' ? 'selected' : '' }}>Autre</option>
                        </select>
                        @error('dosage_form')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="strength" class="block text-sm font-medium text-gray-700 mb-1">Dosage *</label>
                        <input type="text" id="strength" name="strength" value="{{ old('strength') }}" required placeholder="ex : 500mg"
                               class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-green-500 @error('strength') border-red-500 @enderror">
                        @error('strength')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="barcode" class="block text-sm font-medium text-gray-700 mb-1">Code-barres</label>
                        <input type="text" id="barcode" name="barcode" value="{{ old('barcode') }}"
                               class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-green-500 @error('barcode') border-red-500 @enderror">
                        @error('barcode')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Stock en pharmacie -->
            <div class="border-t border-gray-200 pt-4">
                <h3 class="text-lg font-medium text-gray-900 mb-3">Ajouter au Stock de la Pharmacie</h3>

                <div class="space-y-4">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label for="stock" class="block text-sm font-medium text-gray-700 mb-1">Stock Initial *</label>
                            <input type="number" id="stock" name="stock" value="{{ old('stock', 0) }}" min="0" required
                                   class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-green-500 @error('stock') border-red-500 @enderror">
                            @error('stock')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="price" class="block text-sm font-medium text-gray-700 mb-1">Prix (UM) *</label>
                            <input type="number" step="0.01" id="price" name="price" value="{{ old('price') }}" min="0" required
                                   class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-green-500 @error('price') border-red-500 @enderror">
                            @error('price')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            <!-- Actions -->
            <div class="flex justify-end gap-3 pt-6 border-t border-gray-200">
                <a href="{{ route('dashboard') }}" 
                   class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition-colors">
                    Annuler
                </a>
                <button type="submit" 
                        class="px-4 py-2 bg-green-600 hover:bg-green-700 text-white rounded-lg transition-colors flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                    </svg>
                    Enregistrer
                </button>
            </div>
        </form>
    </div>

    <!-- JavaScript de prévisualisation -->
    <script>
        const imageInput = document.getElementById('image');
        const imagePreview = document.getElementById('imagePreview');
        const removeButton = document.getElementById('removeImage');

        imageInput.addEventListener('change', function(e) {
            const [file] = e.target.files;
            if (file) {
                imagePreview.innerHTML = '';
                const img = document.createElement('img');
                img.src = URL.createObjectURL(file);
                img.className = 'w-full h-full object-contain';
                imagePreview.appendChild(img);
                removeButton.classList.remove('hidden');
            }
        });

        removeButton.addEventListener('click', function() {
            imageInput.value = '';
            imagePreview.innerHTML = `
                <svg class="h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                </svg>`;
            removeButton.classList.add('hidden');
        });
    </script>
</x-app-layout>
