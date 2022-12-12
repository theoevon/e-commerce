import './App.css';
import { BrowserRouter as Router,Routes, Route } from 'react-router-dom';
import Accueil from './accueil.js';
import Ipad from './ipadAir.js';
import IpadGris from './ipadAirGris.js';
import IpadRose from './ipadAirRose.js';
import IpadBleu from './ipadAirBleu.js';
import IpadMauve from './ipadAirMauve.js';
import IpadLumiere from './ipadAirLumiere.js';
import Connexion from './connexion.js';
import Inscription from './inscription.js';
import User from './Admin.js';
import Pc_portable from './Pc_portable.js';

function App(){
  return (
    <Router>
      <Routes>
        <Route exact path='/' element={< Accueil />}></Route>
        <Route exact path='/ipad' element={< Ipad />}></Route>
        <Route exact path='/ipad/gris' element={< IpadGris />}></Route>
        <Route exact path='/ipad/rose' element={< IpadRose />}></Route>
        <Route exact path='/ipad/bleu' element={< IpadBleu />}></Route>
        <Route exact path='/ipad/mauve' element={< IpadMauve />}></Route>
        <Route exact path='/ipad/lumiere' element={< IpadLumiere />}></Route>
        <Route exact path='/connexion' element={<Connexion/>}></Route>
        <Route exact path='/inscription' element={<Inscription/>}></Route>
        <Route exact path='/admin/*' element={<User/>}></Route>
        <Route exact path='/PC_portable' element={<Pc_portable/>}></Route>
      </Routes>
    </Router>
  );
}

export default App;
