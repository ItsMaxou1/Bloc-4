import React, { useState } from "react";
import "./Navbar.css";
import Search from "../../../assets/images/Navbar/chercher.png";
import Panier from "../../../assets/images/Navbar/paniers.png";
import User from "../../../assets/images/Navbar/utilisateur.png";
import Logo from "../../../assets/images/Navbar/Logo.png";
import SearchHover from "../../../assets/images/Navbar/chercher-hover.svg";
import PanierHover from "../../../assets/images/Navbar/paniers-hover.svg";
import UserHover from "../../../assets/images/Navbar/utilisateur-hover.svg";

const Navbar = () => {
    const [searchIcon, setSearchIcon] = useState(Search);
    const [panierIcon, setPanierIcon] = useState(Panier);
    const [userIcon, setUserIcon] = useState(User);

    return (
        <div>
            <nav>
                <a href="#" className="navbar-logo">
                    <img src={Logo} alt="Logo" />
                </a>
                <div className="link">
                    <a href="#">Accueil</a>
                    <a href="#">Boutique</a>
                    <a href="#">À propos</a>
                    <a href="#">Contact</a>
                </div>
                <div className="navbar-icon">
                    <form>
                        <input
                            type="text"
                            placeholder="Rechercher ..."
                            className="border"
                        />
                    </form>
                    <img
                        src={panierIcon}
                        alt="icone panier"
                        onMouseEnter={() => setPanierIcon(PanierHover)}
                        onMouseLeave={() => setPanierIcon(Panier)}
                    />
                    <img
                        src={userIcon}
                        alt="icone utilisateur"
                        onMouseEnter={() => setUserIcon(UserHover)}
                        onMouseLeave={() => setUserIcon(User)}
                    />
                </div>
            </nav>
        </div>
    );
};

export default Navbar;
