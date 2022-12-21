import '../css/App.css';
import Header from '../component/header.js';
import Footer from '../component/footer.js';
import React, { useEffect, useState } from 'react'
import axios from "axios";

const Accueil = () => {

  const [articles, setArticles] = useState([]);
  const [search, setSearch] = useState('');
  const [indexs, setIndexs] = useState([]);
  const [limit, setLimit] = useState(10);

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
        const rendered = [];
        for (let i = 1; i <= Math.ceil(response.data.length / 10); ++i) {
          rendered.push(i);
        }
        setIndexs(rendered);
      }
      catch (error) {
        console.log(error);
      }
    }
    getArticleData();
  }, []);

  return (
    <div className='app'>
      <Header research={research} />
      <div className='body_article'>
        <div className="container">
          <div className="container_article">
            <h1>NOS PRODUITS</h1>
            <div className="all_article">
              {articles.slice(limit - 10, limit).map((article) => {
                if (article.name.indexOf(search) !== -1) {
                  let url = "/article/" + article.category.name + "/" + article.name
                  return <a href={url}>
                    <div className="article">
                      <div className="img_article">
                        <img src={article.variant[0].images[0].uuid} alt="img_article"></img>
                      </div>
                      <div className="row_article">
                        <div className="text">
                          <h2>{article.name}</h2>
                          <span>
                            {article.description}
                          </span>
                          <p>{article.variant[0].price}$</p>
                          <br></br><br></br><br></br>
                          <p>DÉCOUVRIR &gt;</p>
                        </div>
                      </div>
                    </div>
                  </a>
                }
              })
              }
            </div>
          </div>
        </div>
        <div className='pagination flex center '>
          {indexs.map((index) => {
            return <button onClick={(e) => setLimit(e.target.value * 10)} className='cl-blue' value={index} >
              {index}
            </button>
          })}
        </div>
      </div>
      <Footer />
    </div>
  );
}

export default Accueil;