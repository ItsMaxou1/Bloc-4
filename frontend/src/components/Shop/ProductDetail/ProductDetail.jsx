// src/Shop/ProductDetail/ProductDetail.jsx
import React, { useState, useEffect } from 'react';
import { useParams } from 'react-router-dom';
import './ProductDetail.css';
import Navbar from "../../Home/Navbar/Navbar";

export default function ProductDetail() {
  const { id } = useParams();              // id du produit
  const [product, setProduct] = useState(null);
  const [selectedVariant, setSelectedVariant] = useState(null);

  useEffect(() => {
    fetch(`http://127.0.0.1:8000/api/products/${id}`)
      .then(res => {
        if (!res.ok) throw new Error(`Statut HTTP : ${res.status}`);
        return res.json();
      })
      .then(data => {
        setProduct(data);
        // par défaut, on prend la première variante
        if (data.variants && data.variants.length) {
          setSelectedVariant(data.variants[0]);
        }
      })
      .catch(err => console.error(err));
  }, [id]);

  if (!product || !selectedVariant) {
    return <p>Chargement du produit…</p>;
  }

  return (
    <>
      <Navbar />
      <section className="product-detail">
        {/* 1. Nom du produit */}
        <h1 className="product-title">{product.name}</h1>

        <div className="product-main">
          {/* 2. Image à gauche */}
          <img
            className="product-main-image"
            src={`http://127.0.0.1:8000/assets/images/products/${product.image_url}`}
            alt={product.name}
          />

          {/* 3. Tout le texte à droite */}
          <div className="product-info">
            {/* 3.1 Sélecteur de formats */}
            <label htmlFor="format-select">Format&nbsp;:</label>
            <select
              id="format-select"
              value={selectedVariant.id}
              onChange={e => {
                const v = product.variants.find(v => v.id === Number(e.target.value));
                setSelectedVariant(v);
              }}
            >
              {product.variants.map(v => (
                <option key={v.id} value={v.id}>
                  {v.format}
                </option>
              ))}
            </select>

            {/* 3.2 Prix */}
            <p className="product-price">{selectedVariant.price} €</p>
            {/* Stock juste en dessous */}
            <p className="product-stock">Stock : {selectedVariant.stock}</p>

            {/* 3.3 Short description */}
            {product.short_description && (
              <p className="product-short-desc">{product.short_description}</p>
            )}

            {/* 3.4 Full description */}
            {product.description && (
              <p className="product-description">{product.description}</p>
            )}
          </div>
        </div>
      </section>
    </>
  );
}
