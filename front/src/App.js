import './App.css';

function App() {
  return (
    <div className='app'>
      <header>
        <div className="container">
          <div className="row">
            <img src="https://cdn.discordapp.com/attachments/973872783320817744/1047108942397976636/image-removebg-preview.png" id="logo" alt="logo"></img>
            <input type="text" placeholder="Recherche..." name="search" id="search"></input>
            <div className="profil row">
              <div className="account">
                <img src="https://cdn-icons-png.flaticon.com/512/5989/5989226.png" id="icon_account" alt="icon_account"></img>
                <p className="info_icon">Mon compte</p>
              </div>
              <div className="panier">
                <img src="https://cdn-icons-png.flaticon.com/512/481/481383.png" id="icon_panier" alt="icon_panier"></img>
                <p className="info_icon">Panier</p>
              </div>
            </div>
          </div>
        </div>
      <div className="navbar">
        <nav></nav>
      </div>
      </header>
      <div className='body_article'>
        <div className="container">
          <div className="container_article">
            <h1>NOS PRODUITS</h1>
            <div className="all_article">
              <div className="article">
                <div className="row_article">
                  <div className="text">
                    <h2>ORDINATEUR</h2>
                    <p>DÉCOUVRIR &gt;</p>
                  </div>
                  <div className="img_article">
                    <img src="https://cdn.discordapp.com/attachments/973872783320817744/1047455500993835109/20211105111922_cyb_miniature_8002-min.webp" alt="img_article"></img>
                  </div>
                </div>
              </div>
              <div className="article">
                <div className="row_article">
                  <div className="text">
                    <h2>PC PORTABLE</h2>
                    <p>DÉCOUVRIR &gt;</p>
                  </div>
                  <div className="img_article">
                    <img src="https://cdn.discordapp.com/attachments/973872783320817744/1047455732829798460/b5c927b0f77a27b81fd38b65df5f2fbf_XL-removebg-preview.png" alt="img_article"></img>
                  </div>
                </div>
              </div>
              <div className="article">
                <div className="row_article">
                  <div className="text">
                    <h2>CARTE GRAPHIQUE</h2>
                    <p>DÉCOUVRIR &gt;</p>
                  </div>
                  <div className="img_article">
                    <img src="https://cdn.discordapp.com/attachments/973872783320817744/1047455764664557578/carte-graphique-gigabyte-rtx-3070-aorus-master-8-g-removebg-preview.png" alt="img_article"></img>
                  </div>
                </div>
              </div>
              <div className="article">
                <div className="row_article">
                  <div className="text">
                    <h2>IPAD AIR</h2>
                    <p>DÉCOUVRIR &gt;</p>
                  </div>
                  <div className="img_article">
                    <img src="https://cdn.discordapp.com/attachments/973872783320817744/1047464616395014174/image.png" alt="img_article"></img>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  );
}

export default App;
