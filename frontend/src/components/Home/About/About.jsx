import React from "react";
import Navbar from "../components/Home/Navbar/Navbar";
import Footer from "../components/Home/Footer/Footer";
import diamant from "../assets/images/About/gemmes.png";
import livraison from "../assets/images/About/livraison-rapide.png";
import cart from "../assets/images/About/carte-de-credit.png";
import "../components/Home/About/About.css";

const AboutPage = () => {
    return (
        <div>
            <Navbar />
            <div style={{ padding: "60px 20px" }}>
                <h2>Pourquoi nous choisir ?</h2>
                <div className="flex-about">
                    <div className="quality">
                        <img src={diamant} alt="icone diamant" />
                        <h3>Un service de qualité pour des bières d'exception</h3>
                        <p>
                            Nous sélectionnons les meilleures bières et assurons une
                            expérience d'achat fluide, sécurisée et rapide. Profitez
                            d'un service optimisé pour commander en toute simplicité !
                        </p>
                    </div>
                    <div className="delivery">
                        <img src={livraison} alt="icone livraison" />
                        <h3>Livraison rapide</h3>
                        <p>
                            Nous garantissons une livraison rapide et soignée pour
                            que vous puissiez savourer vos bières préférées dans les
                            plus brefs délais, tout en bénéficiant d'un suivi de
                            commande transparent et fiable.
                        </p>
                    </div>
                    <div className="cart">
                        <img src={cart} alt="icone cart" />
                        <h3>Paiement sécurisé avec Stripe</h3>
                        <p>
                            Effectuez vos achats en toute sérénité avec Stripe, un
                            système de paiement sécurisé qui protège vos
                            informations personnelles et garantit des transactions
                            rapides et fiables, pour une expérience d'achat sans
                            souci.
                        </p>
                    </div>
                </div>
            </div>
            <Footer />
        </div>
    );
};

export default AboutPage;
