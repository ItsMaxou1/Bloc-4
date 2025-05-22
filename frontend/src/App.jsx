// src/App.jsx
import React from "react";
import { Routes, Route } from "react-router-dom";

import HomePage      from "./pages/home";
import ShopPage      from "./pages/shop";
import ProductDetail from "./components/Shop/ProductDetail/ProductDetail.jsx";
import Cart          from "./components/Cart/Cart";
import RegisterForm  from "./components/Auth/RegisterForm";
import LoginForm     from "./components/Auth/LoginForm";

export default function App() {
  return (
    <Routes>
      {/* Accueil */}
      <Route path="/" element={<HomePage />} />

      {/* Boutique */}
      <Route path="/shop" element={<ShopPage />} />
      {/* Détail produit : c’est ici que useParams().id sera défini */}
      <Route path="/shop/product/:id" element={<ProductDetail />} />

      {/* Panier */}
      <Route path="/cart" element={<Cart />} />

      {/* Authentification */}
      <Route path="/register" element={<RegisterForm />} />
      <Route path="/login" element={<LoginForm />} />

      {/* 404 si aucune route ne matche */}
      <Route path="*" element={<div>Page non trouvée</div>} />
    </Routes>
  );
}
