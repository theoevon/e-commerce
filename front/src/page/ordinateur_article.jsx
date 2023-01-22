import Header from '../component/header.js';
import Footer from '../component/footer.js';
import React, { useEffect, useState } from 'react'
import axios from "axios";
import { useParams } from 'react-router-dom'

const Ordinateur_article = () => {
    let { id } = useParams();

    const [name, setName] = useState(null);
    const [uuid, setUuid] = useState(null);
    const [price, setPrice] = useState(null);
    const [description, setDescription] = useState(null);
    const [id_article , setIdArticle] = useState(null);

    const AjouterPanier = (event) => {
        if(typeof localStorage["article_add"] === "undefined"){
            let arr = [];
            arr.push(event.target.id);
            window.localStorage.setItem('article_add', arr);
            alert('votre article a été aujouter')
        }
        else{
            let value_local = window.localStorage.getItem('article_add');
            let tab = value_local.split(',');
            if(tab.includes(event.target.id) === false){
                tab.push(event.target.id);
                window.localStorage.setItem('article_add', tab);
                alert('votre article a été aujouter')
            }
            else{
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
                setUuid(response.data.variant[0].images[0].uuid);
                setPrice(response.data.variant[0].price)
                setDescription(response.data.description)
                setIdArticle(response.data.id)
            }
            catch (error) {
                console.log(error);
            }
        }
        getArticleData();
    }, [id]);

    return (
        <div>
            <Header />
            <div className='flex center items-center body_ordinateur_portable_article'>
                <div className='container_ordinateur_portable pd-bottom-2'>
                    <div className=''>
                        <div>
                            <p className='mg-left-4 flex center bold fts-1-5'>{name}</p>
                            <div className='flex center'>
                                <img src={uuid} alt="ordinateur portable" className='img-ordinateur-article'/>
                                <div className='container_payement mg-left-4 pd-bottom-2 pd-left-2'>
                                    <div className='flex center mg-top-4'>
                                        <div className='mg-right-10'> 
                                            <p className='fts-2 mg-2'>
                                                {price}$
                                            </p>
                                            <p className='fts-1'>TVA INCLUS *</p>
                                        </div>
                                            <p className=' container-payement-info pd-top-4 pd-bottom-4 pd-left-2 pd-right-2 mg-left-12'>Payer en 4X 200$</p>
                                    </div>
                                    <div className='flex center mg-top-10'>
                                        <div className='container_livraison pd-top-4 pd-bottom-4 pd-left-4 pd-right-4 mg-right  -10'>
                                            <p className='font-size-1'>
                                                LIVRAISON <span className='cl-blue'>GRATUITE </span>
                                                LIVRE EN  3/4 JOURS
                                            </p>
                                        </div>
                                        <div className='container_payement_tranche mg-left-2'>
                                            <p className='font-size-1 container-payement-info pd-top-4 pd-bottom-4 pd-left-2 pd-right-2 mg-left-12'>
                                                DISPONIBLE:
                                                <span className='cl-blue'></span>
                                            </p>
                                        </div>
                                    </div>
                                    <div className='flex center mg-top-10'>
                                        <button className='btn' id={id_article} onClick={(e) => AjouterPanier(e)} >AJOUTER AU PANIER</button>
                                    </div>
                                </div>
                            </div>
                            <div className='container_point_fort mg-left-4'>
                                <p>LES POINT FORTS</p>
                                <p>{description}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <Footer />
        </div>
    )
}

export default Ordinateur_article