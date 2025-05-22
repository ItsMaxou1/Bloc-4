@extends('layouts.admin')

@section('title', 'Détail du produit')

@section('content')

    <section class="container py-4">
        <h2 class="mb-4">Produit : {{ $product->name }}</h2>

        <div class="mb-4">
            <img src="{{ $product->image_url ?? 'https://via.placeholder.com/600x400' }}"
                alt="Image de {{ $product->name }}" class="img-fluid rounded shadow" style="max-width: 600px;">
        </div>

        <div class="mb-3">
            <p><strong>Description :</strong></p>
            <p>{{ $product->short_description ?? 'Non renseignée' }}</p>
        </div>

        <div class="d-flex gap-2">
            <!-- <a href="{{ route('admin.products.edit', $product) }}" class="btn btn-warning">Modifier</a> -->
            <a href="{{ route('admin.products.index') }}" class="btn btn-secondary">Retour</a>
        </div>
    </section>

    <!-- Bouton supprimer -->
    <form action="{{ route('admin.products.destroy', $product) }}" method="POST" class="d-inline">
        @csrf
        @method('DELETE')

        <button type="submit" class="btn btn-danger">Supprimer</button>
    </form>

@endsection