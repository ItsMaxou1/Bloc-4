import React, { useState } from "react";
import "./Contact.css";

const Contact = () => {
    const [formData, setFormData] = useState({
        name: "",
        email: "",
        subject: "",
        message: "",
    });
    const [sent, setSent] = useState(false);

    const handleChange = (e) => {
        setFormData({ ...formData, [e.target.name]: e.target.value });
    };

    const handleSubmit = (e) => {
        e.preventDefault();
        // Ici tu peux brancher une API Laravel pour envoyer l'email
        setSent(true);
    };

    return (
        <div className="contact-page">
            <div className="contact-hero">
                <h1>Contactez-nous</h1>
                <p>Une question ? Une suggestion ? On vous répond sous 24h.</p>
            </div>

            <div className="contact-container">
                {/* Infos de contact */}
                <div className="contact-infos">
                    <div className="contact-info-item">
                        <span className="contact-icon">📍</span>
                        <div>
                            <h3>Adresse</h3>
                            <p>12 Rue des Brasseurs, 75001 Paris</p>
                        </div>
                    </div>
                    <div className="contact-info-item">
                        <span className="contact-icon">📧</span>
                        <div>
                            <h3>Email</h3>
                            <p>contact@beerstore.fr</p>
                        </div>
                    </div>
                    <div className="contact-info-item">
                        <span className="contact-icon">📞</span>
                        <div>
                            <h3>Téléphone</h3>
                            <p>+33 1 23 45 67 89</p>
                        </div>
                    </div>
                    <div className="contact-info-item">
                        <span className="contact-icon">🕐</span>
                        <div>
                            <h3>Horaires</h3>
                            <p>Lun - Ven : 9h - 18h</p>
                        </div>
                    </div>
                </div>

                {/* Formulaire */}
                <div className="contact-form-wrapper">
                    {sent ? (
                        <div className="contact-success">
                            <span>✅</span>
                            <h2>Message envoyé !</h2>
                            <p>Nous vous répondrons dans les plus brefs délais.</p>
                            <button onClick={() => setSent(false)}>
                                Envoyer un autre message
                            </button>
                        </div>
                    ) : (
                        <form className="contact-form" onSubmit={handleSubmit}>
                            <div className="form-row">
                                <div className="form-group">
                                    <label>Nom complet</label>
                                    <input
                                        type="text"
                                        name="name"
                                        placeholder="Jean Dupont"
                                        value={formData.name}
                                        onChange={handleChange}
                                        required
                                    />
                                </div>
                                <div className="form-group">
                                    <label>Email</label>
                                    <input
                                        type="email"
                                        name="email"
                                        placeholder="jean@exemple.fr"
                                        value={formData.email}
                                        onChange={handleChange}
                                        required
                                    />
                                </div>
                            </div>
                            <div className="form-group">
                                <label>Sujet</label>
                                <input
                                    type="text"
                                    name="subject"
                                    placeholder="Votre sujet"
                                    value={formData.subject}
                                    onChange={handleChange}
                                    required
                                />
                            </div>
                            <div className="form-group">
                                <label>Message</label>
                                <textarea
                                    name="message"
                                    placeholder="Écrivez votre message ici..."
                                    rows={6}
                                    value={formData.message}
                                    onChange={handleChange}
                                    required
                                />
                            </div>
                            <button type="submit" className="contact-submit">
                                Envoyer le message
                            </button>
                        </form>
                    )}
                </div>
            </div>
        </div>
    );
};

export default Contact;
