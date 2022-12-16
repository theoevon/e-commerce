import './css/App.css';
import { BrowserRouter as Router,Routes, Route } from 'react-router-dom';
import Accueil from './page/accueil.js';
import Connexion from './page/connexion.js';
import Inscription from './page/inscription.js';
import User from './Admin.js';
import Ordinateur from './page/ordinateur.jsx';
import ShowArticle from './page/showArticle';
import Test from './page/test.jsx'

function App(){
  return (
    <Router>
      <Routes>
        <Route exact path='/' element={< Accueil />}></Route>
        <Route path='/article/:category/:name' element={< ShowArticle />}></Route>
        <Route path='/article/:category' element={< Ordinateur />}></Route>
        <Route exact path='/connexion' element={<Connexion/>}></Route>
        <Route exact path='/inscription' element={<Inscription/>}></Route>
        <Route exact path='/admin/*' element={<User/>}></Route>
        <Route exact path='/test' element={<Test/>}></Route>
      </Routes>
    </Router>
  );
}

export default App;
