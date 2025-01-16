import React from 'react';
import ReactDOM from 'react-dom/client';
import '../css/app.css';
import '../css/my_custom.css'
import App from './App';

const root  = ReactDOM.createRoot(document.getElementById('root'));
root.render(
    <React.StrictMode>
        <App />
    </React.StrictMode>
);