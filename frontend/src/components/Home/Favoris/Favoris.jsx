import React from "react";
import "./Favoris.css";

const Favoris = () => {
    return (
        <div>
            <h1>Explorez nos dernières créations et incontournables !</h1>
            <div className="container-favoris">
                <div className="container-left">
                    <a href="">
                        <h2>Découvrez nos dernières nouveautés !</h2>
                        <p>
                            De nouvelles bières artisanales à découvrir chaque
                            mois. Éditions limitées et saveurs inédites vous
                            attendent !
                        </p>
                    </a>
                </div>
                <div className="container-right">
                    <a href="">
                        <h2>Découvrez notre bière !</h2>
                        <p>
                            Une bière artisanale, brassée avec passion, pour des
                            saveurs uniques qui raviront tous les amateurs.
                        </p>
                    </a>
                </div>
            </div>
        </div>
    );
};

export default Favoris;
