import React from "react";
import HomePage from "./pages/home";
import ShopPage from "./pages/shop";
import { Routes, Route } from "react-router-dom";
import RegisterForm from "./components/Auth/RegisterForm";
import LoginForm from "./components/Auth/LoginForm";
import Cart from "./components/Cart/Cart";

const App = () => {
    return (
        <Routes>
            <Route path="/" element={<HomePage />} />
            <Route path="/shop" element={<ShopPage />} />

            <Route path="/cart" element={<Cart />} />

            <Route path="/register" element={<RegisterForm />} />
            <Route path="/login" element={<LoginForm />} />
        </Routes>
    );
};

export default App;
