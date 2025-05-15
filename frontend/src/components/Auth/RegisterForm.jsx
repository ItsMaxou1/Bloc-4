import React, { useState } from "react";
import axios from "axios";
import { Link } from "react-router-dom";
import "./Auth.css";

const RegisterForm = () => {
    const [formData, setFormData] = useState({
        name: "",
        email: "",
        password: "",
    });

    const [message, setMessage] = useState("");

    const handleChange = (e) => {
        setFormData({ ...formData, [e.target.name]: e.target.value });
    };

    const handleSubmit = async (e) => {
        e.preventDefault();

        try {
            const response = await axios.post(
                "http://localhost:8000/api/register",
                formData
            );
            setMessage(response.data.message);
        } catch (error) {
            if (error.response && error.response.data.errors) {
                setMessage(
                    Object.values(error.response.data.errors).join("\n")
                );
            } else {
                setMessage("Erreur lors de la création du compte.");
            }
        }
    };

    return (
        <form onSubmit={handleSubmit} className="register-form">
            <h2>Inscription</h2>

            <input
                type="text"
                name="name"
                placeholder="Nom"
                onChange={handleChange}
                required
            />

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

            <button type="submit">S'inscrire</button>

            {message && <p>{message}</p>}

            <p style={{ textAlign: "center", marginTop: "1em", color: "#000" }}>
                Déjà un compte ?{" "}
                <Link
                    to="/login"
                    style={{ color: "#FFD700", textDecoration: "none" }}
                >
                    Se connecter
                </Link>
            </p>
        </form>
    );
};

export default RegisterForm;
