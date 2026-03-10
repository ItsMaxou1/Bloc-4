// src/App.jsx
import React from "react";
import { Routes, Route } from "react-router-dom";

import HomePage      from "./pages/home";
import ShopPage      from "./pages/shop";
import ProductDetail from "./components/Shop/ProductDetail/ProductDetail.jsx";
import Cart          from "./components/Cart/Cart";
import RegisterForm  from "./components/Auth/RegisterForm";
import LoginForm     from "./components/Auth/LoginForm";
import Profile from "./pages/profil";
import CheckoutPage  from "./pages/checkout";
import Confirmation  from "./pages/Confirmation";

export default function App() {
  return (
    <Routes>
      {/* Accueil */}
      <Route path="/" element={<HomePage />} />

      {/* Boutique */}
      <Route path="/shop" element={<ShopPage />} />
      {/* Détail produit : c’est ici que useParams().id sera défini */}
      <Route path="/shop/product/:id" element={<ProductDetail />} />

      <Route path="/checkout" element={<CheckoutPage />} />

      <Route path="/confirmation" element={<Confirmation />} />

      {/* Panier */}
      <Route path="/cart" element={<Cart />} />

      <Route path="/profile" element={<Profile />} />

      {/* Authentification */}
      <Route path="/register" element={<RegisterForm />} />
      <Route path="/login" element={<LoginForm />} />

      {/* 404 si aucune route ne matche */}
      <Route path="*" element={<div>Page non trouvée</div>} />
    </Routes>
  );
}
