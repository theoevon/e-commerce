import React , {useEffect, useState} from 'react'
import axios from "axios";

const Test = () => {

    const [articles, setArticles] = useState([]);
    useEffect(() => {

        async function getArticleData() {
            try {
                const response = await axios.get("https://localhost:8000/showArticle");
                const data = Object.entries(response.data)
                setArticles(data);
                console.log(data);
            }
            catch (error) {
                console.log(error);
            }
        }

        getArticleData();
    }, []);

    return(
        <div>
            {articles.map((article) => {
                return <div>
                <p>{article[1].name}</p>
                <img src={article[1].image_url} alt="" />
                </div>
            })}
        </div>
    )
}

export default Test