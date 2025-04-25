import React from "react";
import Navbar from "../components/Home/Navbar/Navbar";
import Slider from "../components/Home/Slider/Slider";
import Category from "../components/Home/Category/Category";
import Favoris from "../components/Home/Favoris/Favoris";
import Products from "../components/Home/Products/Products";
import About from "../components/Home/About/About";
import Avis from "../components/Home/Avis/Avis";
import Footer from "../components/Home/Footer/Footer";

const HomePage = () => {
    return (
        <div>
            <Navbar />
            <Slider />
            <Category />
            <Favoris />
            <Products />
            <About />
            <Avis />
            <Footer />
        </div>
    );
};

export default HomePage;
