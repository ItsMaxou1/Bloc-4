import React, { useState, useContext } from "react";
import { useNavigate, Link } from "react-router-dom";
import { CartContext } from "../../../context/CartContext";

import "./Navbar.css";
import Search from "../../../assets/images/Navbar/chercher.png";
import Panier from "../../../assets/images/Navbar/paniers.png";
import User from "../../../assets/images/Navbar/utilisateur.png";
import Logo from "../../../assets/images/Navbar/Logo.png";
import SearchHover from "../../../assets/images/Navbar/chercher-hover.svg";
import PanierHover from "../../../assets/images/Navbar/paniers-hover.svg";
import UserHover from "../../../assets/images/Navbar/utilisateur-hover.svg";

const Navbar = () => {
    const [panierIcon, setPanierIcon] = useState(Panier);
    const [userIcon, setUserIcon] = useState(User);
    const navigate = useNavigate();

    const { cart } = useContext(CartContext);
    const totalItems = cart.reduce((sum, item) => sum + item.quantity, 0);

    return (
        <div>
            <nav className="navbar">
                <a href="#" className="navbar-logo">
                    <img src={Logo} alt="Logo" />
                </a>

                <div className="link">
                    <Link to="/">Accueil</Link>
                    <Link to="/shop">Boutique</Link>
                    <Link to="/about">À propos</Link>
                    <Link to="/contact">Contact</Link>
                </div>

                <div className="navbar-icon">
                    <form>
                        <input
                            type="text"
                            placeholder="Rechercher ..."
                            className="border"
                        />
                    </form>

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

                    <img
                        src={userIcon}
                        alt="icone utilisateur"
                        onMouseEnter={() => setUserIcon(UserHover)}
                        onMouseLeave={() => setUserIcon(User)}
                        onClick={() => navigate("/login")}
                        style={{ cursor: "pointer" }}
                    />
                </div>
            </nav>
        </div>
    );
};

export default Navbar;
