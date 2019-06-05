<header class="header">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container mt-2 mb-2">
            <a class="navbar-brand" href="{url controller=PSC7HelperDashboard action=index}" title="PSC7-Helper">
                <img src="{link file="backend/_resources/images/logo-navbar.png"}" alt="PSC7-Helper">
            </a>
            <a class="navbar-toggler float-right" href="#nav">
                <span class="navbar-toggler-icon"></span>
            </a>
            <div class="collapse navbar-collapse" id="navbarToggler">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="{url controller=PSC7HelperDashboard action=index}"
                           id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true"
                           aria-expanded="false">
                            <strong>
                                Dashboard
                            </strong>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{url controller=PSC7HelperDashboard action=help}"
                               title="Hilfe">
                                Hilfe
                            </a>
                        </div>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <strong>
                                Connector
                            </strong>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{url controller=PSC7HelperConnector action=settings}"
                               title="Connector Einstellungen">
                                Connector Einstellungen
                            </a>
                            <a class="dropdown-item" href="{url controller=PSC7HelperConnector action=commands}"
                               title="Connector-Befehle">
                                Connector-Befehle
                            </a>
                            <a class="dropdown-item" href="{url controller=PSC7HelperConnector action=identitys}"
                               title="Connector Identitys">
                                Connector Identitys
                            </a>
                        </div>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <strong>
                                Support
                            </strong>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="https://github.com/psc7-helper/psc7-helper" target="_blank"
                               title="PSC7-Helper auf Github">
                                PSC7-Helper auf Github
                            </a>
                            <a class="dropdown-item" href="https://github.com/psc7-helper/psc7-helper/issues/"
                               target="_blank" title="Probleme melden">
                                Probleme melden
                            </a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item"
                               href="https://github.com/plentymarkets/plentymarkets-shopware-connector" target="_blank"
                               title="Connector auf Github">
                                Connector auf Github
                            </a>
                            <a class="dropdown-item"
                               href="https://docs.google.com/document/d/10mPeV3xqx4We71dYQdPmJK2qvb21Rpym6FG_tKwHKfc/edit"
                               target="_blank" title="Connector-Doku">
                                Connector-Doku
                            </a>
                            <a class="dropdown-item"
                               href="https://forum.plentymarkets.com/t/community-projekt-psc7-helper/" target="_blank"
                               title="Plenty-Forum">
                                Plenty-Forum
                            </a>
                        </div>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <strong>
                                Tools
                            </strong>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{url controller=PSC7HelperConnector action=commands}"
                               title="Bestellungen abgleichen">
                                Bestellungen abgleichen
                            </a>
                            <a class="dropdown-item" href="{url controller=PSC7HelperTools action=articleStatus}"
                               title="Artikelstatus prüfen">
                                Artikelstatus prüfen
                            </a>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</header>