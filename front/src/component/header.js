import Cookies from 'universal-cookie';
import { Link } from 'react-router-dom';
import { useEffect, useState } from 'react';

const Header = () => {
    let cookies = new Cookies();
    return (
        <header>
            <div className="container">
                <div className="row">
                    <a href="/">
                        <img src="https://cdn.discordapp.com/attachments/973872783320817744/1047108942397976636/image-removebg-preview.png" id="logo" alt="logo"></img>
                    </a>
                    <input type="text" placeholder="Recherche..." name="search" id="search"></input>
                    <div className="profil row">
                        {cookies.get('user_name') !== 'undefind' ? (<a href='/'>
                                <div className="account">
                                    <img src="https://cdn-icons-png.flaticon.com/512/5989/5989226.png" id="icon_account" alt="icon_account"></img>
                                    <p className="info_icon">Mon compte</p>
                                </div>
                            </a>)
                            :
                            (<a href='/connexion'>
                                <div className="account">
                                    <img src="https://cdn-icons-png.flaticon.com/512/5989/5989226.png" id="icon_account" alt="icon_account"></img>
                                    <p className="info_icon">Mon compte</p>
                                </div>
                            </a>)}
                        <a href="/panier">
                            <div className="panier">
                                <img src="https://cdn-icons-png.flaticon.com/512/481/481383.png" id="icon_panier" alt="icon_panier"></img>
                                <p className="info_icon">Panier</p>
                            </div>
                        </a>
                        {cookies.get('user_name') !== 'undefind' ? (<p>{cookies.get("user_name")}</p>) : null}
                    </div>
                </div>
            </div>
            <div className="navbar">
                <nav>
                    <div className='liste'>
                        <Link to={{ pathname: "/article/ordinateur portable" }} className='info_liste'>Ordinateur portable</Link>
                        <Link to={{ pathname: "/article/ordinateur fixe" }} className='info_liste'>Ordinateur </Link>
                        <Link to={{ pathname: "/article/composant" }} className='info_liste'>Composant</Link>
                        <Link to={{ pathname: "/article/tablette", state: { fromDashboard: true } }} className='info_liste'>Tablette</Link>
                    </div>
                </nav>
            </div>
        </header>
    )
}

export default Header;