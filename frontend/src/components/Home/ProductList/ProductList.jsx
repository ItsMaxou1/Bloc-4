import React, { useEffect, useState, useContext } from "react";
import axios from "axios";
import "./ProductList.css";
import { CartContext } from "../../../context/CartContext.jsx";
import Alert from "../../Alert/Alert";

function ProductList() {
    const [products, setProducts] = useState([]);
    const [showAlert, setShowAlert] = useState(false);
    const { addToCart } = useContext(CartContext);

    useEffect(() => {
        axios
            .get("http://localhost:8000/api/products")
            .then((response) => {
                setProducts(response.data);
            })
            .catch((error) => {
                console.error(
                    "Erreur lors du chargement des produits :",
                    error
                );
            });
    }, []);

    const handleAddToCart = (product) => {
        addToCart(product);
        setShowAlert(true);
        setTimeout(() => setShowAlert(false), 3000);
    };

    return (
        <section className="products-section">
            <Alert message="Produit ajouté au panier !" show={showAlert} />

            <h2 className="section-title">Produits</h2>
            <div className="products-grid">
                {products.slice(0, 8).map((prod) => (
                    <div key={prod.id} className="product-card">
                        <img
                            src={`http://127.0.0.1:8000/assets/images/products/${prod.image_url}`}
                            alt={prod.name}
                            className="product-image"
                        />
                        <p className="product-name">{prod.name}</p>
                    </div>
                ))}
            </div>
        </section>
    );
}

export default ProductList;
