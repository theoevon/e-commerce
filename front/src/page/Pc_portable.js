import Header from '../component/header.js';
import Footer from '../component/footer.js';
import React, { useEffect, useState } from 'react'
import axios from "axios";

const Ordinateur_portable = () => {

  const [articles, setArticles] = useState([]);
  const [category, setCategory] = useState(null);

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
      <div className='body_article'>
        <div className="container">
          <div className="container_article">
            <h1>NOS ORDINATEURS PORTABLES</h1>
            <div className="all_article">
              {articles.map((article) => {
                if (article[1].category === 'ordinateur portable') {
                  let url = article[1].category + "/" + article[1].name
                  return <div className="article">
                    <div className="row_article">
                      <div >
                        <h2>{article[1].name}</h2>
                        <a href={url}>
                          <p>DÉCOUVRIR &gt;</p>
                        </a>
                        <div className="article_container">
                          <div className="img_article ">
                            <img src={Object.entries(article[1].variant)[0][1].url} alt="img_article"></img>
                          </div>
                          <div className='article_description'>
                            <span>
                              {article[1].description}
                            </span>
                          </div>
                          <div className='article_info'>
                            <p>{article[1].prix}$</p>
                            <button className='btn_ajouter_panier'>Ajouter au panier</button>
                          </div>
                        </div>
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

export default Ordinateur_portable;