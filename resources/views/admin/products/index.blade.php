@extends('layouts.admin')

{{-- Titre de la page dans l’onglet --}}
@section('title', 'Gestion des Produits')

@section('content')

    {{-- En-tête avec le titre de la page et un bouton pour ajouter un produit --}}
    <section class="mb-4 d-flex justify-content-between align-items-center">
        <a href="{{ route('admin.products.create') }}" class="btn btn-success">+ Ajouter un produit</a>
    </section>

    {{-- Filtres par catégorie (petits boutons pour trier) --}}
    <section class="mb-4">
        <h4>Filtrer par catégorie</h4>

        <div class="categorie-buttons mb-3">
            {{-- Bouton pour afficher tous les produits (sans filtre) --}}
            <a href="{{ route('admin.products.index') }}"
                class="btn btn-outline-secondary {{ request('category_id') == '' ? 'active' : '' }}">
                Toutes les catégories
            </a>

            {{-- Boucle sur chaque catégorie pour afficher un bouton --}}
            @foreach ($categories as $category)
                <a href="{{ route('admin.products.index', ['category_id' => $category->id]) }}"
                    class="btn btn-outline-secondary {{ request('category_id') == $category->id ? 'active' : '' }}">
                    {{ $category->name }}
                </a>
            @endforeach
        </div>
    </section>

    {{-- Liste des produits --}}
    <section>
        <h4>Liste des produits</h4>

        {{-- Affichage du message de succès après une suppression ou modification --}}
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="row">
            {{-- Boucle sur les produits --}}
            @forelse ($products as $product)
                <div class="col-md-4 mb-4">
                    <div class="card h-100">
                        {{-- Image du produit --}}
                        <img src="{{ $product->image_url ?? 'https://via.placeholder.com/400x300' }}" class="card-img-top"
                            alt="{{ $product->name }}">

                        <div class="card-body d-flex flex-column">
                            {{-- Nom du produit --}}
                            <h5 class="card-title">{{ $product->name }}</h5>

                            {{-- Description --}}
                            <p class="card-text">{{ Str::limit($product->short_description, 100) }}</p>

                            {{-- Prix du produit --}}
                            <p class="card-text"><strong>{{ $product->price ?? 'N/A' }} €</strong></p>

                            {{-- Boutons d'action : Voir, Modifier, Supprimer --}}
                            <div class="mt-auto d-grid gap-2">

                                {{-- Bouton pour voir le détail du produit --}}
                                <a href="{{ route('admin.products.show', $product) }}" class="btn btn-primary">
                                    Voir
                                </a>

                                {{-- Bouton pour modifier le produit --}}
                                <a href="{{ route('admin.products.edit', $product) }}" class="btn btn-warning">
                                    Modifier
                                </a>

                                {{-- Formulaire pour supprimer le produit --}}
                                <form action="{{ route('admin.products.destroy', $product) }}" method="POST"
                                    style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger"
                                        onclick="return confirm('Es-tu sûr de vouloir supprimer ce produit ?')">
                                        Supprimer
                                    </button>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            @empty
                {{-- S’il n’y a aucun produit --}}
                <p class="text-muted">Aucun produit trouvé.</p>
            @endforelse
        </div>

        {{-- Pagination (si beaucoup de produits) --}}
        <div class="d-flex justify-content-center mt-4">
            {{ $products->links() }}
        </div>
    </section>
@endsection