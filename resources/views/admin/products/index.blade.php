<!-- 🔥 Produits dynamiques depuis la BDD par catégorie -->
<section class="products">
    <h2>Nos produits par catégorie</h2>

    <!-- Formulaire de filtrage -->
    <div class="categorie-buttons">
        <a href="{{ route('admin.products.index') }}"
            class="btn btn-link {{ request('category_id') == '' ? 'active' : '' }}">
            Toutes les catégories
        </a>
        @foreach ($categories as $category)
            <a href="{{ route('admin.products.index', ['category_id' => $category->id]) }}"
                class="btn btn-link {{ request('category_id') == $category->id ? 'active' : '' }}">
                {{ $category->name }}
            </a>
        @endforeach
    </div>
</section>

<!-- 🔥 Produits paginés dynamiques -->
<section class="products">
    <h2>Nos produits</h2>
    <div class="row">
        @foreach ($products as $product)
            <div class="col-md-4 mb-4">
                <div class="card">
                    <img src="{{ asset('storage/images/' . $product->image) }}" class="card-img-top"
                        alt="{{ $product->name }}">
                    <div class="card-body">
                        <h5 class="card-title">{{ $product->name }}</h5>
                        <p class="card-text">{{ $product->description }}</p>
                        <p class="card-text"><strong>{{ $product->price }} €</strong></p>
                        <a href="#" class="btn btn-primary">Voir le produit</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <!-- Pagination -->
    <div class="d-flex justify-content-center mt-4">
        {{ $products->links() }}
    </div>
</section>