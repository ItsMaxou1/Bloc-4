// src/components/Checkout/PaymentForm.jsx
import React, { useState, useEffect, useContext } from 'react';
import { CardElement, useStripe, useElements } from '@stripe/react-stripe-js';
import { useNavigate } from 'react-router-dom';
import axios from 'axios';
import { CartContext } from '../../context/CartContext';

export default function PaymentForm({ amount }) {
  const stripe = useStripe();
  const elements = useElements();
  const navigate = useNavigate();
  const { clearCart } = useContext(CartContext);
  const [clientSecret, setClientSecret] = useState('');

  useEffect(() => {
// APRÈS
    axios.post(
        import.meta.env.VITE_API_URL + '/api/checkout/payment-intent',
        {
        amount: Math.round(amount * 100),
        currency: 'eur'
        }
    )
    .then(({ data }) => setClientSecret(data.clientSecret));
  }, [amount]);

  const handleSubmit = async (e) => {
    e.preventDefault();
    if (!stripe || !elements) return;

    const card = elements.getElement(CardElement);
    const { error, paymentIntent } = await stripe.confirmCardPayment(clientSecret, {
      payment_method: { card },
    });

    if (error) {
      return alert(error.message);
    }
    if (paymentIntent.status === 'succeeded') {
      clearCart();               // on vide le panier
      navigate('/confirmation'); // on redirige
    }
  };

  return (
    <form onSubmit={handleSubmit}>
      <CardElement options={{ hidePostalCode: true }} />
      <button type="submit" disabled={!stripe || !clientSecret}>
        Payer {amount.toFixed(2)} €
      </button>
    </form>
  );
}
