@extends('layouts.admin') {{-- ou ce que tu utilises --}}

@section('content')
    <div class="container">
        <h1>Créer un produit</h1>

        <form action="{{ route('admin.products.store') }}" method="POST">
            @csrf

            <!-- Nom -->
            <div>
                <label>Nom</label>
                <input type="text" name="name" required>
            </div>

            <!-- Description -->
            <div>
                <label>Description</label>
                <textarea name="description" required></textarea>
            </div>

            <!-- Prix de base -->
            <div>
                <label>Prix (€)</label>
                <input type="number" name="price" step="0.01" required>
            </div>

            <!-- Alcool Volume -->
            <div>
                <label>Taux d'alcool (%)</label>
                <input type="number" name="alcohol_volume" step="0.1">
            </div>

            <!-- Image -->
            <div>
                <label>URL de l'image</label>
                <input type="text" name="cover" required>
            </div>

            <!-- Catégorie -->
            <div>
                <label>Catégorie</label>
                <select name="category_id" required>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Marque -->
            <div>
                <label>Marque</label>
                <select name="brand_id" required>
                    @foreach($brands as $brand)
                        <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                    @endforeach
                </select>
            </div>


            <!-- Variants -->
            <hr>
            <h2>Variants</h2>
            <div id="variants-container">
                <!-- zone dynamique des variants -->
            </div>
            <button type="button" onclick="addVariant()">+ Ajouter un variant</button>

            <br><br>
            <button type="submit">Créer le produit</button>
        </form>
    </div>

    <script>
        function addVariant() {
            const container = document.getElementById('variants-container');
            const index = container.children.length;

            const variantHTML = `
                <div style="margin-top: 10px; padding: 10px; border: 1px solid #ccc;">
                    <label>Format</label>
                    <input type="text" name="variants[${index}][format]" required>

                    <label>Prix (€)</label>
                    <input type="number" name="variants[${index}][price]" step="0.01" required>

                    <label>Stock</label>
                    <input type="number" name="variants[${index}][stock]" required>
                </div>
            `;

            container.insertAdjacentHTML('beforeend', variantHTML);
        }
    </script>
@endsection