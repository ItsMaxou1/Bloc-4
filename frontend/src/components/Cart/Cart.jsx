// src/components/Cart/Cart.jsx

import React, { useContext } from "react";
import { useNavigate, Link } from "react-router-dom";
import { CartContext } from "../../context/CartContext";
import "./Cart.css";

console.log('— ENV VITE —', import.meta.env.VITE_STRIPE_KEY);
console.log("Ma clé Stripe :", import.meta.env.VITE_STRIPE_KEY);


export default function Cart() {
  const navigate = useNavigate();
  const {
    cart,
    removeFromCart,
    clearCart,
    increaseQuantity,
    decreaseQuantity,
  } = useContext(CartContext);

  // Calcul du total
  const total = cart.reduce((sum, item) => {
    const price =
      parseFloat(item.price) ||
      parseFloat(item.product_variants?.[0]?.price) ||
      0;
    return sum + price * item.quantity;
  }, 0);

  // Si panier vide
  if (cart.length === 0) {
    return (
      <div className="cart-container">
        <div className="back-button">
          <Link to="/">← Retour à l'accueil</Link>
        </div>
        <p className="empty-cart">Votre panier est vide.</p>
      </div>
    );
  }

  return (
    <div className="cart-container">
      <div className="back-button">
        <Link to="/">← Retour à l'accueil</Link>
      </div>
      <h2>Votre panier</h2>
      <ul className="cart-list">
        {cart.map((item) => {
          const variant = item.product_variants?.[0] || {};
          const unitPrice =
            parseFloat(item.price) ||
            parseFloat(variant.price) ||
            0;
          const lineTotal = unitPrice * item.quantity;

          return (
            <li key={item.id} className="cart-item">
              <img
                src={`http://127.0.0.1:8000/assets/images/products/${item.image_url}`}
                alt={item.name}
                className="cart-item-image"
              />
              <div className="cart-item-details">
                <strong className="cart-item-name">{item.name}</strong>
                {variant.format && (
                  <p className="cart-item-format">{variant.format}</p>
                )}
                <div className="quantity-control">
                  <button onClick={() => decreaseQuantity(item.id)}>-</button>
                  <span>{item.quantity}</span>
                  <button onClick={() => increaseQuantity(item.id)}>+</button>
                </div>
                <p className="cart-item-price">
                  Prix unitaire : {unitPrice.toFixed(2)} €
                </p>
                <p className="cart-item-line-total">
                  Total : {lineTotal.toFixed(2)} €
                </p>
              </div>
              <button
                className="remove-button"
                onClick={() => removeFromCart(item.id)}
              >
                Retirer
              </button>
            </li>
          );
        })}
      </ul>

      <div className="cart-summary">
        <p>
          <strong>Total général :</strong> {total.toFixed(2)} €
        </p>
        <div className="cart-buttons">
          <button className="clear-button" onClick={clearCart}>
            Vider le panier
          </button>
          {/* Redirection vers /checkout */}
          <button
            className="order-button"
            onClick={() => navigate('/checkout')}
          >
            Commander
          </button>
        </div>
      </div>
    </div>
  );
}

