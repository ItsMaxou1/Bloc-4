import React from "react";
import "./Footer.css";

const Footer = () => {
    return (
        <div className="footer">
            <div className="footer-links">
                <a href="">Mentions légales</a>
                <a href="">Conditions générales de vente</a>
                <a href="">Politique de confidentialité</a>
            </div>
            <p>
                L'abus d'alcool est dangereux pour la santé, à consommer avec
                modération.{" "}
                <strong>
                    La vente de boissons alcooliques est interdite aux mineurs
                    de moins de 18 ans.
                </strong>
            </p>
            <span>© Copyright - Mouss'tache</span>
        </div>
    );
};

export default Footer;
