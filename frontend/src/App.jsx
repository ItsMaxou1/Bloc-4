import React from "react";
import Navbar from "./components/Navbar/Navbar";
import Slider from "./components/Slider/Slider";
import Category from "./components/Category/Category";
import Favoris from "./components/Favoris/Favoris";
import Products from "./components/Products/Products";
import About from "./components/About/About";
import Avis from "./components/Avis/Avis";

const App = () => {
    return (
        <div>
            <Navbar />
            <Slider />
            <Category />
            <Favoris />
            <Products />
            <About />
            <Avis />
        </div>
    );
};

export default App;
