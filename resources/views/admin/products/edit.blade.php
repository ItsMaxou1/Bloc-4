@extends('layouts.admin')

@section('content')
    <h1>Modifier le produit</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <!-- Nom du produit -->
        <div>
            <label for="name">Nom du produit</label>
            <input type="text" id="name" name="name" value="{{ old('name', $product->name) }}" required>
        </div>

        <!-- Courte description -->
        <div>
            <label for="short_description">Courte description</label>
            <textarea id="short_description" name="short_description"
                required>{{ old('short_description', $product->short_description) }}</textarea>
        </div>

        <!-- Description complète -->
        <div>
            <label for="description">Description</label>
            <textarea id="description" name="description"
                required>{{ old('description', $product->description) }}</textarea>
        </div>

        <!-- Catégorie -->
        <div>
            <label for="category_id">Catégorie</label>
            <select id="category_id" name="category_id" required>
                @foreach($categories as $cat)
                    <option value="{{ $cat->id }}" {{ $cat->id == old('category_id', $product->category_id) ? 'selected' : '' }}>
                        {{ $cat->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Marque -->
        <div>
            <label for="brand_id">Marque</label>
            <select id="brand_id" name="brand_id">
                @foreach($brands as $brand)
                    <option value="{{ $brand->id }}" {{ $brand->id == old('brand_id', $product->brand_id) ? 'selected' : '' }}>
                        {{ $brand->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Variantes -->
        <h3>Variantes du produit</h3>
        <div id="variants">
            @foreach($product->variants as $index => $variant)
                <div class="variant">
                    <!-- On passe l’ID pour distinguer update / create -->
                    <input type="hidden" name="variants[{{ $index }}][id]" value="{{ $variant->id }}">

                    <label for="format-{{ $index }}">Format</label>
                    <input type="text" id="format-{{ $index }}" name="variants[{{ $index }}][format]"
                        value="{{ old("variants.$index.format", $variant->format) }}" required>

                    <label for="price-{{ $index }}">Prix</label>
                    <input type="number" id="price-{{ $index }}" name="variants[{{ $index }}][price]" step="0.01"
                        value="{{ old("variants.$index.price", $variant->price) }}" required>

                    <label for="stock-{{ $index }}">Stock</label>
                    <input type="number" id="stock-{{ $index }}" name="variants[{{ $index }}][stock]"
                        value="{{ old("variants.$index.stock", $variant->stock) }}" required>
                </div>
            @endforeach
        </div>

        <div>
            <button type="submit">Mettre à jour le produit</button>
        </div>
    </form>
@endsection