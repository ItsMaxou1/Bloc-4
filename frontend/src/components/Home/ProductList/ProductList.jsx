import React, { useEffect, useState } from "react";
import axios from "axios";
import "./ProductList.css";

function ProductList() {
    const [products, setProducts] = useState([]);

    useEffect(() => {
        axios
            .get("http://localhost:8000/api/product")
            .then((response) => {
                setProducts(response.data.produits.data);
            })
            .catch((error) => {
                console.error(
                    "Erreur lors du chargement des produits :",
                    error
                );
            });
    }, []);

    return (
        <div>
            <h2>Nos Produits</h2>
            <div style={{ display: "flex", flexWrap: "wrap", gap: "20px" }}>
                {products.map((product) => (
                    <div
                        key={product.id}
                        style={{
                            border: "1px solid #ccc",
                            padding: "10px",
                            width: "200px",
                        }}
                    >
                        <h3>{product.name}</h3>
                        <p>Prix : {product.price} €</p>
                        {product.product_variants &&
                            product.product_variants.length > 0 && (
                                <div>
                                    <strong>Variantes :</strong>
                                    <ul>
                                        {product.product_variants.map(
                                            (variant) => (
                                                <li key={variant.id}>
                                                    {variant.name} (
                                                    {variant.price} €)
                                                </li>
                                            )
                                        )}
                                    </ul>
                                </div>
                            )}
                    </div>
                ))}
            </div>
        </div>
    );
}

export default ProductList;
