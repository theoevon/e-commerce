import axios from "axios";
import React, { useEffect, useState } from 'react'
// axios.defaults.headers.common['Accept'] = 'application/json';
// axios.defaults.headers.put['Content-Type'] = 'application/json';
// axios.defaults.headers.get['Content-Type'] = 'application/json';
// axios.defaults.headers.post['Content-Type'] = 'application/json';
// axios.defaults.headers.delete['Content-Type'] = 'application/json';
// Vue.prototype.$http = axios;

const Test = () => {
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
                // const data = Object.entries(response.data)
                // setArticles(data);
            }
            catch (error) {
                console.log(error);
            }
        }

        getArticleData();
    }, []);

    return (
        <div>
            coucou
        </div>
    )

}

export default Test