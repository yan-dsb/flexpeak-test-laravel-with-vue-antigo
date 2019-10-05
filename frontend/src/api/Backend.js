import axios from 'axios';

const Backend = axios.create({
    baseURL: 'http://localhost:8000/api',
});

export default Backend;