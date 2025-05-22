import React, { useState } from "react";
import Brands from "../components/Shop/Brands/Brands";
import CategoriesFilter from "../components/Shop/CategoriesFilter/CategoriesFilter";
import Products from "../components/Shop/Products/Products";

export default function ShopPage() {
    const [selectedCategory, setSelectedCategory] = useState(null);

    return (
        <div>
            {/* Section marques */}
            <Brands />

            {/* Filtre catégories */}
            <CategoriesFilter onCategorySelect={setSelectedCategory} />

            {/* Liste des produits */}
            <Products categoryId={selectedCategory} />
        </div>
    );
}
