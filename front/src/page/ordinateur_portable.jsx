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
    <div className='ordinateur_portable'>
      <Header />
      <h1> PRODUIS CORRESPONDENT</h1>
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
              <input type="text" placeholder='SELECTIONNER'/>
            </div>
            <div>
              <p>processeur</p>
              <input type="text" placeholder='SELECTIONNER'/>
            </div>
            <div>
              <p>systeme d'exploitation</p>
              <input type="text" placeholder='SELECTIONNER'/>
            </div>
            <div>
              <p>carte graphique</p>
              <input type="text" placeholder='SELECTIONNER'/>
            </div>
            <div>
              <p>memoire</p>
              <input type="text" placeholder='SELECTIONNER'/>
            </div>
          </div>
        </div>
        <div className='all_article'>
          {articles.map((article) => {
            if (article[1].category === 'ordinateur portable') {
              let url = article[1].category + "/" + article[1].name
              return <div className="article">
                <div>
                  <h2>{article[1].name}</h2>
                  <a href={url}>
                    <p className='cl-blue'>DÉCOUVRIR &gt;</p>
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
                    <div className='article_prix'>
                      <p className='cl-blue font-size-2'>{article[1].prix}$</p>
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

export default Ordinateur_portable;