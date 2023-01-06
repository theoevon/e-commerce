import { useState } from 'react';
import axios from "axios";

function Search() {

  const [display, setDisplay] = useState('none');
  const [articles, setArticles] = useState([]);

  const research = (data) => {
    if (data === "") {
      setDisplay('none')
      return;
    }
    async function getArticleData() {
      try {
        const options = {
          url: 'http://localhost:8000/api/articles',
          method: 'GET',
          headers: {
            'Accept': 'application/json',
            'Content-Type': 'application/json;charset=UTF-8'
          }
        }
        const response = await axios(options);
        let arr = [];
        response.data.filter(article => article.name.indexOf(data) !== -1)
          .map((article) => {
            return arr.push(article)
          })
        setArticles(arr);
        setDisplay('block')
      }
      catch (error) {
        console.log(error);
      }
    }
    getArticleData();
  }

  return (
    <form action="" class="dropdown">
      <input onChange={(e) => research(e.target.value)} type="text" className='search' placeholder='search' />
      <div style={{ 'display': display }} class="dropdown-content">
        {articles.map((article) => {
          let url = "/article/" + article.category.name + "/" + article.name
          return <a href={url} className='flex'>
            <p>{article.name}</p>
            <img src={article.variant[0].images[0].uuid} alt="article" />
          </a>
        })}
      </div>
    </form>
  );
}

export default Search