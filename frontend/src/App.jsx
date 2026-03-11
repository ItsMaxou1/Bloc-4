// src/App.jsx
import React from "react";
import { Routes, Route, Navigate } from "react-router-dom";
import HomePage      from "./pages/home";
import ShopPage      from "./pages/shop";
import ProductDetail from "./components/Shop/ProductDetail/ProductDetail.jsx";
import Cart          from "./components/Cart/Cart";
import RegisterForm  from "./components/Auth/RegisterForm";
import LoginForm     from "./components/Auth/LoginForm";
import Profile       from "./pages/profil";
import CheckoutPage  from "./pages/checkout";
import Confirmation  from "./pages/Confirmation";
import AboutPage     from "./pages/about";
import ContactPage   from "./pages/contact";

export default function App() {
  return (
    <Routes>
      {/* Accueil */}
      <Route path="/" element={<HomePage />} />

      {/* Boutique */}
      <Route path="/shop" element={<ShopPage />} />

      {/* Catégories → redirige vers /shop avec filtre */}
      <Route path="/blonde"      element={<Navigate to="/shop?category=blonde" replace />} />
      <Route path="/brune"       element={<Navigate to="/shop?category=brune" replace />} />
      <Route path="/rousse"      element={<Navigate to="/shop?category=rousse" replace />} />
      <Route path="/ipa"         element={<Navigate to="/shop?category=ipa" replace />} />
      <Route path="/accords"     element={<Navigate to="/shop?category=accords" replace />} />
      <Route path="/artisanales" element={<Navigate to="/shop?category=artisanales" replace />} />
      <Route path="/types"       element={<Navigate to="/shop" replace />} />

      {/* Détail produit */}
      <Route path="/shop/product/:id" element={<ProductDetail />} />

      {/* Commande */}
      <Route path="/checkout"    element={<CheckoutPage />} />
      <Route path="/confirmation" element={<Confirmation />} />

      {/* Panier */}
      <Route path="/cart"        element={<Cart />} />

      {/* Profil */}
      <Route path="/profile"     element={<Profile />} />

      {/* Authentification */}
      <Route path="/register"    element={<RegisterForm />} />
      <Route path="/login"       element={<LoginForm />} />

      {/* Pages infos */}
      <Route path="/about"       element={<AboutPage />} />
      <Route path="/contact"     element={<ContactPage />} />

      {/* 404 */}
      <Route path="*" element={<div>Page non trouvée</div>} />
    </Routes>
  );
}
