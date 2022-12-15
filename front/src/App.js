import './css/App.css';
import { BrowserRouter as Router,Routes, Route } from 'react-router-dom';
import Accueil from './page/accueil.js';
import Tablette_article from './page/tablette_article.js';
import Connexion from './page/connexion.js';
import Inscription from './page/inscription.js';
import User from './Admin.js';
import Ordinateur_Portable from './page/ordinateur_portable.jsx';
import Tablette from './page/tablette.jsx';
import Ordinateur_portable_article from './page/ordinateur_portable_article';

function App(){
  return (
    <Router>
      <Routes>
        <Route exact path='/' element={< Accueil />}></Route>
        <Route path='/tablette/:name' element={< Tablette_article />}></Route>
        <Route path='/tablette' element={< Tablette />}></Route>
        <Route path='/ordinateur portable' element={< Ordinateur_Portable />}></Route>
        <Route path='/ordinateur portable/:name' element={< Ordinateur_portable_article />}></Route>
        <Route exact path='/connexion' element={<Connexion/>}></Route>
        <Route exact path='/inscription' element={<Inscription/>}></Route>
        <Route exact path='/admin/*' element={<User/>}></Route>
      </Routes>
    </Router>
  );
}

export default App;
