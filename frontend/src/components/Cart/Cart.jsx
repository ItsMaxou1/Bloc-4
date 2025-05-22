import React, { useContext } from "react";
import { CartContext } from "../../context/CartContext";
import "./Cart.css";
import { Link } from "react-router-dom";

function Cart() {
  const {
    cart,
    removeFromCart,
    clearCart,
    increaseQuantity,
    decreaseQuantity,
  } = useContext(CartContext);

<<<<<<< HEAD
  const total = cart.reduce((sum, item) => {
    const unitPrice =
      item.price ??
      parseFloat(item.product_variants?.[0]?.price) ??
      0;
    return sum + unitPrice * item.quantity;
  }, 0);
=======
    const total = cart.reduce(
        (sum, item) => sum + item.price * item.quantity,
        0
    );

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
>>>>>>> parent of 9e4f7e6 (commit hugo Login/Login admin)

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
        // Fallback sur la première variante, en forçant un nombre et éliminant NaN
        const variant = item.product_variants?.[0] || {};
        const unitPrice =
            parseFloat(item.price) ||
            parseFloat(variant.price) ||
            0;
        const lineTotal = unitPrice * item.quantity;

          return (
            <li key={item.id} className="cart-item">
              {/* Miniature */}
              <img
                src={`http://127.0.0.1:8000/assets/images/products/${item.image_url}`}
                alt={item.name}
                className="cart-item-image"
              />



              <div className="cart-item-details">
                {/* Nom et format */}
                <strong className="cart-item-name">{item.name}</strong>
                {variant.format && (
                  <p className="cart-item-format">{variant.format}</p>
                )}

                {/* Contrôle de quantité */}
                <div className="quantity-control">
                  <button onClick={() => decreaseQuantity(item.id)}>-</button>
                  <span>{item.quantity}</span>
                  <button onClick={() => increaseQuantity(item.id)}>+</button>
                </div>

                {/* Prix unitaire et total ligne */}
                <p className="cart-item-price">
                  Prix unitaire : {unitPrice.toFixed(2)} €
                </p>
                <p className="cart-item-line-total">
                  Total : {lineTotal.toFixed(2)} €
                </p>
              </div>

              {/* Bouton retirer */}
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

      {/* Récapitulatif */}
      <div className="cart-summary">
        <p>
          <strong>Total général :</strong> {total.toFixed(2)} €
        </p>
        <div className="cart-buttons">
          <button className="clear-button" onClick={clearCart}>
            Vider le panier
          </button>
          <button className="order-button">Commander</button>
        </div>
      </div>
    </div>
  );
}

export default Cart;
