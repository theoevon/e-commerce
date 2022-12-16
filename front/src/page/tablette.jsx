import Header from '../component/header.js';
import Footer from '../component/footer.js';
import React, { useEffect, useState } from 'react'
import axios from "axios";

const Tablette = () => {

    const [articles, setArticles] = useState([]);
    const [category, setCategory] = useState(null);

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
        <div className='tablette'>
            <Header />
            <div className='body_article'>
                <div className="container">
                    <div className="container_article">
                        <h1>NOS TABLETTES</h1>
                        <div className="all_article">
                            {articles.map((article) => {
                                if (article.category.name === 'tablette') {
                                    let url = "/article/" + article.category.name + "/" + article.name
                                    return <div className="article">
                                        <div className="row_article">
                                            <div className="text">
                                                <h2>{article.name}</h2>
                                                <a href={url}>
                                                    <p>DÉCOUVRIR &gt;</p>
                                                </a>
                                                <span className='mg-left-12'>
                                                    {article.description}
                                                </span>
                                                <button className='btn_ajouter_panier'>Ajouter au panier</button>
                                            </div>
                                            <div className="img_article">
                                                <img src={article.variant[0].images.uuid} alt="img_article"></img>
                                            </div>
                                        </div>
                                    </div>
                                }
                            })
                            }
                        </div>
                    </div>
                </div>
            </div>
            <Footer />
        </div>
    );
}

export default Tablette;