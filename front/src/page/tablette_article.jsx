import Header from '../component/header.js';
import Footer from '../component/footer.js';
import React, { useEffect, useState } from 'react'
import axios from "axios";
import { useParams } from 'react-router-dom'

const Tablette = () => {

    let { category } = useParams();
    let { name } = useParams();

    const [articles, setArticles] = useState([]);
    const [color, setColor] = useState('gris');
    useEffect(() => {

        async function getArticleData() {
            try {
                const response = await axios.get("https://localhost:8000/showArticle");
                const data = Object.entries(response.data)

                setArticles(data);
            }
            catch (error) {
                console.log(error);
            }
        }
        getArticleData();
    }, []);

    return (
        <div className='app'>
            <Header />
            <div className='en_tete'>
                {articles.map((article) => {
                    if (article[1].name === name) {
                        return <div>
                            <h1>{article[1].name}</h1>
                            <h1>À PARTIR DE {article[1].prix} €</h1>
                        </div>
                    }
                })}
            </div>
            <div className='flex'>
                <div className='left'>
                    {articles.map((article) => {
                        if (article[1].name === name) {
                            if (Object.entries(article[1].variant).length == 1) {
                                return Object.entries(article[1].variant).map((variant) => {
                                        return <div>
                                            <img src={variant[1].url} alt="image_ipad" />
                                        </div>
                                })
                            }
                            else {
                                return Object.entries(article[1].variant).map((variant) => {
                                    if (variant[0] === color) {
                                        return <div>
                                            <img src={variant[1].url} alt="image_ipad" />
                                        </div>
                                    }
                                })
                            }
                        }
                    })}
                </div>
                <div className='right'>
                    <div className='titre_ipad'>
                        <h1>ACHETER VOTRE {category}</h1>
                        <h2>COULEUR</h2>
                    </div>
                    {articles.map((article) => {
                        if (article[1].name === name) {
                            return Object.entries(article[1].variant).map((variant) => {
                                let colore = "rond_" + variant[0]
                                return <div className='div_couleur'>
                                    <div className='couleur' onClick={() => setColor(variant[0])}>
                                        <div className={colore}></div>
                                        <h3>{variant[0]}</h3>
                                    </div>
                                </div>
                            })
                        }
                    })}
                </div>
            </div>
            <Footer />
        </div>
    );
}

export default Tablette;