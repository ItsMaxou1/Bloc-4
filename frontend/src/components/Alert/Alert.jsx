import React from "react";
import "./Alert.css";

const Alert = ({ message, show }) => {
    return (
        show && (
            <div className="alert-container">
                <p>{message}</p>
            </div>
        )
    );
};

export default Alert;
