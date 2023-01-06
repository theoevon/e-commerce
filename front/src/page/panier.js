import '../css/panier.css';
import Header from '../component/header.js';
import Footer from '../component/footer.js';
import React, { useState, useEffect } from 'react';
import axios from "axios";

const Panier = () => {
    const [articles, setArticles] = useState([]);
    let prix_ttc = 0;

    const Quantite = (e, prix_base, prix_ttc) => {
        let value = e.target.value * prix_base;
        let rounded = Math.round(value * 100) / 100;
        let id = e.target.id;
        //let total_ttc = document.getElementById("prix_ttc").innerHTML;
        document.getElementById("print_" + id).innerHTML = rounded + "$";
        let selector = document.querySelectorAll(".prix_article");
        let compteur = selector.length;
        let arr = [];
        for (let i = 0; i < compteur; i++) {
            arr.push(selector[i].innerHTML.substring(0, selector[i].innerHTML.length - 1));
        }
        let prix_total_actuel = 0;
        for (let i = 0; i < compteur; i++) {
            prix_total_actuel += Number(arr[i]);
        }
        prix_total_actuel = Math.round(prix_total_actuel * 100) / 100;
        console.log(prix_total_actuel);
        document.getElementById("prix_ttc").innerHTML = prix_total_actuel + "$";
    }

    const SupprimerToutPanier = () => {
        window.localStorage.removeItem("article_add");
        window.location.reload();
    }

    const SupprimerElementPanier = (e) => {
        let id = e.target.id.substr(-1);
        let value_local = window.localStorage.getItem("article_add");
        let tab = value_local.split(',');
        let compteur = tab.length;
        let arr = [];
        for(let i = 0; i < compteur; i++){
            if(tab[i] !== id){
                arr.push(tab[i]);
            }
        }
        window.localStorage.setItem("article_add", arr);
        value_local = window.localStorage.getItem("article_add");
        if(value_local.length === 0){
            window.localStorage.removeItem("article_add");
        }
        window.location.reload();
    }

    const paiement = () => {
        axios.post('http://localhost:8000/paiement', articles)
    .then(response => window.location.href=response.data);
    }

    useEffect(() => {
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
                let items = [];
                const response = await axios(options);
                let value_local = window.localStorage.getItem('article_add');
                let tableau = value_local.split(',');
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
    }, []);

    return (
        <div className='panier'>
            <Header />
            <div className='body_panier'>
                <div className='container'>
                    <div className='container_panier'>
                        <div className='title'>
                            {typeof localStorage["article_add"] === "undefined" ? <h1>Panier vide</h1> : <h1>Votre panier :</h1>}
                        </div>
                        <div className='row'>
                            <table>
                                {
                                    typeof localStorage["article_add"] !== "undefined" &&
                                    <thead>
                                        <tr>
                                            <th></th>
                                            <th><h1>Produits</h1></th>
                                            <th><h1>Prix</h1></th>
                                            <th><h1>Quantité</h1></th>
                                            <th><h1>Prix total</h1></th>
                                            <th><img src="https://cdn-icons-png.flaticon.com/512/73/73806.png" alt="poubelle" className="croix" onClick={() => SupprimerToutPanier()}></img></th>
                                        </tr>
                                    </thead>
                                }
                                <tbody>
                                    {articles.map((article) => {
                                        let prix_base = article.variant[0].price;
                                        prix_ttc += Number(prix_base)
                                        return <tr className='border-top'>
                                            <td><img src={article.variant[0].images[0].uuid} alt="img_article" className='img_panier'></img></td>
                                            <td><h2>{article.name}</h2></td>
                                            <td><h2>{article.variant[0].price}$</h2></td>
                                            <td>
                                                <div className='box'>
                                                    <select onChange={(e) => Quantite(e, prix_base, prix_ttc)} id={article.id}>
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
                                            <td><h2 id={"print_" + article.id} className="prix_article">{prix_base}$</h2></td>
                                            <td><img src="https://cdn-icons-png.flaticon.com/512/251/251319.png" alt="croix" className="croix" id={"id"+article.id} onClick={(e) => SupprimerElementPanier(e)}></img></td>
                                        </tr>
                                    })}
                                </tbody>
                            </table>
                            {
                                typeof localStorage["article_add"] !== "undefined" &&
                                <div className='info_right'>
                                    <h1>TOTAL TTC</h1>
                                    <br></br>
                                    <h1 id="prix_ttc">{Math.round(prix_ttc * 100) / 100}$</h1>
                                    <div className='row livraison'>
                                        <h3>Frais de livraison</h3>
                                        <h3 className='flex_2'>Gratuits</h3>
                                    </div>
                                    <div className="btn" onClick={() => paiement()}>COMMANDER</div>
                                </div>
                            }
                        </div>
                    </div>
                </div>
            </div>
            <Footer />
        </div >
    )
}

export default Panier