// src/pages/Confirmation.jsx
import React from 'react';
import { Link } from 'react-router-dom';

export default function Confirmation() {
  return (
    <div style={{ textAlign: 'center', padding: '2rem' }}>
      <h1>Merci pour votre commande ! 🎉</h1>
      <p>Votre paiement a bien été pris en compte.</p>
      <Link to="/">Retour à l'accueil</Link>
    </div>
  );
}
