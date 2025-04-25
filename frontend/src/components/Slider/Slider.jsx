import React from "react";
import { useNavigate } from "react-router-dom"; // Import React Router
import "react-slideshow-image/dist/styles.css";
import { Fade } from "react-slideshow-image";
import image1 from "../../assets/images/Slider/image1.jpg";
import image2 from "../../assets/images/Slider/image2.jpg";
import image3 from "../../assets/images/Slider/image3.jpg";

const slideImages = [
    {
        url: image1,
        caption: "Sublimez vos repas avec la bière parfaite !",
        link: "/accords",
    },
    {
        url: image2,
        caption:
            "Explorez le monde des bières artisanales aux saveurs uniques.",
        link: "/artisanales",
    },
    {
        url: image3,
        caption: "Blonde, brune ou ambrée : trouvez votre bière idéale !",
        link: "/types",
    },
];

const slideStyle = {
    position: "relative",
    height: "700px",
    display: "flex",
    justifyContent: "center",
    alignItems: "center",
    flexDirection: "column",
    overflow: "hidden",
};

const textContainer = {
    position: "relative",
    color: "#ffffff",
    fontSize: "30px",
    fontWeight: "bold",
    textAlign: "center",
    padding: "15px 20px",
    borderRadius: "5px",
    zIndex: 2,
};

const buttonStyle = {
    marginTop: "15px",
    padding: "10px 20px",
    backgroundColor: "#FFD700",
    color: "black",
    border: "none",
    borderRadius: "5px",
    cursor: "pointer",
    fontSize: "18px",
    transition: "background 0.3s",
};

const backgroundStyle = {
    position: "absolute",
    top: 0,
    left: 0,
    width: "100%",
    height: "100%",
    backgroundSize: "cover",
    backgroundPosition: "center",
    filter: "brightness(0.5)",
    zIndex: 1,
};

const arrowStyle = {
    margin: "0 20px",
    fontSize: "40px",
    color: "white",
    cursor: "pointer",
};

function Slider() {
    const navigate = useNavigate(); // Hook pour la navigation

    return (
        <div className="slide-container">
            <Fade
                prevArrow={<div style={arrowStyle}>❮</div>}
                nextArrow={<div style={arrowStyle}>❯</div>}
            >
                {slideImages.map((image, index) => (
                    <div key={index} style={slideStyle}>
                        {/* Image en arrière-plan */}
                        <div
                            style={{
                                ...backgroundStyle,
                                backgroundImage: `url(${image.url})`,
                            }}
                        ></div>

                        {/* Contenu du slide */}
                        <div style={textContainer}>
                            <span>{image.caption}</span>
                            <br />
                            <button
                                style={buttonStyle}
                                onClick={() => navigate(image.link)}
                            >
                                Découvrir
                            </button>
                        </div>
                    </div>
                ))}
            </Fade>
        </div>
    );
}

export default Slider;
