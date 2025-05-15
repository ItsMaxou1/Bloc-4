import React from "react";
import HomePage from "./pages/home";
import { Routes, Route } from "react-router-dom";
import RegisterForm from "./components/Auth/RegisterForm";
import LoginForm from "./components/Auth/LoginForm";

const App = () => {
    return (
        <Routes>
            <Route path="/" element={<HomePage />} />

            <Route path="/register" element={<RegisterForm />} />
            <Route path="/login" element={<LoginForm />} />
        </Routes>
    );
};

export default App;
