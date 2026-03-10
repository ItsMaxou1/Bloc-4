import React, { useContext } from 'react';
import { CartContext } from '../context/CartContext';
import { loadStripe } from '@stripe/stripe-js';
import { Elements } from '@stripe/react-stripe-js';
import PaymentForm from '../components/Checkout/PaymentForm';

console.log("VITE_STRIPE_KEY depuis Vite :", import.meta.env.VITE_STRIPE_KEY);

const stripePromise = loadStripe(import.meta.env.VITE_STRIPE_KEY);

export default function CheckoutPage() {
  const { cart } = useContext(CartContext);

  // Calculer le total en € directement :
  const amount = cart.reduce((sum, item) => {
    const price = parseFloat(item.price) || parseFloat(item.product_variants?.[0]?.price) || 0;
    return sum + price * item.quantity;
  }, 0);

  return (
    <Elements stripe={stripePromise}>
      <PaymentForm amount={amount} />
    </Elements>
  );
}
