@extends('layouts.admin')

@section('title', 'Gestion des Produits')

@section('content')
    <section class="mb-4">
        <h2>Filtrer par catégorie</h2>
        <div class="categorie-buttons">
            <a href="{{ route('admin.products.index') }}"
                class="btn btn-outline-secondary {{ request('category_id') == '' ? 'active' : '' }}">
                Toutes les catégories
            </a>
            @foreach ($categories as $category)
                <a href="{{ route('admin.products.index', ['category_id' => $category->id]) }}"
                    class="btn btn-outline-secondary {{ request('category_id') == $category->id ? 'active' : '' }}">
                    {{ $category->name }}
                </a>
            @endforeach
        </div>
    </section>

    <section>
        <h2>Liste des produits</h2>
        <div class="row">
            @foreach ($products as $product)
                <div class="col-md-4 mb-4">
                    <div class="card h-100">
                        <img src="{{ asset('storage/images/' . $product->image) }}" class="card-img-top"
                            alt="{{ $product->name }}">
                        <div class="card-body">
                            <h5 class="card-title">{{ $product->name }}</h5>
                            <p class="card-text">{{ $product->description }}</p>
                            <p class="card-text"><strong>{{ $product->price }} €</strong></p>
                            <a href="#" class="btn btn-primary">Voir</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="d-flex justify-content-center mt-4">
            {{ $products->links() }}
        </div>
    </section>
@endsection