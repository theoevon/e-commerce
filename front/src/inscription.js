import './log.css';

const Inscription = () => {
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
                        <h2>VOS IDENTIFIANTS</h2>
                        <form action="" method="post">
                            <input type="text" name="identifiant" id="identifiant" placeholder="VOTRE IDENTIFIANT" required></input> 
                            <input type="email" name="email" id="email" placeholder="VOTRE EMAIL" required></input>
                            <input type="password" name="password" id="password" placeholder="VOTRE MOT DE PASSE" required></input>
                            <input type="submit" id="submit" className="btn" value="CRÉEZ UN COMPTE"></input>
                        </form>
                    </div>
                    <hr></hr>
                    <div className="inscription">
                        <h2>VOUS-AVEZ DÉJÀ UN COMPTE ?</h2>
                        <a href="/connexion"><div className="btn">CONNEXION</div></a>
                    </div>
                </div>
            </div>
        </div>
    )
}

export default Inscription;