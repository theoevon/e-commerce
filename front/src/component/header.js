import Cookies from 'universal-cookie';
import { Link } from 'react-router-dom';
import { useState } from 'react';
import axios from "axios";


const Header = ({ research }) => {
    let cookies = new Cookies();
    const [articles, setArticles] = useState([]);
    const [display, setDisplay] = useState('none');
    const [articleSearch, setArticleSearch] = useState('');

    const suggestion = (data) => {
        if (data !== "") {
            async function getArticleData() {
                try {
                    const options = {
                        url: 'https://localhost:8000/api/articles',
                        method: 'GET',
                        headers: {
                            'Accept': 'application/json',
                            'Content-Type': 'application/json;charset=UTF-8'
                        }
                    }
                    const response = await axios(options);
                    let arr = [];
                    response.data.map((article) => {
                        if (article.name.indexOf(data) !== -1) {
                            arr.push(article);
                        }
                    })
                    setArticles(arr);
                }
                catch (error) {
                    console.log(error);
                }
                setDisplay('block');
            }
            getArticleData();
        }
        else {
            setDisplay('none');
        }

    }

    return (
        <header>
            <div className="container">
                <div className="row">
                    <a href="/">
                        <img src="https://cdn.discordapp.com/attachments/973872783320817744/1047108942397976636/image-removebg-preview.png" id="logo" alt="logo"></img>
                    </a>
                    <form action="" className="dropdown" autocomplete="off">
                        <input autocomplete="off" onChange={(e) => suggestion(e.target.value)} type="text" placeholder="Recherche..." name="name" id="search"></input>
                        <div className='dropdown-content' style={{ 'display': display }}>
                            {articles.slice(0, 10).map((article) => {
                                return <div className='itemsDropDawn'>
                                    {article.name}
                                </div>
                            })}
                        </div>
                    </form>
                    <div className="profil row">
                        <a href='/connexion'>
                            <div className="account">
                                <img src="https://cdn-icons-png.flaticon.com/512/5989/5989226.png" id="icon_account" alt="icon_account"></img>
                                <p className="info_icon">Mon compte</p></div></a>)
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