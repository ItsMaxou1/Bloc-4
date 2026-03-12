import React, { useState, useContext, useEffect } from "react";
import { useNavigate, Link } from "react-router-dom";
import { CartContext } from "../../../context/CartContext";
import { AuthContext } from "../../../context/AuthContext";

import "./Navbar.css";
import Search from "../../../assets/images/Navbar/chercher.png";
import Panier from "../../../assets/images/Navbar/paniers.png";
import User from "../../../assets/images/Navbar/utilisateur.png";
import Logo from "../../../assets/images/Navbar/logo.png";
import SearchHover from "../../../assets/images/Navbar/chercher-hover.svg";
import PanierHover from "../../../assets/images/Navbar/paniers-hover.svg";
import UserHover from "../../../assets/images/Navbar/utilisateur-hover.svg";

const Navbar = () => {
    const [panierIcon, setPanierIcon] = useState(Panier);
    const [userIcon, setUserIcon] = useState(User);
    const [searchTerm, setSearchTerm] = useState("");
    const [results, setResults] = useState([]);
    const navigate = useNavigate();
    const API_URL = import.meta.env.VITE_API_URL;

    const { cart } = useContext(CartContext);
    const { user } = useContext(AuthContext);

    const totalItems = cart.reduce((sum, item) => sum + item.quantity, 0);

    useEffect(() => {
        const fetchResults = async () => {
            if (searchTerm.trim() === "") {
                setResults([]);
                return;
            }

            try {
                const response = await fetch(
                    `${API_URL}/api/products?search=${encodeURIComponent(searchTerm)}`
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
                <Link to="/" className="navbar-logo">
                    <img src={Logo} alt="Logo" />
                </Link>

                <div className="link">
                    <Link to="/">Accueil</Link>
                    <Link to="/shop">Boutique</Link>
                    <Link to="/about">À propos</Link>
                    <Link to="/contact">Contact</Link>
                </div>

                <div className="navbar-icon">
                    <div style={{ position: "relative" }}>
                        <input
                            type="text"
                            placeholder="Rechercher ..."
                            className="border"
                            value={searchTerm}
                            onChange={(e) => setSearchTerm(e.target.value)}
                        />

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
                                    maxHeight: "300px",
                                    overflowY: "auto",
                                }}
                            >
                                {results.map((product) => (
                                    <li
                                        key={product.id}
                                        style={{
                                            display: "flex",
                                            alignItems: "center",
                                            gap: "10px",
                                            padding: "8px",
                                            borderBottom: "1px solid #eee",
                                        }}
                                    >
                                        <img
                                            src={product.image}
                                            alt={product.name}
                                            style={{
                                                width: "40px",
                                                height: "40px",
                                                objectFit: "cover",
                                                borderRadius: "4px",
                                            }}
                                        />
                                        <Link
                                            to={`/product/${product.id}`}
                                            onClick={handleSelect}
                                            style={{
                                                textDecoration: "none",
                                                color: "black",
                                                display: "flex",
                                                flexDirection: "column",
                                            }}
                                        >
                                            <span style={{ fontWeight: "bold" }}>
                                                {product.name}
                                            </span>
                                            <span style={{ fontSize: "0.9em", color: "#666" }}>
                                                {product.price} €
                                            </span>
                                        </Link>
                                    </li>
                                ))}
                            </ul>
                        )}
                    </div>

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
                                src={user.avatar}
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