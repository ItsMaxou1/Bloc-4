import React, { createContext, useState, useEffect } from "react";

export const CartContext = createContext();

export const CartProvider = ({ children }) => {
  const [cart, setCart] = useState(() => {
    const savedCart = localStorage.getItem("cart");
    return savedCart ? JSON.parse(savedCart) : [];
  });

  useEffect(() => {
    localStorage.setItem("cart", JSON.stringify(cart));
  }, [cart]);

  const addToCart = (product, variant = null) => {
    // Sélection de la variante (ou première variante par défaut)
    const selVar = variant ?? product.product_variants?.[0] ?? {};
    // Choix de l'image en fonction du contexte
    const img =
      product.image_url ||
      product.product?.image_url ||
      ""; // placeholder possible

    // Construction de l'item
    const item = {
      id: selVar.id,
      productId: product.id,
      name: product.name,
      image_url: img,
      format: selVar.format,
      price: parseFloat(selVar.price) || 0,
      quantity: 1,
    };

    const exists = cart.find((p) => p.id === item.id);
    if (exists) {
      setCart(
        cart.map((p) =>
          p.id === item.id ? { ...p, quantity: p.quantity + 1 } : p
        )
      );
    } else {
      setCart([...cart, item]);
    }
  };

  const removeFromCart = (productId) => {
    setCart(cart.filter((item) => item.id !== productId));
  };

  const clearCart = () => {
    setCart([]);
  };

  const increaseQuantity = (productId) => {
    setCart((prev) =>
      prev.map((item) =>
        item.id === productId
          ? { ...item, quantity: item.quantity + 1 }
          : item
      )
    );
  };

  const decreaseQuantity = (productId) => {
    setCart(
      (prev) =>
        prev
          .map((item) =>
            item.id === productId
              ? { ...item, quantity: item.quantity - 1 }
              : item
          )
          .filter((item) => item.quantity > 0)
    );
  };

  return (
    <CartContext.Provider
      value={{
        cart,
        addToCart,
        removeFromCart,
        clearCart,
        increaseQuantity,
        decreaseQuantity,
      }}
    >
      {children}
    </CartContext.Provider>
  );
};