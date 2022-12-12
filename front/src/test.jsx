import React, { useEffect, useState } from 'react'
import axios from "axios";

const Test = () => {

    const [articles, setArticles] = useState([]);
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
        <div>
            <p>coucou</p>
            {articles.map((article) => {
                return <div>
                    {Object.entries(article[1].variant).map((data) => {
                        return <div>
                            <img src={data[1].url} alt="" />
                            <p>{data[0]}</p>
                        </div>

                    })}

                </div>
            })}
        </div>
    )
}

export default Test