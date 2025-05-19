// src/Shop/CategoriesFilter/CategoriesFilter.jsx
import React, { useEffect, useState } from 'react';
import './CategoriesFilter.css';

export default function CategoriesFilter({ onCategorySelect }) {
  const [categories, setCategories] = useState([]);
  const [selected, setSelected] = useState(null);

  useEffect(() => {
    fetch('http://127.0.0.1:8000/api/categories')
      .then(res => res.json())
      .then(data => setCategories(data))
      .catch(console.error);
  }, []);

  const handleSelect = id => {
    setSelected(id);
    onCategorySelect(id);
  };

  return (
    <section className="categories-section">
      <h2 className="section-title">Catégories</h2>
      <div className="categories-list">
        <button
          onClick={() => handleSelect(null)}
          className={`category-button ${selected === null ? 'active' : ''}`}
        >
          Toutes
        </button>
        {categories.map(cat => (
          <button
            key={cat.id}
            onClick={() => handleSelect(cat.id)}
            className={`category-button ${selected === cat.id ? 'active' : ''}`}
          >
            {cat.name}
          </button>
        ))}
      </div>
    </section>
  );
}
