import './App.css';
import Header from './header.js';

const IpadMauve = () =>{
    return(
        <div className='app'>
            <Header />
            <div className='en_tete'>
                <h1>IPAD AIR</h1>
                <h1>À PARTIR DE 789 €</h1>
            </div>
            <div className='body_ipad'>
                <div className='left'>
                    <img src="https://cdn.discordapp.com/attachments/973872783320817744/1047511349326000168/ipad-air-select-wifi-purple-202203.png" alt="image_ipad"></img>
                </div>
                <div className='right'>
                    <div className='titre_ipad'>
                        <h1>ACHETER VOTRE IPAD</h1>
                        <h2>COULEUR</h2>
                    </div>
                    <div className='div_couleur'>
                        <div className='couleur'>
                            <a href="/ipad/gris">
                                <div className='rond_gris'></div>
                                <h3>GRIS SIDERALE</h3>
                            </a>
                        </div>
                        <div className='couleur'>
                            <a href="/ipad/bleu">
                                <div className='rond_bleu'></div>
                                <h3>BLEU</h3>
                            </a>
                        </div>
                        <div className='couleur'>
                            <a href="/ipad/rose">
                                <div className='rond_rose'></div>
                                <h3>ROSE</h3>
                            </a>
                        </div>
                        <div className='couleur'>
                            <a href="/ipad/mauve">
                                <div className='rond_mauve'></div>
                                <h3>MAUVE</h3>
                            </a>
                        </div>
                        <div className='couleur'>
                            <a href="/ipad/lumiere">
                                <div className='rond_lumiere'></div>
                                <h3>LUMIÈRE STELLAIRE</h3>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    );
}

export default IpadMauve;