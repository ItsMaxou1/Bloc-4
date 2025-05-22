import React, { useState, useContext, useEffect } from "react";
import { useNavigate, Link } from "react-router-dom";
import { CartContext } from "../../context/CartContext";
import { AuthContext } from "../../context/AuthContext"; // ← context d'auth

import "./Navbar.css";
import Search from "../../assets/images/Navbar/chercher.png";
import Panier from "../../assets/images/Navbar/paniers.png";
import User from "../../assets/images/Navbar/utilisateur.png";
import Logo from "../../assets/images/Navbar/Logo.png";
import PanierHover from "../../assets/images/Navbar/paniers-hover.svg";
import UserHover from "../../assets/images/Navbar/utilisateur-hover.svg";

const Navbar = () => {
    const [panierIcon, setPanierIcon] = useState(Panier);
    const [userIcon, setUserIcon] = useState(User);
    const [searchTerm, setSearchTerm] = useState("");
    const [results, setResults] = useState([]);
    const navigate = useNavigate();

    const { cart } = useContext(CartContext);
    const { user } = useContext(AuthContext); // ← récupère l'utilisateur connecté
    const totalItems = cart.reduce((sum, item) => sum + item.quantity, 0);

    // Requête de recherche
    useEffect(() => {
        const fetchResults = async () => {
            if (searchTerm.trim() === "") {
                setResults([]);
                return;
            }

            try {
                const response = await fetch(
                    `http://localhost:8000/api/products?search=${encodeURIComponent(
                        searchTerm
                    )}`
                );
                const data = await response.json();
                setResults(data);
            } catch (error) {
                console.error("Erreur lors de la recherche :", error);
            }
        };

        const timeout = setTimeout(fetchResults, 300);
        return () => clearTimeout(timeout);
    }, [searchTerm]);

    const handleSelect = () => {
        setSearchTerm("");
        setResults([]);
    };

    return (
        <div>
            <nav className="navbar">
                <Link to="/" className="logo">
                    <img src={Logo} alt="Logo" />
                </Link>

                <div className="link">
                    <Link to="/">Accueil</Link>
                    <Link to="/shop">Boutique</Link>
                    <Link to="/about">À propos</Link>
                    <Link to="/contact">Contact</Link>
                </div>

                <div className="navbar-icon" style={{ position: "relative" }}>
                    <input
                        type="text"
                        placeholder="Rechercher ..."
                        className="border"
                        value={searchTerm}
                        onChange={(e) => setSearchTerm(e.target.value)}
                    />

                    {/* Résultats de recherche */}
                    {results.length > 0 && (
                        <ul
                            className="search-results"
                            style={{
                                position: "absolute",
                                top: "100%",
                                left: 0,
                                right: 0,
                                backgroundColor: "white",
                                border: "1px solid #ccc",
                                zIndex: 1000,
                                listStyle: "none",
                                padding: 0,
                                margin: 0,
                            }}
                        >
                            {results.map((product) => (
                                <li
                                    key={product.id}
                                    style={{
                                        padding: "8px",
                                        borderBottom: "1px solid #eee",
                                    }}
                                >
                                    <Link
                                        to={`/product/${product.id}`}
                                        onClick={handleSelect}
                                        style={{
                                            textDecoration: "none",
                                            color: "black",
                                        }}
                                    >
                                        {product.name}
                                    </Link>
                                </li>
                            ))}
                        </ul>
                    )}

                    {/* Panier */}
                    <div style={{ position: "relative" }}>
                        <img
                            src={panierIcon}
                            alt="icone panier"
                            onMouseEnter={() => setPanierIcon(PanierHover)}
                            onMouseLeave={() => setPanierIcon(Panier)}
                            onClick={() => navigate("/cart")}
                            style={{ cursor: "pointer" }}
                        />
                        {totalItems > 0 && (
                            <span className="cart-counter">{totalItems}</span>
                        )}
                    </div>

                    {/* Utilisateur connecté ou non */}
                    {user ? (
                        <div
                            onClick={() => navigate("/profile")}
                            style={{
                                display: "flex",
                                alignItems: "center",
                                gap: "8px",
                                cursor: "pointer",
                            }}
                        >
                            <img
                                src={user.avatar || User}
                                alt="profil"
                                style={{
                                    width: "30px",
                                    height: "30px",
                                    borderRadius: "50%",
                                    objectFit: "cover",
                                }}
                            />
                            <span>{user.firstname}</span>
                        </div>
                    ) : (
                        <img
                            src={userIcon}
                            alt="icone utilisateur"
                            onMouseEnter={() => setUserIcon(UserHover)}
                            onMouseLeave={() => setUserIcon(User)}
                            onClick={() => navigate("/login")}
                            style={{ cursor: "pointer" }}
                        />
                    )}
                </div>
            </nav>
        </div>
    );
};

export default Navbar;
