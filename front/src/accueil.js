import './App.css';
import Header from './header.js';
import Footer from './footer.js';

const Accueil  = () =>{
    return (
      <div className='app'>
        <Header />
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
                        <a href="ipad">
                            <div className="row_article">
                                <div className="text">
                                    <h2>IPAD AIR</h2>
                                    <p>DÉCOUVRIR &gt;</p>
                                </div>
                                <div className="img_article">
                                    <img src="https://cdn.discordapp.com/attachments/973872783320817744/1047464616395014174/image.png" alt="img_article"></img>
                                </div>
                            </div>
                        </a>
                    </div>
              </div>
            </div>
          </div>
        </div>
        <Footer />
      </div>
    );
  }
  
  export default Accueil;