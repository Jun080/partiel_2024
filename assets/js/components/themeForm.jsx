import React, { useState } from 'react';

const ThemeForm = () => {
    const [theme, setTheme] = useState('');
    const [nombrePlaces, setNombrePlaces] = useState('');
    const [status, setStatus] = useState('');

    const handleSubmit = (e) => {
        e.preventDefault();
        console.log('Formulaire soumis :', theme, nombrePlaces, status);
        setTheme('');
        setNombrePlaces('');
        setStatus('');
    };

    return (
        <form onSubmit={handleSubmit}>
            <div>
                <label>Thème :</label>
                <input type="text" value={theme} onChange={(e) => setTheme(e.target.value)} />
            </div>
            <div>
                <label>Nombre de places :</label>
                <input type="number" value={nombrePlaces} onChange={(e) => setNombrePlaces(e.target.value)} />
            </div>
            <div>
                <label>Status :</label>
                <input type="text" value={status} onChange={(e) => setStatus(e.target.value)} />
            </div>
            <button type="submit">Soumettre</button>
        </form>
    );
};


export default ThemeForm;
