import './App.css';

const Ipad = () =>{
    return(
        <div className='app'>
            <header>
            <div className="container">
                <div className="row">
                <a href="/">
                    <img src="https://cdn.discordapp.com/attachments/973872783320817744/1047108942397976636/image-removebg-preview.png" id="logo" alt="logo"></img>
                </a>
                <input type="text" placeholder="Recherche..." name="search" id="search"></input>
                <div className="profil row">
                    <a href="/connexion">
                    <div className="account">
                        <img src="https://cdn-icons-png.flaticon.com/512/5989/5989226.png" id="icon_account" alt="icon_account"></img>
                        <p className="info_icon">Mon compte</p>
                    </div>
                    </a>
                    <a href="/panier">
                    <div className="panier">
                        <img src="https://cdn-icons-png.flaticon.com/512/481/481383.png" id="icon_panier" alt="icon_panier"></img>
                        <p className="info_icon">Panier</p>
                    </div>
                    </a>
                </div>
                </div>
            </div>
            <div className="navbar">
            <nav></nav>
            </div>
            </header>
            <div className='en_tete'>
                <h1>IPAD AIR</h1>
                <h1>À PARTIR DE 789 €</h1>
            </div>
            <div className='body_ipad'>
                <div className='left'>
                    <img src="https://cdn.discordapp.com/attachments/973872783320817744/1047511305688457236/ipad-air-select-wifi-spacegray-202203.png" alt="image_ipad"></img>
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

export default Ipad;