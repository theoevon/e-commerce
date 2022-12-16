import '../css/App.css';
import Header from '../component/header.js';
import Footer from '../component/footer.js';
import React, { useEffect, useState } from 'react'
import axios from "axios";

const Accueil = () => {

  const [articles, setArticles] = useState([]);

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
      <div className='body_article'>
        <div className="container">
          <div className="container_article">
            <h1>NOS PRODUITS</h1>
            <div className="all_article">
              {articles.map((article) => {
                let url = "/article/" + article.category.name + "/" + article.name
                return <a href={url}>
                  <div className="article">
                    <div className="row_article">
                      <div className="text">
                        <h2>{article.name}</h2>
                        <p>DÉCOUVRIR &gt;</p>
                        <span>
                        {article.description}
                        </span>
                        <p>{article.prix}$</p>
                      </div>
                      <div className="img_article">
                        <img src={article.variant[0].images[0].uuid} alt="img_article"></img>
                      </div>
                    </div>
                  </div>
                </a>
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

export default Accueil;