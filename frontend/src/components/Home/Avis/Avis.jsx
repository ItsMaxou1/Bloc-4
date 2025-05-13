import React from "react";
import "./Avis.css";
import etoile from "../../../assets/images/Avis/etoile.png";
import etoile2 from "../../../assets/images/Avis/etoile2.png";
import pp1 from "../../../assets/images/Avis/pp1.webp";
import pp2 from "../../../assets/images/Avis/pp2.jpg";
import pp3 from "../../../assets/images/Avis/pp3.jpg";

const Avis = () => {
    return (
        <div>
            <h2>Ils témoignent de nous</h2>
            <div className="flex-avis">
                <div className="avis1">
                    <div className="container-avis">
                        <div className="avis-top">
                            <div className="name">
                                <img src={pp1} alt="image homme" />
                                <h3>Jean</h3>
                            </div>
                            <div className="stars">
                                <img src={etoile} alt="icone etoile" />
                                <img src={etoile} alt="icone etoile" />
                                <img src={etoile} alt="icone etoile" />
                                <img src={etoile} alt="icone etoile" />
                                <img src={etoile2} alt="icone etoile vide" />
                            </div>
                            <p>
                                Lorem ipsum dolor sit amet consectetur
                                adipisicing elit. A, reprehenderit nostrum?
                                Recusandae magnam nesciunt veritatis hic minima,
                                natus quaerat molestias maiores cum. Voluptatum
                                nemo ab neque modi error quidem ex?
                            </p>
                        </div>
                    </div>
                </div>
                <div className="avis2">
                    <div className="container-avis">
                        <div className="avis-top">
                            <div className="name">
                                <img src={pp2} alt="image homme" />
                                <h3>Sarah</h3>
                            </div>
                            <div className="stars">
                                <img src={etoile} alt="icone etoile" />
                                <img src={etoile} alt="icone etoile" />
                                <img src={etoile} alt="icone etoile" />
                                <img src={etoile} alt="icone etoile" />
                                <img src={etoile2} alt="icone etoile vide" />
                            </div>
                            <p>
                                Lorem ipsum dolor sit amet consectetur
                                adipisicing elit. A, reprehenderit nostrum?
                                Recusandae magnam nesciunt veritatis hic minima,
                                natus quaerat molestias maiores cum. Voluptatum
                                nemo ab neque modi error quidem ex?
                            </p>
                        </div>
                    </div>
                </div>
                <div className="avis3">
                    <div className="container-avis">
                        <div className="avis-top">
                            <div className="name">
                                <img src={pp3} alt="image homme" />
                                <h3>Pascal</h3>
                            </div>
                            <div className="stars">
                                <img src={etoile} alt="icone etoile" />
                                <img src={etoile} alt="icone etoile" />
                                <img src={etoile} alt="icone etoile" />
                                <img src={etoile} alt="icone etoile" />
                                <img src={etoile2} alt="icone etoile vide" />
                            </div>
                            <p>
                                Lorem ipsum dolor sit amet consectetur
                                adipisicing elit. A, reprehenderit nostrum?
                                Recusandae magnam nesciunt veritatis hic minima,
                                natus quaerat molestias maiores cum. Voluptatum
                                nemo ab neque modi error quidem ex?
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    );
};

export default Avis;
