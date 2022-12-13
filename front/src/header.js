import Dropdown from 'react-bootstrap/Dropdown';
import 'bootstrap/dist/css/bootstrap.min.css';

const Header = () => {
    return (
        <header>
            <div className="container">
                <div className="row">
                    <a href="/">
                        <img src="https://cdn.discordapp.com/attachments/973872783320817744/1047108942397976636/image-removebg-preview.png" id="logo" alt="logo"></img>
                    </a>
                    <input type="text" placeholder="Recherche..." name="search" id="search"></input>
                    <div className="profil row">
                        <a href="/connexion">
                            <div className="account">
                                <img src="https://cdn-icons-png.flaticon.com/512/5989/5989226.png" id="icon_account" alt="icon_account"></img>
                                <p className="info_icon">Mon compte</p>
                            </div>
                        </a>
                        <a href="/panier">
                            <div className="panier">
                                <img src="https://cdn-icons-png.flaticon.com/512/481/481383.png" id="icon_panier" alt="icon_panier"></img>
                                <p className="info_icon">Panier</p>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            <div className="navbar">
                <nav>
                <Dropdown>
      <Dropdown.Toggle variant="success" id="dropdown-basic">
        Dropdown Button
      </Dropdown.Toggle>

      <Dropdown.Menu>
        <Dropdown.Item href="#/action-1">Action</Dropdown.Item>
        <Dropdown.Item href="#/action-2">Another action</Dropdown.Item>
        <Dropdown.Item href="#/action-3">Something else</Dropdown.Item>
      </Dropdown.Menu>
    </Dropdown>                </nav>
            </div>
        </header>
    )
}

export default Header;