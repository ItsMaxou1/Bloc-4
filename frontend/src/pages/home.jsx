import React from "react";
import Slider from "../components/Home/Slider/Slider";
import Category from "../components/Home/Category/Category";
import Favoris from "../components/Home/Favoris/Favoris";
import About from "../components/Home/About/About";
import Avis from "../components/Home/Avis/Avis";
import ProductList from "../components/Home/ProductList/ProductList";

const HomePage = () => {
    return (
        <div>
            <Slider />
            <Category />
            <Favoris />
            <ProductList />
            <About />
            <Avis />
        </div>
    );
};

export default HomePage;
