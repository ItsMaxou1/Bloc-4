import React from "react";
import "./Products.css";

// Importation des images locales
import imageBiereBlonde1 from "../../../assets/images/Products/biere-blonde-1.jpg";
import imageBiereBlonde2 from "../../../assets/images/Products/biere-blonde-2.jpg";
import imageBiereBrune1 from "../../../assets/images/Products/biere-brune-1.jpg";
import imageBiereBrune2 from "../../../assets/images/Products/biere-brune-2.jpg";
import imageBiereRousse1 from "../../../assets/images/Products/biere-rousse-1.jpg";
import imageBiereRousse2 from "../../../assets/images/Products/biere-rousse-2.jpg";
import imageBiereIPA1 from "../../../assets/images/Products/biere-IPA-1.jpg";
import imageBiereIPA2 from "../../../assets/images/Products/biere-IPA-2.jpg";

// Liste des produits avec images locales
const products = [
    {
        id: 1,
        name: "Bière Blonde",
        description: "Une bière dorée au goût doux et rafraîchissant.",
        image_url: imageBiereBlonde1,
    },
    {
        id: 2,
        name: "Bière Brune",
        description: "Une bière brune au goût riche et complexe.",
        image_url: imageBiereBrune1,
    },
    {
        id: 3,
        name: "Bière Rousse",
        description:
            "Une bière ambrée avec des notes de caramel et de malts grillés.",
        image_url: imageBiereRousse1,
    },
    {
        id: 4,
        name: "IPA",
        description:
            "Une IPA bien houblonnée et fruitée, pour les amateurs de saveurs intenses.",
        image_url: imageBiereIPA1,
    },
    {
        id: 5,
        name: "Bière Blonde",
        description: "Une bière dorée au goût doux et rafraîchissant.",
        image_url: imageBiereBlonde2,
    },
    {
        id: 6,
        name: "Bière Brune",
        description: "Une bière brune au goût riche et complexe.",
        image_url: imageBiereBrune2,
    },
    {
        id: 7,
        name: "Bière Rousse",
        description:
            "Une bière ambrée avec des notes de caramel et de malts grillés.",
        image_url: imageBiereRousse2,
    },
    {
        id: 8,
        name: "IPA",
        description:
            "Une IPA bien houblonnée et fruitée, pour les amateurs de saveurs intenses.",
        image_url: imageBiereIPA2,
    },
];

const Products = () => {
    // Mélange aléatoire des produits
    const shuffledProducts = [...products].sort(() => Math.random() - 0.5);

    return (
        <div>
            <h2>Découvrez nos bières artisanales de qualité !</h2>
            <div className="products-container">
                {shuffledProducts.map((product) => (
                    <div key={product.id} className="product-item">
                        <a
                            href={`/products/${product.id}`}
                            className="product-link"
                        >
                            <div
                                className="product-image"
                                style={{
                                    backgroundImage: `url(${product.image_url})`,
                                }}
                            />
                            <h3>{product.name}</h3>
                            <p>{product.description}</p>
                        </a>
                    </div>
                ))}
            </div>
        </div>
    );
};

export default Products;
