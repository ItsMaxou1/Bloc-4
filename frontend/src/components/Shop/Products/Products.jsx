// src/Shop/Products/ProductsList.jsx
import React, { useEffect, useState } from 'react';
import './Products.css';

export default function ProductsList({ categoryId }) {
  const [products, setProducts] = useState([]);

  useEffect(() => {
    let url = 'http://127.0.0.1:8000/api/products';
    if (categoryId) {
      url += `?category_id=${categoryId}`;
    }

    fetch(url)
      .then(res => res.json())
      .then(data => setProducts(data))
      .catch(console.error);
  }, [categoryId]);

  return (
    <section className="products-section">
      <h2 className="section-title">Produits</h2>
      <div className="products-grid">
        {products.map(prod => (
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
