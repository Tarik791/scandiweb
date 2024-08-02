import api from './api';

export const fetchProducts = async () => {
    const response = await api.get('/products');
    return response.data;
};

export const addProduct = async (product) => {
    const response = await api.post('/products', product);
    return response.data;
};

export const fetchProductById = async (id) => {
    const response = await api.get(`/products/${id}`);
    return response.data;
};

export const deleteProducts = async (ids) => {
    const response = await api.delete('/products', { data: { ids } });
    return response.data;
};