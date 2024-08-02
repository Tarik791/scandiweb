import React, { useState } from 'react';
import { addProduct } from '../../services/productService';
import './AddProductPage.css'; 
import { Link, useNavigate } from 'react-router-dom';

const AddProductPage = () => {
    const [product, setProduct] = useState({ sku: '', name: '', price: '', productType: '', size: '', weight: '', height: '', width: '', length: '' });
    const [errors, setErrors] = useState({});
    const [description, setDescription] = useState('');
    const navigate = useNavigate();

    const handleChange = (e) => {
        setProduct({ ...product, [e.target.name]: e.target.value });
    };

    const handleSubmit = async (e) => {
        e.preventDefault();
        setErrors({});

        try {
            const response = await addProduct(product);
            if (response.errors) {
                setErrors(response.errors);
            } else {
                setProduct({ sku: '', name: '', price: '', productType: '', size: '', weight: '', height: '', width: '', length: '' });
                navigate('/');
            }
        } catch (err) {
            setErrors({ global: 'Error adding product' });
        }
    };

    const handleProductTypeChange = (e) => {
        const selectedType = e.target.value;
        setProduct({ ...product, productType: selectedType });

        switch (selectedType) {
            case 'DVD':
                setDescription('Please, provide size');
                break;
            case 'Book':
                setDescription('Please, provide weight');
                break;
            case 'Furniture':
                setDescription('Please, provide dimensions (Height, Width, Length)');
                break;
            default:
                setDescription('');
                break;
        }
    };

    const renderProductSpecificFields = () => {
        switch (product.productType) {
            case 'DVD':
                return (
                    <div className="form-group">
                        <label htmlFor="size">Size (MB)</label>
                        <input type="number" name="size" id="size" value={product.size} onChange={handleChange} placeholder="Size" />
                        {errors.size && <p className="error">{errors.size}</p>}
                    </div>
                );
            case 'Book':
                return (
                    <div className="form-group">
                        <label htmlFor="weight">Weight (KG)</label>
                        <input type="number" name="weight" id="weight" value={product.weight} onChange={handleChange} placeholder="Weight" />
                        {errors.weight && <p className="error">{errors.weight}</p>}
                    </div>
                );
            case 'Furniture':
                return (
                    <div className="form-group">
                        <label htmlFor="height">Height (CM)</label>
                        <input type="number" name="height" id="height" value={product.height} onChange={handleChange} placeholder="Height" />
                        {errors.height && <p className="error">{errors.height}</p>}
                        <label htmlFor="width">Width (CM)</label>
                        <input type="number" name="width" id="width" value={product.width} onChange={handleChange} placeholder="Width" />
                        {errors.width && <p className="error">{errors.width}</p>}
                        <label htmlFor="length">Length (CM)</label>
                        <input type="number" name="length" id="length" value={product.length} onChange={handleChange} placeholder="Length" />
                        {errors.length && <p className="error">{errors.length}</p>}
                    </div>
                );
            default:
                return null;
        }
    };

    return (
        <div className="add-product-page">
            <form id="product_form" onSubmit={handleSubmit} className="product-form">
                <div className='header'>
                    <Link to="/add-product"><h1>Product Add</h1></Link>
                    <div className="form-buttons">
                        <button type="submit">Save</button>
                        <button type="button" onClick={() => window.location.href = '/'} >Cancel</button>
                    </div>
                </div>
                <hr className="full-width-line" />
                {errors.global && <p className="error global-error">{errors.global}</p>}
                <div className="form-group">
                    <label htmlFor="sku">SKU</label>
                    <input type="text" name="sku" id="sku" value={product.sku} onChange={handleChange} placeholder="SKU" />
                    {errors.sku && <p className="error">{errors.sku}</p>}
                </div>
                <div className="form-group">
                    <label htmlFor="name">Name</label>
                    <input type="text" name="name" id="name" value={product.name} onChange={handleChange} placeholder="Name" />
                    {errors.name && <p className="error">{errors.name}</p>}
                </div>
                <div className="form-group">
                    <label htmlFor="price">Price</label>
                    <input type="number" name="price" id="price" value={product.price} onChange={handleChange} placeholder="Price" />
                    {errors.price && <p className="error">{errors.price}</p>}
                </div>
                <div className="form-group">
                    <label htmlFor="productType">Product Type</label>
                    <select name="productType" id="productType" value={product.productType} onChange={handleProductTypeChange}>
                        <option value="">Select Type</option>
                        <option value="DVD">DVD</option>
                        <option value="Book">Book</option>
                        <option value="Furniture">Furniture</option>
                    </select>
                </div>
                {description && <p className="description">{description}</p>}
                {renderProductSpecificFields()}
            </form>
        </div>
    );
};

export default AddProductPage;
