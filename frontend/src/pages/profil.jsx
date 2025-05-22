// src/pages/Profile.jsx
import React, { useContext } from "react";
import { AuthContext } from "../context/AuthContext";
import { useNavigate } from "react-router-dom";

const Profile = () => {
    const { user, setUser } = useContext(AuthContext);
    const navigate = useNavigate();

    const handleLogout = () => {
        localStorage.removeItem("user");
        setUser(null);
        navigate("/login");
    };

    if (!user) {
        return <p>Chargement du profil...</p>;
    }

    return (
        <div style={{ textAlign: "center", marginTop: "3rem" }}>
            <h2>Bienvenue {user.firstname} !</h2>
            <img
                src={user.avatar}
                alt="Photo de profil"
                style={{
                    width: "100px",
                    height: "100px",
                    borderRadius: "50%",
                    objectFit: "cover",
                    marginTop: "1rem",
                }}
            />
            <div style={{ marginTop: "2rem" }}>
                <button
                    onClick={handleLogout}
                    style={{
                        padding: "10px 20px",
                        backgroundColor: "#d32f2f",
                        color: "#fff",
                        border: "none",
                        borderRadius: "5px",
                        cursor: "pointer",
                    }}
                >
                    Se déconnecter
                </button>
            </div>
        </div>
    );
};

export default Profile;
