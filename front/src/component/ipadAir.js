import Header from '../header.js';
import React, { useEffect, useState } from 'react'
import axios from "axios";

const Ipad = () => {

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
                    if (article[1].name === 'ipad') {
                        { console.log(article[1]) }
                        return <div>
                            <h1>{article[1].name}</h1>
                            <h1>À PARTIR DE {article[1].prix} €</h1>
                        </div>
                    }
                })}

            </div>
            <div className='body_ipad'>
                <div className='left'>
                    {articles.map((article) => {
                        if (article[1].category === "tablette") {
                            return Object.entries(article[1].variant).map((variant) => {
                                if (variant[0] === color)
                                    return <div>
                                        <img src={variant[1].url} alt="image_ipad" />
                                    </div>
                            })
                        }
                    })}
                </div>
                <div className='right'>
                    <div className='titre_ipad'>
                        <h1>ACHETER VOTRE IPAD</h1>
                        <h2>COULEUR</h2>
                    </div>
                    <div className='div_couleur'>
                        <div className='couleur' onClick={() => setColor('gris')}>
                            <div className='rond_gris'></div>
                            <h3>GRIS SIDERALE</h3>
                        </div>
                        <div className='couleur' onClick={() => setColor('bleu')}>
                            <div className='rond_bleu'></div>
                            <h3>BLEU</h3>
                        </div>
                        <div className='couleur' onClick={() => setColor('rose')}>
                            <div className='rond_rose'></div>
                            <h3>ROSE</h3>
                        </div>
                        <div className='couleur' onClick={() => setColor('violet')}>
                            <div className='rond_mauve'></div>
                            <h3>MAUVE</h3>
                        </div>
                        <div className='couleur' onClick={() => setColor('lumiere_stellaire')}>
                            <div className='rond_lumiere'></div>
                            <h3>LUMIÈRE STELLAIRE</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    );
}

export default Ipad;