import './App.css';

const Header = () => {
    return (
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
                <nav>
                    <div className='liste'>
                        <a className='info_liste' href='pc_portable'>Pc portable </a>
                        <a className='info_liste' href=''>Ordinateur </a>
                        <a className='info_liste' href=''>Carte grapique</a>
                        <a className='info_liste' href='ipad'>Ipad</a>
                    </div>
                </nav>
            </div>
        </header>
    )
}

export default Header;