import React from "react";
import { useNavigate } from "react-router-dom";
import "./Category.css";
import image1 from "../../assets/images/Categories/blonde.jpg";
import image2 from "../../assets/images/Categories/brune.jpg";
import image3 from "../../assets/images/Categories/rousse.jpg";
import image4 from "../../assets/images/Categories/ipa.jpg";
import image5 from "../../assets/images/Categories/provisoire.jpg";

const categories = [
    {
        image: image1,
        link: "/blonde",
        title: "Bière Blonde",
        description: "Légère et rafraîchissante, idéale pour l'apéritif.",
    },
    {
        image: image2,
        link: "/brune",
        title: "Bière Brune",
        description:
            "Corsée et maltée, parfaite pour les amateurs de saveurs riches.",
    },
    {
        image: image3,
        link: "/rousse",
        title: "Bière Rousse",
        description:
            "Équilibrée entre douceur et amertume avec des notes caramélisées.",
    },
    {
        image: image4,
        link: "/ipa",
        title: "Bière IPA",
        description:
            "Amère et fruitée, incontournable pour les amateurs de houblon.",
    },
    {
        image: image5,
        link: "/mousstache",
        title: "Bière Mousstache",
        description:
            "Une recette originale et unique pour une expérience surprenante.",
    },
];

function Category() {
    const navigate = useNavigate();

    return (
        <div className="categories-section">
            <h1 className="category-title">Découvrez nos catégories !</h1>
            <div className="categories-container">
                {categories.map((category, index) => (
                    <div
                        key={index}
                        className="category-item"
                        onClick={() => navigate(category.link)}
                    >
                        <div className="category-circle">
                            <img
                                src={category.image}
                                alt={category.title}
                                className="category-image"
                            />
                        </div>
                        <h3 className="category-name">{category.title}</h3>
                        <p className="category-description">
                            {category.description}
                        </p>
                    </div>
                ))}
            </div>
        </div>
    );
}

export default Category;
