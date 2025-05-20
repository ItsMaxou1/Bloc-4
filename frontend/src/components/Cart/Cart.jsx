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

    return (
        <div className="cart-container">
            <div className="back-button">
                <Link to="/">← Retour à l'accueil</Link>
            </div>
            <h2>Votre panier</h2>
            <ul className="cart-list">
                {cart.map((item) => (
                    <li key={item.id} className="cart-item">
                        <div>
                            <strong>{item.name}</strong> <br />
                            <div className="quantity-control">
                                <button
                                    onClick={() => decreaseQuantity(item.id)}
                                >
                                    -
                                </button>
                                <span>{item.quantity}</span>
                                <button
                                    onClick={() => increaseQuantity(item.id)}
                                >
                                    +
                                </button>
                            </div>
                            Prix unitaire : {item.price} €
                        </div>
                        <button
                            className="remove-button"
                            onClick={() => removeFromCart(item.id)}
                        >
                            Retirer
                        </button>
                    </li>
                ))}
            </ul>

            <div className="cart-summary">
                <p>
                    <strong>Total :</strong> {total.toFixed(2)} €
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
