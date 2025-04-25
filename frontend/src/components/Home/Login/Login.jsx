import { useState } from "react";
import { useForm } from "react";
import "./Login.css";

export default function Login() {
    const {
        register,
        handleSubmit,
        formState: { errors },
    } = useForm();
    const [errorMessage, setErrorMessage] = useState("");

    const onSubmit = async (data) => {
        try {
            const response = await fetch("BACK_URL/api/login", {
                method: "POST",
                headers: { "Content-Type": "application/json" },
                body: JSON.stringify(data),
            });

            if (!response.ok) {
                throw new Error("Identifiant incorrect");
            }

            const result = await response.json();
            localStorage.setItem("token", result.token);
            alert("Connexion réussie !");
        } catch (error) {
            setErrorMessage(error.message);
        }
    };

    return (
        <div className="login-container">
            <div className="login-box">
                <h2 className="login-title">Connexion</h2>
                {errorMessage && (
                    <p className="error-message">{errorMessage}</p>
                )}
                <form onSubmit={handleSubmit(onSubmit)}>
                    <div className="form-group">
                        <label>Email</label>
                        <input
                            type="email"
                            {...register("email", { required: "Email requis" })}
                            className="input-field"
                        />
                        {errors.email && (
                            <p className="error-message">
                                {errors.email.message}
                            </p>
                        )}
                    </div>

                    <div className="form-group">
                        <label>Mot de passe</label>
                        <input
                            type="password"
                            {...register("password", {
                                required: "Mot de passe requis",
                            })}
                            className="input-field"
                        />
                        {errors.password && (
                            <p className="error-message">
                                {errors.password.message}
                            </p>
                        )}
                    </div>

                    <button type="submit" className="submit-button">
                        Se connecter
                    </button>
                </form>
            </div>
        </div>
    );
}
