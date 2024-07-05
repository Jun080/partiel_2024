import './styles/app.css';

// assets/js/App.js
import React from 'react';
import { createRoot } from 'react-dom/client';
import {BrowserRouter, Route, Routes} from 'react-router-dom';
import ThemeForm from '../assets/js/components/themeForm';

const container = document.getElementById('root');
const root = createRoot(container);

class App extends React.Component {
    render() {
        return (
            <BrowserRouter>
                <Routes>
                    <Route path="/theme" element={<ThemeForm />} />
                </Routes>
            </BrowserRouter>
        );
    }
}

root.render(<App />);

export default App;
