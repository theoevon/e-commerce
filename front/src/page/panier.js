import '../css/panier.css';
import Header from '../component/header.js';
import Footer from '../component/footer.js';
import React, { useState, useEffect } from 'react';
import axios from "axios";

/* function Quantite(e,test) {
    test = e.target.value * test;
    const total = test;
    console.log(total)
} */

const Panier = () => {
    const [articles, setArticles] = useState([]);
    const [test, setTest] = useState(1);

    
    const Quantite = (e,prix_base) => {
        let value = e.target.value * prix_base;
        let id = e.target.id;
        document.getElementById("print_"+id).innerHTML = value;
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
                let items = [];
                const response = await axios(options);
                let value_local = window.localStorage.getItem('article_add');
                let tableau = value_local.split(',');
                console.log(tableau)
                response.data.map((article) => {
                    for (let i = 0; i <= tableau.length; ++i) {
                        if (article.id === Number(tableau[i])) {
                            items.push(article)
                        }
                    }
                })
                setArticles(items);

            }
            catch (error) {
                console.log(error);
            }
        }
        getArticleData();
    }, [test]);

    return (
        <div className='panier'>
            <Header />
            <div className='body_panier'>
                <div className='container'>
                    <div className='container_panier'>
                        <div className='title'>
                            {typeof localStorage["article_add"] === "undefined" ? <h1>Panier vide</h1> : <h1>Votre panier :</h1>}
                        </div>
                        <table>
                            <thead>
                                <tr>
                                    <th></th>
                                    <th><h1>Produits</h1></th>
                                    <th><h1>Prix</h1></th>
                                    <th><h1>Quantité</h1></th>
                                    <th><h1>Prix total</h1></th>
                                </tr>
                            </thead>
                            <tbody>
                                {articles.map((article) => {
                                    let prix_base = article.variant[0].price;
                                    return <tr className='border-top'>
                                        <td><img src={article.variant[0].images[0].uuid} alt="img_article" className='img_panier'></img></td>
                                        <td><h2>{article.name}</h2></td>
                                        <td><h2>{article.variant[0].price}$</h2></td>
                                        <td>
                                            <div className='box'>
                                                <select onChange={(e) => Quantite(e,prix_base)} id={article.id}>
                                                    <option value="1">1</option>
                                                    <option value="2">2</option>
                                                    <option value="3">3</option>
                                                    <option value="4">4</option>
                                                    <option value="5">5</option>
                                                    <option value="6">6</option>
                                                    <option value="7">7</option>
                                                    <option value="8">8</option>
                                                    <option value="9">9</option>
                                                    <option value="10">10</option>
                                                </select>
                                            </div>
                                        </td>
                                        <td><h2 id={"print_"+article.id}>{prix_base}$</h2></td>
                                    </tr>
                                })}
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <Footer />
        </div >
    )
}

export default Panier