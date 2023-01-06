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
            }
            catch (error) {
                console.log(error);
            }
        }
        getArticleData();
    }, []);

    return (
        <div>
            <Header />
            <div className='flex center items-center body_ordinateur_portable_article'>
                <div className='container_ordinateur_portable pd-bottom-2'>
                    <div className=''>
                        <div>
                            <p className='mg-left-4'>{name}</p>
                            <div className='flex center'>
                                <img src={uuid} alt="image ordinateur portable" />
                                <div className='container_payement mg-left-4 pd-bottom-2'>
                                    <div className='flex center mg-top-4'>
                                        <div>
                                            <p className='font-size-2 mg-2'>
                                                {price}$
                                            </p>
                                            <p className='font-size-tva'>TVA INCLUS *</p>
                                        </div>
                                        <div className='container_payement_tranche mg-left-12'>
                                            <p>Payer en 4X 200$</p>
                                        </div>
                                    </div>
                                    <div className='flex center mg-top-10'>
                                        <div className='container_livraison'>
                                            <p className='font-size-1'>
                                                LIVRAISON <span className='cl-blue'>GRATUITE </span>
                                                LIVRE EN  3/4 JOURS
                                            </p>
                                        </div>
                                        <div className='container_payement_tranche mg-left-2'>
                                            <p className='font-size-1'>
                                                DISPONIBLE:
                                                <span className='cl-blue'> GRATUITE </span>
                                            </p>
                                        </div>
                                    </div>
                                    <div className='flex center mg-top-10'>
                                        <button className='btn'>AJOUTER AU PANIER</button>
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