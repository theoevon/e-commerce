import Tablette from './tablette_article.jsx';
import Ordinateur from './ordinateur_article.jsx';
import { useParams } from 'react-router-dom'
import { useEffect, useState } from 'react';

const ShowArticle = () => {
    let { category } = useParams();

    const [component, setComponent] = useState(null);

    useEffect(() => {
        if (category === 'tablette') {
            setComponent(<Tablette />)
        }
        // else if (category === 'composant') {
        // }
        else {
            setComponent(<Ordinateur />)
        }
    }, [category])

    return (
        <div>
            {component}
        </div>
    )
}

export default ShowArticle