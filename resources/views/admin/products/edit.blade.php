@extends('layouts.admin')

@section('content')
    <h1>Modifier le produit</h1>

    @if ($errors->any())
        <div>
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

        <!-- Champ Titre du produit -->
        <div>
            <label for="title">Nom du produit</label>
            <input type="text" id="title" name="title" value="{{ old('title', $product->title) }}" required>
        </div>

        <!-- Champ Description -->
        <div>
            <label for="description">Description</label>
            <textarea id="description" name="description"
                required>{{ old('description', $product->description) }}</textarea>
        </div>

        <!-- Champ Prix -->
        <div>
            <label for="price">Prix</label>
            <input type="number" id="price" name="price" value="{{ old('price', $product->price) }}" required>
        </div>

        <!-- Champ Catégorie -->
        <div>
            <label for="category_id">Catégorie</label>
            <select id="category_id" name="category_id" required>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" {{ $category->id == old('category_id', $product->category_id) ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Champ Marque -->
        <div>
            <label for="brand_id">Marque</label>
            <select id="brand_id" name="brand_id">
                @foreach ($brands as $brand)
                    <option value="{{ $brand->id }}" {{ $brand->id == old('brand_id', $product->brand_id) ? 'selected' : '' }}>
                        {{ $brand->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Champ Image du produit -->
        <div>
            <label for="cover">Image du produit</label>
            <input type="file" id="cover" name="cover">
            <p>Image actuelle :</p>
            <img src="{{ $product->cover }}" alt="Cover image" width="200">
        </div>

        <!-- Variants simplifiés -->
        <h3>Variant du produit</h3>
        <div id="variants">
            @foreach ($product->productVariants as $variant)
                <div class="variant">
                    <label for="format">Format</label>
                    <input type="text" id="format" name="variants[{{ $loop->index }}][format]"
                        value="{{ old('variants.' . $loop->index . '.format', $variant->format) }}" required>

                    <label for="price_variant">Prix</label>
                    <input type="number" id="price_variant" name="variants[{{ $loop->index }}][price]"
                        value="{{ old('variants.' . $loop->index . '.price', $variant->price) }}" required>

                    <label for="stock">Stock</label>
                    <input type="number" id="stock" name="variants[{{ $loop->index }}][stock]"
                        value="{{ old('variants.' . $loop->index . '.stock', $variant->stock) }}" required>
                </div>
            @endforeach
        </div>

        <div>
            <button type="submit">Mettre à jour le produit</button>
        </div>
    </form>

@endsection