import React, { useState } from 'react';
import { useProducts } from '../../hooks/useProduct';
import ProductList from '../../components/ProductList/ProductList';
import { deleteProducts, fetchProducts } from '../../services/productService';
import { Link } from 'react-router-dom';

const HomePage = () => {
    const { products, loading, error, setProducts } = useProducts();
    const [selectedProducts, setSelectedProducts] = useState([]);

    if (loading) return <p>Loading...</p>;
    if (error) return <p>Error loading products</p>;

    const handleCheckboxChange = (productId, isChecked) => {
        setSelectedProducts(prevSelectedProducts =>
            isChecked
                ? [...prevSelectedProducts, productId]
                : prevSelectedProducts.filter(id => id !== productId)
        );
    };

    const handleMassDelete = async () => {
        if (selectedProducts.length === 0) {
            return;
        }

        try {
            const response = await deleteProducts(selectedProducts);
            console.log(response.data);
            setSelectedProducts([]);

            const fetchedProducts = await fetchProducts();
            setProducts(fetchedProducts);
        } catch (error) {
            console.error('Error deleting products:', error);
        }
    };

    return (
        <div className="home-page">
            <div className='header'>
                <Link to="/"><h1>Product List</h1></Link>
                <div className='form-buttons'>
                    <Link to="/add-product"><button>ADD</button></Link>
                    {handleMassDelete && (
                        <button onClick={handleMassDelete}>MASS DELETE</button>
                    )}
                </div>
            </div>
            <div className="divider"></div>
            <ProductList products={products} onCheckboxChange={handleCheckboxChange} />
        </div>
    );
};

export default HomePage;
