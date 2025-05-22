import React, { useState } from "react";
import axios from "axios";
import { useNavigate, Link } from "react-router-dom";
import "./Auth.css";

const LoginForm = () => {
    const [formData, setFormData] = useState({
        email: "",
        password: "",
    });

    const [message, setMessage] = useState("");
    const navigate = useNavigate();

    const handleChange = (e) => {
        setFormData({ ...formData, [e.target.name]: e.target.value });
    };

    const handleSubmit = async (e) => {
        e.preventDefault();

        try {
            const response = await axios.post(
                "http://localhost:8000/api/login",
                formData
            );

            setMessage(response.data.message);

            // Redirection après 1 seconde
            setTimeout(() => {
                navigate("/");
            }, 1000);
        } catch (error) {
            if (error.response?.status === 401) {
                setMessage("Email ou mot de passe invalide.");
            } else {
                setMessage("Erreur lors de la connexion.");
            }
        }
    };

    return (
        <form onSubmit={handleSubmit} className="register-form">
            <h2>Connexion</h2>

            <input
                type="email"
                name="email"
                placeholder="Email"
                onChange={handleChange}
                required
            />

            <input
                type="password"
                name="password"
                placeholder="Mot de passe"
                onChange={handleChange}
                required
            />

            <button type="submit">Se connecter</button>

            {message && <p>{message}</p>}

            <p style={{ textAlign: "center", marginTop: "1em", color: "#000" }}>
                Pas de compte ?{" "}
                <Link
                    to="/register"
                    style={{ color: "#FFD700", textDecoration: "none" }}
                >
                    S'inscrire
                </Link>
            </p>
        </form>
    );
};

export default LoginForm;
