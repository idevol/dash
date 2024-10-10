import React, { useEffect } from 'react';
import {
  Routes,
  Route,
  useLocation
} from 'react-router-dom';

import './css/style.css';

import './charts/ChartjsConfig';

// Import pages
import Dashboard from './pages/Dashboard';
import Login from './pages/Login';

function App() {

  const location = useLocation();

  useEffect(() => {
    document.documentElement.style.scrollBehavior = 'auto';
    window.scroll({ top: 0 });
    (document.documentElement.style as CSSStyleDeclaration).scrollBehavior = '';
  }, [location.pathname]); // triggered on route change

  return (
    <>
      <Routes>
        <Route path="/" element={<Login />} />
        <Route path="/dash" element={<Dashboard />} />
      </Routes>
    </>
  );
}

export default App;
