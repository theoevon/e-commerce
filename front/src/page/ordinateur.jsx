import Header from '../component/header.js';
import Footer from '../component/footer.js';
import React, { useEffect, useState } from 'react'
import axios from "axios";
import { useParams } from 'react-router-dom';
import InputSlider from './sliderBar.js';

const AjouterPanier = (event) => {
    if(typeof localStorage["article_add"] === "undefined"){
        let arr = [];
        arr.push(event.target.id);
        window.localStorage.setItem('article_add', arr);
    }
    else{
        let value_local = window.localStorage.getItem('article_add');
        let tab = value_local.split(',');
        if(tab.includes(event.target.id) === false){
            tab.push(event.target.id);
            window.localStorage.setItem('article_add', tab);
        }
        else{
            alert("L'article est déjà dans votre panier !");
        }
    }
}

const Redirect = (url) => {
    window.location.href = url;
}

const Ordinateur = () => {
    let { category } = useParams();
    const [articles, setArticles] = useState([]);
    const [count, setCount] = useState(0);
    const [indexs, setIndexs] = useState([]);
    const [limit, setLimit] = useState(10);
    const [limitPrice, setLimitPrice] = useState(9001);

    const price = (data) => {
        setLimitPrice(data)
    }

    useEffect(() => {
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
                response.data.filter(article => article.category.name === category && article.variant[0].price <= limitPrice)
                    .map((article) => {
                        return arr.push(article);
                    })
                setArticles(arr);
                setCount(arr.length)
                const rendered = [];
                for (let i = 1; i <= Math.ceil(arr.length / 10); ++i) {
                    rendered.push(i);
                }
                setIndexs(rendered);
            }
            catch (error) {
                console.log(error);
            }
        }
        getArticleData();
    }, [category , limitPrice]);

    return (
        <div className='ordinateur_portable'>
            <Header />
            <div className='container container_ordinateur'>
                <div className='produits_correspondant'>
                    <h1>{count} PRODUITS CORRESPONDANT</h1>
                    <div className='vide'></div>
                </div>
                <div className='container_filtre_article'>
                    <div className=''>
                        <div className='filtre'>
                            <div className='title_filtre'>
                                <br></br><br></br>
                                <h2>FILTRE</h2>
                                <br></br>
                            </div>
                            <div>
                                <p>marque</p>
                                <input type="text" placeholder='SELECTIONNER' />
                            </div>
                            <p>prix</p>
                            <InputSlider price={price} />
                            <div>
                                <p>taille de l'ecran</p>
                                <input type="text" placeholder='SELECTIONNER' />
                            </div>
                            <div>
                                <p>processeur</p>
                                <input type="text" placeholder='SELECTIONNER' />
                            </div>
                            <div>
                                <p>systeme d'exploitation</p>
                                <input type="text" placeholder='SELECTIONNER' />
                            </div>
                            <div>
                                <p>carte graphique</p>
                                <input type="text" placeholder='SELECTIONNER' />
                            </div>
                            <div>
                                <p>memoire</p>
                                <input type="text" placeholder='SELECTIONNER' />
                            </div>
                        </div>
                    </div>
                    <div className="all_article">
                        {articles.map((article) => {
                            if (article.category.name === category) {
                                let url = "/article/" + article.category.name + "/" + article.name
                                return <div className="article">
                                    <div className="img_article">
                                        <img src={article.variant[0].images[0].uuid} alt="img_article" onClick={() => Redirect(url)}></img>
                                    </div>
                                    <div className="row_article">
                                        <div className="text">
                                            <h2>{article.name}</h2>
                                            <span>
                                                {article.description}
                                            </span>
                                            <br></br><br></br>
                                            <p className='prix'>{article.variant[0].price}$</p>
                                            <div className='row'>
                                                <p className='prix' id="savoir_plus" onClick={() => Redirect(url)}>En savoir plus &gt;</p>
                                                <div className='btn_panier'>
                                                    <button className='ajt_panier'  id={article.id} onClick={(e) => AjouterPanier(e)}>AJOUTER AU PANIER</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            }
                        })
                        }
                        <div className='pagination flex center '>
                            {indexs.map((index) => {
                                return <button onClick={(e) => setLimit(e.target.value * 10)} className='cl-blue' value={index} >
                                    {index}
                                </button>
                            })}
                        </div>
                    </div>
                </div>
            </div>
            <Footer />
        </div>
    );
}

export default Ordinateur