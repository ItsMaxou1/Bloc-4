// src/Shop/Brands/BrandsSection.jsx
import React, { useEffect, useState } from 'react';
import './Brands.css';

export default function BrandsSection() {
  const [brands, setBrands] = useState([]);

  useEffect(() => {
    fetch('http://127.0.0.1:8000/api/brands')
      .then(res => res.json())
      .then(data => setBrands(data))
  }, []);

  return (
    <section className="brands-section">
      <h2 className="section-title">Nos marques</h2>
      <div className="brands-grid">
        {brands.map(brand => (
          <div key={brand.id} className="brand-card">
            <img src={brand.full_logo_url} alt={brand.name} className="brand-logo"/>
            <p className="brand-name">{brand.name}</p>
          </div>
        ))}
      </div>
    </section>
  );
}
