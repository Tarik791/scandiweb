import React from 'react';
import './ProductCard.css';
import { removeDecimalPlaces } from '../../utils/format';

const ProductCard = ({ product, onCheckboxChange }) => {
  const renderAttributes = () => {
    switch (product.type) {
      case 'Book':
        return <p>Weight: {Math.trunc(product.weight)} Kg</p>;
      case 'DVD':
        return <p>Size: {Math.trunc(product.size)} MB</p>;
      case 'Furniture':
        return <p>Dimensions: {removeDecimalPlaces(product.dimensions)}</p>;
      default:
        return null;
    }
  };

  return (
    <div className="product-card">
      <div className="product-card-header">
        <input
          className='delete-checkbox'
          type="checkbox"
          onChange={(e) => onCheckboxChange(product.id, e.target.checked)}
        />
      </div>
      <h3>{product.sku}</h3>
      <p>{product.name}</p>
      <p>{product.price}</p>
      <p>{product.type}</p>
      {renderAttributes()}
    </div>
  );
};

export default ProductCard;
