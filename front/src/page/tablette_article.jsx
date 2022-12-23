import Header from '../component/header.js';
import Footer from '../component/footer.js';
import React, { useEffect, useState } from 'react'
import axios from "axios";
import { useParams } from 'react-router-dom'

const Tablette = () => {

    let { name } = useParams();

    const [articles, setArticles] = useState([]);
    const [color, setColor] = useState('gris');

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
                setArticles(response.data);
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

            {articles.filter(article => article.name === name).map((article) => {
                return <div key={article.name}>
                    <div className='en_tete'>
                        <h2>{article.name}</h2>
                        <h2>À PARTIR DE {article.variant[0].price} €</h2>
                    </div>
                    <div className='flex'>
                        <div className='left'>
                            {article.variant.length === 1 ?
                                (<div>
                                    <img src={article.variant[0].images[0].uuid} alt="tablette" />
                                </div>)
                                : (<div>
                                    {article.variant.filter(variant => variant.color === color).map((variant) => {
                                        return <div>
                                            <img src={variant.images[0].uuid} alt="tablette" />
                                        </div>
                                    })}
                                </div>)}
                        </div>
                        <div className='right'>
                            <div className='div_couleur'>
                                {article.variant.map((variant) => {
                                    return <div className='couleur' onClick={() => setColor(variant.color)}>
                                        <div className={"rond_" + variant.color}></div>
                                        <h3>{variant.color}</h3>
                                    </div>
                                })}
                            </div>
                        </div>
                    </div>
                </div>
            })}
            <Footer />
        </div>
    );
}

export default Tablette;