import React from 'react';
import { BrowserRouter as Router, Route, Routes } from 'react-router-dom';
import HomePage from './pages/HomePage/HomePage';
import AddProductPage from './pages/AddProductPage/AddProductPage';
import ProductDetails from './components/ProductDetails/ProductDetails';
import './styles/global.css';

const App = () => {
  return (
      <Router>
        <Routes>
          <Route path="/" element={<HomePage />} />
          <Route path="/add-product" element={<AddProductPage />} />
          <Route path="/products/:id" element={<ProductDetails />} />
        </Routes>
      </Router>
  );
};

export default App;
