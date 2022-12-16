import Tablette_article from './tablette_article.jsx';
import Ordinateur_portable_article from './ordinateur_portable_article.jsx';
import { useParams } from 'react-router-dom'
import { useEffect, useState } from 'react';

const ShowArticle = () => {
    let { category } = useParams();

    const [component , setComponent] = useState(null);

    useEffect(() => {
        if(category === 'tablette') {
            setComponent(<Tablette_article />)
        }
        else if(category === 'composant') {
    
        }
        else {
            setComponent(<Ordinateur_portable_article />)
        }
    }, [])
    

    return(
        <div>
            {component}
        </div>
    )
}

export default ShowArticle