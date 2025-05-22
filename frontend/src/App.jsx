import React from "react";
import HomePage from "./pages/home";
import ShopPage from "./pages/shop";
import ProductDetail from "./components/Shop/ProductDetail/ProductDetail.jsx";
import { Routes, Route } from "react-router-dom";
import RegisterForm from "./components/Auth/RegisterForm";
import LoginForm from "./components/Auth/LoginForm";
import Cart from "./components/Cart/Cart";
import Navbar from "./components/Navbar/Navbar";
import Footer from "./components/Footer/Footer";
import Profile from "./pages/profile";

const App = () => {
    return (
        <div className="page-container">
            <Navbar />
            <main className="content-wrap">
                <Routes>
                    <Route path="/" element={<HomePage />} />
                    <Route path="/shop" element={<ShopPage />} />

                    <Route path="/cart" element={<Cart />} />
                    <Route
                        path="/shop/product/:id"
                        element={<ProductDetail />}
                    />
                    <Route path="/profile" element={<Profile />} />

                    <Route path="/register" element={<RegisterForm />} />
                    <Route path="/login" element={<LoginForm />} />
                </Routes>
            </main>
            <Footer />
        </div>
    );
};

export default App;
