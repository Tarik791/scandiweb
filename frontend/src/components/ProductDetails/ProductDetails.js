import React from 'react';
import { useProduct } from '../../hooks/useProduct';

const ProductDetails = ({ match }) => {
  const { id } = match.params;
  const { product, loading, error } = useProduct(id);

  if (loading) return <p>Loading...</p>;
  if (error) return <p>Error loading product</p>;

  return (
    <div className="product-details">
      <h1>{product.name}</h1>
      <p>{product.description}</p>
      <p>Price: ${product.price}</p>
    </div>
  );
};

export default ProductDetails;
