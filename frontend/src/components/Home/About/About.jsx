import React from "react";
import "./About.css";
import diamant from "../../../assets/images/About/gemmes.png";
import livraison from "../../../assets/images/About/livraison-rapide.png";
import cart from "../../../assets/images/About/carte-de-credit.png";

const About = () => {
    return (
        <div>
            <h2>Pourquoi nous choisir ?</h2>
            <div className="flex-about">
                <div className="quality">
                    <img src={diamant} alt="icone diamant" />
                    <h3>Un service de qualité pour des bières d'exception</h3>
                    <p>Nous sélectionnons les meilleures bières et assurons une expérience d'achat fluide, sécurisée et rapide. Profitez d'un service optimisé pour commander en toute simplicité !</p>
                </div>
                <div className="delivery">
                    <img src={livraison} alt="icone livraison" />
                    <h3>Livraison rapide</h3>
                    <p>Nous garantissons une livraison rapide et soignée pour que vous puissiez savourer vos bières préférées dans les plus brefs délais, tout en bénéficiant d'un suivi de commande transparent et fiable.</p>
                </div>
                <div className="cart">
                    <img src={cart} alt="icone cart" />
                    <h3>Paiement sécurisé avec Stripe</h3>
                    <p>Effectuez vos achats en toute sérénité avec Stripe, un système de paiement sécurisé qui protège vos informations personnelles et garantit des transactions rapides et fiables.</p>
                </div>
            </div>
        </div>
    );
};
export default About;
