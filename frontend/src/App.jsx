import React from "react";
import HomePage from "./pages/home";
import ShopPage from "./pages/shop";
import ProductDetail from "./components/Shop/ProductDetail/ProductDetail.jsx";
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

<<<<<<< HEAD
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
=======
            <Route path="/register" element={<RegisterForm />} />
            <Route path="/login" element={<LoginForm />} />
        </Routes>
>>>>>>> parent of 9e4f7e6 (commit hugo Login/Login admin)
    );
};

export default App;
