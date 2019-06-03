{extends file="parent:backend/_base/layout.tpl"}

{block name="content/main"}
    <div class="row">
        <div class="col-12">
            <div id="accordion">
                <div class="card mb-2">
                    <div class="card-header" id="help1rel">
                        <h5 class="mb-0">
                            <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#help1"
                                    aria-expanded="false" aria-controls="help1">
                                Dashboard
                            </button>
                        </h5>
                    </div>
                    <div id="help1" class="collapse" aria-labelledby="help1" data-parent="#accordion">
                        <div class="card-body">
                            Auf dem Dashbord landest du immer nach der Anmeldung. Hier hast du einige wichtige
                            Informationen auf den ersten Blick zusammengefasst. Der Backlog wird live berechnet und ist
                            nach jedem Klick aktuell. Die Übersicht der Cronjobs zeigt dir ob alle Prozesse korrekt
                            laufen. Sollten nicht alle Cronjobs aktiv sein kann das unter Umständen von dem
                            Administrator deines Systems so gewollt sein. Sprich mit deinem Administrator bevor du
                            Änderungen an den Cronjobs vornimmst.
                        </div>
                    </div>
                </div>
                <div class="card mb-2">
                    <div class="card-header" id="help4rel">
                        <h5 class="mb-0">
                            <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#help4"
                                    aria-expanded="false" aria-controls="help4">
                                Connector-Befehle
                            </button>
                        </h5>
                    </div>
                    <div id="help4" class="collapse" aria-labelledby="help4" data-parent="#accordion">
                        <div class="card-body">
                            Das Herzstück des Helpers ist der Bereich Connector-Befehle. Die hier in einfache Buttons
                            gepackte Kurzwahl-Befehle helfen dir ohne Verwendung der Konsole die Standard-Befehle des
                            Connectors mit einem Klick auszuführen.<br><br>Mit den Artikel Sync kannst du einen
                            einzelnen Artikel oder Variante synchonisieren.
                        </div>
                    </div>
                </div>
                <div class="card mb-2">
                    <div class="card-header" id="help5rel">
                        <h5 class="mb-0">
                            <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#help5"
                                    aria-expanded="false" aria-controls="help5">
                                Connector Identitys
                            </button>
                        </h5>
                    </div>
                    <div id="help5" class="collapse" aria-labelledby="help5" data-parent="#accordion">
                        <div class="card-body">
                            In den Logfiles findet sich immer wieder der Begriff payload. In diesem Bereich kannst du
                            danach suchen. Zusammen mit dem Filter objectIdentifier bekommst du eine Liste mit
                            Informationen zu dem payload angezeigt.<br><br>Mit dem Filter adapterIdentifier kannst du z.
                            B. nach ID´s zu Artikeln, Varianten, Bestellungen, usw. suchen.
                        </div>
                    </div>
                </div>
                <div class="card mb-4">
                    <div class="card-header" id="help8rel">
                        <h5 class="mb-0">
                            <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#help8"
                                    aria-expanded="false" aria-controls="help8">
                                Support
                            </button>
                        </h5>
                    </div>
                    <div id="help8" class="collapse" aria-labelledby="help8" data-parent="#accordion">
                        <div class="card-body">
                            <strong>PSC7-Helper auf Github</strong><br>Der PSC7-Helper ist ein Open-Source-Projekt auf
                            GitHub. Du kannst gerne mitmachen.<br><br><strong>Probleme melden</strong><br>Melde bitte
                            alle Fehler auf <a href="https://github.com/psc7-helper/psc7-helper/issues/" target="_new">GitHub</a>.
                            Nur so können wir den Helper verbessern.<br><br><strong>Connector-Doku</strong><br>Hier
                            kommst du zu der externen Seite mit der offiziellen <a
                                    href="https://docs.google.com/document/d/10mPeV3xqx4We71dYQdPmJK2qvb21Rpym6FG_tKwHKfc/edit"
                                    target="_new">Dokumentation des PSC7 Connectors</a> von <a
                                    href="https://www.arvatis.com"
                                    target="_new">Avatis</a>.<br><br><strong>Plenty-Forum</strong><br>Das Plenty-Forum
                            ist das offizielle Forum von plentyMarkets. Neben GitHub kannst du auch hier mit uns über
                            den Helper diskutieren. In dem Forum haben wir für den Helper <a
                                    href="https://forum.plentymarkets.com/t/community-projekt-psc7-helper/496013"
                                    target="_new">ein eigenes Thema</a> angelegt.
                        </div>
                    </div>
                </div>
                <div class="card mb-2">
                    <div class="card-header" id="help9rel">
                        <h5 class="mb-0">
                            <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#help9"
                                    aria-expanded="false" aria-controls="help9">
                                Bestellungen abgleichen
                            </button>
                        </h5>
                    </div>
                    <div id="help9" class="collapse" aria-labelledby="help9" data-parent="#accordion">
                        <div class="card-body">
                            Dieses Tool bietet eine Liste der letzten 50 Bestellungen an. In der tabellarischen
                            Auflistung ist ersichtlich ob eine Bestellung mit plentymarkets synchronisiert ist. Sollte
                            dies nicht Fall sein, kann mit einem Klick auf den danebenstehenden Button die
                            Synchronisierung erneut versucht werden. Im Fehlerfall kann aus der Ausgabe die Fehler
                            entnommen werden.
                        </div>
                    </div>
                </div>
                <div class="card mb-2">
                    <div class="card-header" id="help11rel">
                        <h5 class="mb-0">
                            <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#help11"
                                    aria-expanded="false" aria-controls="help11">
                                Artikelstatus prüfen
                            </button>
                        </h5>
                    </div>
                    <div id="help11" class="collapse" aria-labelledby="help11" data-parent="#accordion">
                        <div class="card-body">
                            Gelegentlich kommt es vor, dass durch den Connector der Status eines Artikels nicht korrekt
                            gesetzt wird und der Artikel daher nicht online ist. Mit diesem Tool kannst du sehen ob und
                            welche Artikel das bei dir betrifft. In der Liste gibt es für jeden Artikel ein Button für
                            den erneuten Abgleich.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
{/block}