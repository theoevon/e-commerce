import './log.css';
import React, {useState} from 'react';
import axios from "axios";

const Connexion = () => {

    const [email, setEmail] = useState(null)
    const [password, setPassword] = useState(null)

    const sendData = async (e) => {
        e.preventDefault();

        axios.post("https://localhost:8000/login", {
            email: email,
            password: password
        })
            .then((response) => {
                if (response.data.status === "success") {
                    alert(response.data.status)
                }
            })
            .catch((error) => {
                alert("utilisateur non reconnue")
            })
    }

    return (
        <div className='app'>
            <header>
                <div className="container">
                    <div className="row">
                        <a href="/">
                            <img src="https://cdn.discordapp.com/attachments/973872783320817744/1047108942397976636/image-removebg-preview.png" id="logo" alt="logo"></img>
                        </a>
                    </div>
                </div>
                <div className="navbar">
                    <nav></nav>
                </div>
            </header>
            <div className='body'>
                <div className="container_form">
                    <div className="connexion">
                        <h2>VOUS AVEZ DÉJÀ UN COMPTE ?</h2>
                        <form onSubmit={(e) => sendData(e)} action="" method="post">
                            <input onChange={(e) => setEmail(e.target.value)} type="email" name="email" id="email" placeholder="VOTRE EMAIL" required></input>
                            <input onChange={(e) => setPassword(e.target.value)} type="password" name="password" id="password" placeholder="VOTRE MOT DE PASSE" required></input>
                            <p>VOUS AVEZ OUBLIÉ VOTRE MOT DE PASSE ?</p>
                            <input type="submit" id="submit" className="btn" value="CONNEXION"></input>
                        </form>
                    </div>
                    <hr></hr>
                    <div className="inscription">
                        <h2>VOUS-ÊTES NOUVEAU ?</h2>
                        <a href="/inscription"><div className="btn">CRÉEZ UN COMPTE</div></a>
                    </div>
                </div>
            </div>
        </div>
    )
}

export default Connexion;