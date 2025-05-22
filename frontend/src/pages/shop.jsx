import React, { useState } from 'react';
import Navbar from "../components/Home/Navbar/Navbar";
import Brands from "../components/Shop/Brands/Brands";
import CategoriesFilter from "../components/Shop/CategoriesFilter/CategoriesFilter";
import Products from "../components/Shop/Products/Products";
import Footer from "../components/Home/Footer/Footer";

export default function ShopPage() {
  const [selectedCategory, setSelectedCategory] = useState(null);

  return (
    <div>
      <Navbar />

      {/* Section marques */}
      <Brands />

      {/* Filtre catégories */}
      <CategoriesFilter onCategorySelect={setSelectedCategory} />

      {/* Liste des produits */}
      <Products categoryId={selectedCategory} />

      <Footer />
    </div>
  );
}
