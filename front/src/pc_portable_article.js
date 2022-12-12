import React, { useEffect, useState } from 'react'
import axios from "axios";

const PcPortableArticle = () => {

    const [articles, setArticles] = useState([]);
    useEffect(() => {

        async function getArticleData() {
            try {
                const response = await axios.get("http://localhost:8000/showArticle");
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

    articles.forEach(onlyPcPortable);

    function onlyPcPortable(item, index){
        if(item[1].category === "ordinateur portable"){
            return(
                <div>
                    <p>{item[1].name}</p>
                    {/* <img src={item[1].image_url} alt=""></img> */}
                </div>
            )
        }
    }

    return (
       <onlyPcPortable />
    )
}

export default PcPortableArticle;