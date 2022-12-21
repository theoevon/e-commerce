import Header from '../component/header.js';
import Footer from '../component/footer.js';
import React, { useEffect, useState } from 'react'
import axios from "axios";
import { useParams } from 'react-router-dom'


const Ordinateur = () => {
    const [articles, setArticles] = useState([]);
    let { category } = useParams();

    const [search, setSearch] = useState('');

  const research = (Data) => {
    setSearch(Data)
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
            setArticles(response.data);
          }
          catch (error) {
            console.log(error);
          }
        }
        getArticleData();
      }, []);

    return (
        <div className='ordinateur_portable'>
            <Header />
            <h1>PRODUIS CORRESPONDENT</h1>
            <div className='container'>
                <div className='filtre'>
                    <div className='container_filtre'>
                        <div className='flex center'>
                            <h2>FILTRE</h2>
                        </div>
                        <p>marque</p>
                        <p>prix</p>
                        <div className='flex center'>
                            <div>min
                                <p>30</p>
                            </div>
                            <div>max
                                <p>3000</p>
                            </div>
                        </div>
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
                <div className='all_article'>
                    {articles.map((article) => {

                        if (article.category.name === category) {
                            let url = "/article/" + article.category.name + "/" + article.name
                            return <div className="article">
                                <div>
                                    <h2>{article.name}</h2>
                                    <a href={url}>
                                        <p className='cl-blue'>DÉCOUVRIR &gt;</p>
                                    </a>
                                    <div className="article_container">
                                        <div className="img_article ">
                                            <img src={article.variant[0].images[0].uuid} alt="img_article"></img>
                                        </div>
                                        <div className='article_description'>
                                            <span className='mg-left-2'>
                                                {article.description}
                                            </span>
                                        </div>
                                        <div className='article_prix'>
                                            <p className='cl-blue font-size-2'>{article.variant[0].price}$</p>
                                            <button className='btn_ajouter_panier'>Ajouter au panier</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        }

                    })
                    }
                </div>
            </div>
            <Footer />
        </div>
    );
}

export default Ordinateur