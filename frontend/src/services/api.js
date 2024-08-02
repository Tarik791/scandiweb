import axios from 'axios';

const baseURL =
  window.location.hostname === 'localhost'
    ? 'http://localhost:8000/'
    : 'https://api.tarikcruddev.tech/';

const api = axios.create({
  baseURL: baseURL,
  headers: {
    'Content-Type': 'application/json',
  },
});

export default api;
