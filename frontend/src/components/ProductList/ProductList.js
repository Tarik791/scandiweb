import React from 'react';
import ProductCard from '../ProductCard/ProductCard';
import './ProductList.css';

const ProductList = ({ products, onCheckboxChange }) => {
  return (
    <div className="product-list">
      {products.map(product => (
        <ProductCard
          key={product.id}
          product={product}
          onCheckboxChange={onCheckboxChange}
        />
      ))}
    </div>
  );
};

export default ProductList;
