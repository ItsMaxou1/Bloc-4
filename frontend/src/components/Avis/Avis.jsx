import React from "react";
import "./Avis.css";
import homme1 from "../../assets/images/Avis/homme.jpg";
import homme2 from "../../assets/images/Avis/homme2.jpg";
import femme1 from "../../assets/images/Avis/femme.jpg";

const Avis = () => {
    return (
        <div>
            <h2>Ils témoignent de nous</h2>
            <div className="flex-avis">
                <div className="avis1">
                    <div className="container-avis">
                        <img src={homme1} alt="image homme" />
                        <p>stars</p>
                    </div>
                </div>
            </div>
        </div>
    );
};

export default Avis;
