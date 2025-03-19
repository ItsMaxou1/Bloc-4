@extends('layouts.admin')

@section('content')
    <h1>Liste des Produits</h1>
    <a href="{{ route('admin.products.create') }}">Ajouter un produit</a>
    <ul>
        @foreach ($products as $product)
            <li>{{ $product->name }} - €{{ $product->prix }}
                (Catégorie : {{ $product->category->nom ?? 'Aucune' }}, Marque : {{ $product->brand->nom ?? 'Aucune' }})
                <a href="{{ route('admin.products.edit', $product) }}">Modifier</a>
                <form action="{{ route('admin.products.destroy', $product) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit">Supprimer</button>
                </form>
            </li>
        @endforeach
    </ul>
@endsection