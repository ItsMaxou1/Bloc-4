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
        // on récupère la liste des variantes, quel que soit le nom
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

  // on attend d'avoir le produit ET une variante
  if (!product || !selectedVariant) {
    return <p>Chargement du produit…</p>;
  }

  // même logique de récupération pour l'affichage
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
          {/* 1. Image à gauche */}
          <img
            className="product-main-image"
            src={`http://127.0.0.1:8000/assets/images/products/${product.image_url}`}
            alt={product.name}
          />

          {/* 2. Infos à droite */}
          <div className="product-info">
            {/* Sélecteur de format */}
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

            {/* Prix et stock */}
            <p className="product-price">{selectedVariant.price} €</p>
            <p className="product-stock">
              Stock : {selectedVariant.stock}
            </p>

            {/* Short description */}
            {product.short_description && (
              <p className="product-short-desc">
                {product.short_description}
              </p>
            )}

            {/* Full description */}
            {product.description && (
              <p className="product-description">{product.description}</p>
            )}

            {/* Bouton Ajouter au panier */}
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
