import Header from '../component/header.js';
import Footer from '../component/footer.js';
import React, { useEffect, useState } from 'react'
import axios from "axios";
import { useParams } from 'react-router-dom'

const Tablette = () => {

    let { id } = useParams();
    const [name, setName] = useState(null);
    const [price, setPrice] = useState(null);
    const [length, setLength] = useState(null);
    const [uuid, setUuid] = useState(null)
    const [color, setColor] = useState('gris');
    const [variants, setVariants] = useState([]);
    const [id_article, setIdArticle] = useState(null);

    const AjouterPanier = (event) => {
        if (typeof localStorage["article_add"] === "undefined") {
            let arr = [];
            arr.push(event.target.id);
            window.localStorage.setItem('article_add', arr);
            alert("votre article a été bien ajouter")
        }
        else {
            let value_local = window.localStorage.getItem('article_add');
            let tab = value_local.split(',');
            if (tab.includes(event.target.id) === false) {
                tab.push(event.target.id);
                window.localStorage.setItem('article_add', tab);
                alert("votre article a été bien ajouter")
            }
            else {
                alert("L'article est déjà dans votre panier !");
            }
        }
    }

    useEffect(() => {
        async function getArticleData() {
            try {
                const options = {
                    url: 'https://localhost:8000/api/articles/' + id,
                    method: 'GET',
                    headers: {
                        'Accept': 'application/json',
                        'Content-Type': 'application/json;charset=UTF-8'
                    }
                }
                const response = await axios(options);
                setName(response.data.name);
                setPrice(response.data.variant[0].price)
                setLength(response.data.variant.length)
                setUuid(response.data.variant[0].images[0].uuid)
                setVariants(response.data.variant);
                setIdArticle(response.data.id)
            }
            catch (error) {
                console.log(error);
            }
        }

        getArticleData();
    }, [id]);

    return (
        <div className='app'>
            <Header />
            <div>
                <div className='en_tete'>
                    <h2>{name}</h2>
                    <h2>À PARTIR DE {price}€</h2>
                </div>

                <div className='flex'>
                    <div className='left'>
                        {length === 1 ?
                            (<div>
                                <img src={uuid} alt="tablette" />
                            </div>)
                            : (<div>
                                {variants.filter(variant => variant.color === color).map((variant) => {
                                    return <div>
                                        <img src={variant.images[0].uuid} alt="tablette" />
                                    </div>
                                })}
                            </div>)}
                    </div>
                    <div className='right'>
                        <div className='div_couleur'>
                            {variants.map((variant) => {
                                return <div className='couleur' onClick={() => setColor(variant.color)}>
                                    <div className={"rond_" + variant.color}></div>
                                    <h3>{variant.color}</h3>
                                </div>
                            })}
                            <div className='btn_panier'>
                                <button className='ajt_panier' id={id_article} onClick={(e) => AjouterPanier(e)}>AJOUTER AU PANIER</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <Footer />
        </div>
    );
}

export default Tablette;