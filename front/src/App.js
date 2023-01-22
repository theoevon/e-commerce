import './css/App.css';
import './css/dropDawn.css';
import './css/ordinateur.css';
import './css/shanyBootstrap.css';
import './css/ordinateur_article.css';
import { BrowserRouter as Router,Routes, Route } from 'react-router-dom';
import Accueil from './page/accueil.js';
import Connexion from './page/connexion.js';
import Inscription from './page/inscription.js';
import Ordinateur from './page/ordinateur.jsx';
import ShowArticle from './page/showArticle';
import PcPortable from './page/ordinateur_article';
import Panier from './page/panier.js';

function App() {
  return (
    <Router>
      <Routes>
        <Route exact path='/' element={< Accueil />}></Route>
        <Route path='/article/:category/:id' element={< ShowArticle />}></Route>
        <Route path='/article/:category' element={< Ordinateur />}></Route>
        <Route exact path='/connexion' element={<Connexion />}></Route>
        <Route exact path='/inscription' element={<Inscription />}></Route>
        <Route exact path='/pc_portable' element={<PcPortable />}></Route>
        <Route exact path='/panier' element={<Panier />}></Route>
      </Routes>
    </Router>
  );
}

export default App;
