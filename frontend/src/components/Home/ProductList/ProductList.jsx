import React, { useEffect, useState, useContext } from "react";
import { CartContext } from "../../../context/CartContext";
import Alert from "../../Alert/Alert";
import "./ProductList.css";

export default function ProductList() {
  const [products, setProducts] = useState([]);
  const [showAlert, setShowAlert] = useState(false);
  const { addToCart } = useContext(CartContext);
  const API_URL = import.meta.env.VITE_API_URL;

  useEffect(() => {
    fetch(`${API_URL}/api/products`)
      .then((res) => {
        if (!res.ok) throw new Error(`HTTP ${res.status}`);
        return res.json();
      })
      .then((data) => setProducts(data))
      .catch(() => {});
  }, []);

  const formatPriceRange = (prod) => {
    const variants = prod.product_variants;
    if (!variants || variants.length === 0) return "";
    const prices = variants.map((v) => parseFloat(v.price));
    const min = Math.min(...prices).toFixed(2);
    const max = Math.max(...prices).toFixed(2);
    return min === max ? `${min} €` : `${min} € – ${max} €`;
  };

  const handleAdd = (prod) => {
    addToCart(prod, prod.product_variants[0]);
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
              src={`${API_URL}/assets/images/products/${prod.image_url}`}
              alt={prod.name}
              className="product-image"
            />
            <div className="product-info">
              <p className="product-name">{prod.name}</p>
              <p className="product-category">
                {prod.category?.name ?? "Catégorie inconnue"}
              </p>
              <p className="product-price-range">{formatPriceRange(prod)}</p>
            </div>
            <div className="product-meta">
              <button onClick={() => handleAdd(prod)} className="add-button">
                Ajouter
              </button>
              <span className="product-alcool">
                {parseFloat(prod.alcool_volume).toFixed(2)}% vol.
              </span>
            </div>
          </div>
        ))}
      </div>
    </section>
  );
}