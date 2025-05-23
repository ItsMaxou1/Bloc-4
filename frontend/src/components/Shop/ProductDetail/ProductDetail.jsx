// src/components/Shop/ProductDetail/ProductDetail.jsx

import React, { useState, useEffect, useContext } from "react";
import { useParams } from "react-router-dom";
import "./ProductDetail.css";
import Navbar from "../../Home/Navbar/Navbar";
import { CartContext } from "../../../context/CartContext.jsx";

export default function ProductDetail() {
    const { id } = useParams();
    const [product, setProduct] = useState(null);
    const [selectedVariant, setSelectedVariant] = useState(null);
    const { addToCart } = useContext(CartContext);

    useEffect(() => {
        fetch(`http://127.0.0.1:8000/api/products/${id}`)
            .then((res) => {
                if (!res.ok) throw new Error(`HTTP status ${res.status}`);
                return res.json();
            })
            .then((data) => {
                setProduct(data);
                const variants =
                    data.variants ||
                    data.productVariants ||
                    data.product_variants ||
                    [];

                if (variants.length) {
                    setSelectedVariant(variants[0]);
                }
            })
            .catch((err) => console.error("Fetch product error:", err));
    }, [id]);

    if (!product || !selectedVariant) {
        return <p>Chargement du produit…</p>;
    }

    const variants =
        product.variants ||
        product.productVariants ||
        product.product_variants ||
        [];

    return (
        <>
            <Navbar />

            <section className="product-detail">
                <h1 className="product-title">{product.name}</h1>

                <div className="product-main">
                    {/* Image produit */}
                    <img
                        className="product-main-image"
                        src={`http://127.0.0.1:8000/assets/images/products/${product.image_url}`}
                        alt={product.name}
                    />

                    {/* Infos produit */}
                    <div className="product-info">
                        {/* Format */}
                        <label htmlFor="format-select">Format&nbsp;:</label>
                        <select
                            id="format-select"
                            value={selectedVariant.id}
                            onChange={(e) => {
                                const v = variants.find(
                                    (v) => v.id === Number(e.target.value)
                                );
                                setSelectedVariant(v);
                            }}
                        >
                            {variants.map((v) => (
                                <option key={v.id} value={v.id}>
                                    {v.format}
                                </option>
                            ))}
                        </select>

                        {/* Prix, stock, alcool */}
                        <p className="product-price">
                            {selectedVariant.price} €
                        </p>
                        <p className="product-stock">
                            Stock : {selectedVariant.stock}
                        </p>

                        {product.alcool_volume && (
                            <p className="product-alcohol-rate">
                                Taux d’alcool : {product.alcool_volume}%
                            </p>
                        )}

                        {/* Descriptions */}
                        {product.short_description && (
                            <p className="product-short-desc">
                                {product.short_description}
                            </p>
                        )}

                        {product.description && (
                            <p className="product-description">
                                {product.description}
                            </p>
                        )}

                        {/* Bouton panier */}
                        <button
                            onClick={() => addToCart(product, selectedVariant)}
                            className="add-button"
                        >
                            Ajouter au panier
                        </button>
                    </div>
                </div>
            </section>
        </>
    );
}
