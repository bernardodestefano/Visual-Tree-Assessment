<?php session_start();
if (!isset($_SESSION['user_name'], $_SESSION['user_password'])) die("You are not authorized");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

    <title> VTA </title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/bootstrap-theme.min.css">
    <link rel="stylesheet" href="css/offlinejs.css">
    <link rel="stylesheet" href="css/offlinejs_language_italian.css">
    <link rel="stylesheet" href="css/core.css">
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/offlinejs.js"></script>
    <script src="js/vta.js"></script>
    <script src="js/offline-simulate-ui.min.js"></script>
</head>
<body>



<div class="jumbotron">
    <div class="container">
        <h2 class="text-center"> SCHEDA DI VALUTAZIONE VTA </h2>
    </div>
</div>

<nav class="navbar navbar-default" style="margin-top: -30px">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand" href="#">
                <span class="glyphicon glyphicon-leaf" aria-hidden="true"></span> VTA
            </a>
        </div>
      <ul class="nav navbar-nav navbar-left">
          <li id="home_button" role="presentation" class="active"><a href="#">Nuova Scheda</a></li>
          <li id="gestione_button" role="presentation"><a href="#">Gestione</a></li>
      </ul>
    </div>
</nav>

<div class="container-fluid">

    <div class="row hidden" id="gestione_section" >
        <div class="col-lg-12 ">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">GESTIONE VTA</h3>
                </div>

                <div class="panel-body">

                    <table id="tabella" class="table table-hover">
                        <thead id="head_tabella">
                        <tr>
                            <th>#</th>
                            <th>Numero</th>
                            <th>Localita</th>
                            <th>Codice Ambito</th>
                            <th>Genere</th>
                            <th>Specie</th>
                        </tr>
                        </thead>
                        <tbody id="body_tabella">

                        </tbody>
                    </table>

                </div>
            </div>
        </div>


    </div>


    <form action="query.php" method="post">

        <div class="row" id="home_section">


            <div id="informazioni_generali" class="col-md-4 col-sm-6">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title">INFORMAZIONI GENERALI</h3>
                    </div>

                    <div class="panel-body">

                        <div class="form-group  module-content">
                            <label class="control-label">NUMERO ALBERO</label>
                            <input type="number" class="form-control" name="numero">
                        </div>

                        <div class="form-group  module-content">
                            <label class="control-label">LOCALITA</label>
                            <input type="text" class="form-control" name="localita">
                        </div>

                        <div class="form-group  module-content">
                            <label class="control-label">CODICE AMBITO</label>
                            <input type="number" class="form-control" name="codice_ambito">
                        </div>

                        <div class="form-group  module-content">
                            <label class="control-label">GENERE</label>
                            <input type="text" class="form-control" name="genere">
                        </div>

                        <div class="form-group  module-content">
                            <label class="control-label">SPECIE</label>
                            <input type="text" class="form-control" name="specie">
                        </div>

                        <div class="form-group  module-content">
                            <label class="control-label">VARIETA</label>
                            <input type="text" class="form-control" name="varieta">
                        </div>
                    </div>
                </div>
            </div>

            <div id="dati_dimensione_pianta" class="col-md-4 col-sm-6">

                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title">DATI DIMENSIONE PIANTA</h3>
                    </div>
                    <div class="panel-body">
                        <div class="form-group  module-content">
                            <label class="control-label">ALTEZZA (m)</label>
                            <input type="number" class="form-control" name="altezza">
                        </div>

                        <div class="form-group  module-content">
                            <label class="control-label">DIAMETRO FUSTO (cm)</label>
                            <input type="number" class="form-control" name="diametro_fusto">
                        </div>

                        <div class="form-group  module-content">
                            <label class="control-label">ALTEZZA FUSTO LIBERO (m)</label>
                            <input type="number" class="form-control" name="altezza_fusto_libero">
                        </div>

                        <div class="form-group  module-content">
                            <label class="control-label">DIAMETRO CHIOMA (m)</label>
                            <input type="number" class="form-control" name="diametro_chioma">
                        </div>
                    </div>
                </div>
            </div>

            <div id="caratteri_generali" class="col-md-4 col-sm-6">
                            <div class="panel panel-primary">
                                <div class="panel-heading">
                                    <h3 class="panel-title">CARATTERI GENERALI</h3>
                                </div>
                                <div class="panel-body">
                                    <div class="form-group  module-content">
                                        <label class="control-label">MONUMENTALE</label>
                                        <input type="number" min="0" max="5" pattern="[0-5]" class="form-control" name="monumentale">
                                    </div>

                                    <div class="form-group  module-content">
                                        <label class="control-label">MATURO</label>

                                        <input type="number" class="form-control" name="maturo">
                                    </div>

                                    <div class="form-group  module-content">
                                        <label class="control-label">ADULTO</label>
                                        <input type="number" class="form-control" name="adulto">
                                    </div>

                                    <div class="form-group  module-content">
                                        <label class="control-label">NEOIMPIANTO</label>
                                        <input type="number" class="form-control" name="neo_impianto">
                                    </div>

                                    <div class="form-group  module-content">
                                        <label class="control-label">CEPPAIA/SEDE VUOTA</label>
                                        <input type="number" class="form-control" name="ceppaia_sede_vuota">
                                    </div>

                                    <div class="form-group  module-content">
                                        <label class="control-label">MORTA</label>
                                        <input type="number" class="form-control" name="morta">
                                    </div>
                                </div>
                            </div>
                </div>

            <div id="castello" class="col-md-4 col-sm-6 hidden">
                                <div class="panel panel-primary">
                                    <div class="panel-heading">
                                        <h3 class="panel-title">CASTELLO</h3>
                                    </div>
                                    <div class="panel-body">

                                        <div class="form-group  module-content">
                                            <label class="control-label">CARPOFORO/I</label>
                                            <input type="number" class="form-control" name="carpofori_castello">
                                        </div>

                                        <div class="form-group  module-content">
                                            <label class="control-label">CAVITA ESPOSTE</label>

                                            <input type="number" class="form-control" name="cavita_esposte_castello">
                                        </div>

                                        <div class="form-group  module-content">
                                            <label class="control-label">CAVITA OCCULTA</label>
                                            <input type="number" class="form-control" name="cavita_occulta_castello">
                                        </div>

                                        <div class="form-group  module-content">
                                            <label class="control-label">CODOMIN.CORT.INCLUSA/I</label>
                                            <input type="number" class="form-control" name="codominio_corteccia_inclusa_castello">
                                        </div>

                                        <div class="form-group  module-content">
                                            <label class="control-label">ESSUDATI</label>

                                            <input type="number" class="form-control" name="essudati_castello">
                                        </div>

                                        <div class="form-group  module-content">
                                            <label class="control-label">FERITE DA TAGLIO APERTE</label>
                                            <input type="number" class="form-control" name="ferite_da_taglio_aperte_castello">
                                        </div>

                                        <div class="form-group  module-content">
                                            <label class="control-label">FERITE DA TAGLIO MARCESCENTI</label>
                                            <input type="number" class="form-control" name="ferite_da_taglio_marcescenti_castello">
                                        </div>

                                        <div class="form-group  module-content">
                                            <label class="control-label">FERITE RIMARGINATE</label>

                                            <input type="number" class="form-control" name="ferite_rimarginate_castello">
                                        </div>

                                        <div class="form-group  module-content">
                                            <label class="control-label">FESSURAZIONI</label>
                                            <input type="number" class="form-control" name="fessurazioni_castello">
                                        </div>

                                        <div class="form-group  module-content">
                                            <label class="control-label">CAVITA OCCULTA/ORIFIZI</label>
                                            <input type="number" class="form-control" name="cavita_occulta_orifizi_castello">
                                        </div>
                                    </div>
                                </div>

            </div>

            <div id="chioma" class="col-md-4 col-sm-6 hidden" >
                                    <div class="panel panel-primary">
                                        <div class="panel-heading">
                                            <h3 class="panel-title">CHIOMA</h3>
                                        </div>
                                        <div class="panel-body">
                                            <div class="form-group  module-content">
                                                <label class="control-label">BRANCHE CAPITOZZATE</label>
                                                <input type="number" class="form-control" name="branche_capitozzate_chioma">
                                            </div>

                                            <div class="form-group  module-content">
                                                <label class="control-label">BRANCHE/CHIOMA ASIMM.</label>

                                                <input type="number" class="form-control" name="branche_chioma_asimmetrica_chioma">
                                            </div>

                                            <div class="form-group  module-content">
                                                <label class="control-label">BRANCHE PERICOLANTI</label>
                                                <input type="number" class="form-control" name="branche_pericolanti_chioma">
                                            </div>

                                            <div class="form-group  module-content">
                                                <label class="control-label">CARPOFORI</label>
                                                <input type="number" class="form-control" name="carpofori_chioma">
                                            </div>

                                            <div class="form-group  module-content">
                                                <label class="control-label">CAVITA ESPOSTA/CARIE</label>

                                                <input type="number" class="form-control" name="cavita_esposta_carie_chioma">
                                            </div>

                                            <div class="form-group  module-content">
                                                <label class="control-label">CHIOMA FILATA</label>
                                                <input type="number" class="form-control" name="chioma_filata_chioma">
                                            </div>

                                            <div class="form-group  module-content">
                                                <label class="control-label">FILLOPTOSI DIFFUSA/SECCUME</label>
                                                <input type="number" class="form-control" name="filloptosi_diffusa_seccume_chioma">
                                            </div>

                                            <div class="form-group  module-content">
                                                <label class="control-label">FILLOPTOSI PARZIALE</label>

                                                <input type="number" class="form-control" name="filloptosi_parziale_chioma">
                                            </div>

                                            <div class="form-group  module-content">
                                                <label class="control-label">MONCONI</label>
                                                <input type="number" class="form-control" name="monconi_chioma">
                                            </div>

                                            <div class="form-group  module-content">
                                                <label class="control-label">MONCONI NECROTIZZATI</label>
                                                <input type="number" class="form-control" name="monconi_necrotizzati_chioma">
                                            </div>

                                            <div class="form-group  module-content">
                                                <label class="control-label">ORIFIZI-CAVITA</label>

                                                <input type="number" class="form-control" name="orifizi_cavita_chioma">
                                            </div>

                                            <div class="form-group  module-content">
                                                <label class="control-label">SPIOMBATURA FUORI ASSE</label>
                                                <input type="number" class="form-control" name="spiombatura_fuori_asse_chioma">
                                            </div>

                                            <div class="form-group  module-content">
                                                <label class="control-label">SPIOMBATURA IN ASSE</label>
                                                <input type="number" class="form-control" name="spiombatura_in_asse_chioma">
                                            </div>
                                        </div>
                                    </div>

            </div>

            <div id="esame_strumentale" class="col-md-4 col-sm-6 hidden">

                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title">ESAME STRUMENTALE</h3>
                    </div>
                    <div class="panel-body">
                        <div class="form-group  module-content">
                            <label class="control-label">COLLETTO</label>
                            <input type="number" class="form-control" name="colletto_esame_strumentale">
                        </div>

                        <div class="form-group  module-content">
                            <label class="control-label">FUSTO</label>
                            <input type="number" class="form-control" name="fusto_esame_strumentale">
                        </div>

                        <div class="form-group  module-content">
                            <label class="control-label">FORCELLA</label>
                            <input type="number" class="form-control" name="forcella_esame_strumentale">
                        </div>

                        <div class="form-group  module-content">
                            <label class="control-label">BRANCHE PRIMARIE</label>
                            <input type="number" class="form-control" name="branche_primarie_esame_strumentale">
                        </div>

                        <div class="form-group  module-content">
                            <label class="control-label">CONTROLLO IN QUOTA</label>
                            <input type="number" class="form-control" name="controllo_in_quota_esame_strumentale">
                        </div>
                    </div>
                </div>
            </div>

            <div id="tipologia_pavimentazione" class="col-md-4 col-sm-6 hidden">

                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title">TIPOLOGIA PAVIMENTAZIONE</h3>
                    </div>
                    <div class="panel-body">
                        <div class="form-group  module-content">
                            <label class="control-label">COPERTURA VEGETALE</label>
                            <input type="number" class="form-control" name="copertura_vegetale_tipologia_pavimentazione">
                        </div>

                        <div class="form-group  module-content">
                            <label class="control-label">ASFALTO</label>
                            <input type="number" class="form-control" name="asfalto_tipologia_pavimentazione"">
                        </div>

                        <div class="form-group  module-content">
                            <label class="control-label">NATURALE STABILIZZATO</label>
                            <input type="number" class="form-control" name="naturale_stabilizzato_tipologia_pavimentazione"">
                        </div>
                        <h7>ESAMI STRUMENTALI</h7>
                        <div><br></div>
                        <div class="form-group  module-content">
                            <label class="control-label">MARTELLO AD IMPULSI</label>
                            <input type="number" class="form-control" name="martello_ad_impulsi_tipologia_pavimentazione"">
                        </div>
                        <div class="form-group  module-content">
                            <label class="control-label">RESISTOGRAPH</label>
                            <input type="number" class="form-control" name="resistograph_tipologia_pavimentazione"">
                        </div>
                        <div class="form-group  module-content">
                            <label class="control-label">FRATTOMETRO</label>
                            <input type="number" class="form-control" name="frattometro_tipologia_pavimentazione"">
                        </div>
                        <div class="form-group  module-content">
                            <label class="control-label">TOMOGRAFO</label>
                            <input type="number" class="form-control" name="tomografo_tipologia_pavimentazione"">
                        </div>
                    </div>
                </div>
            </div>

            <div id="bersaglio" class="col-md-4 col-sm-6 hidden">

                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title">BERSAGLIO</h3>
                    </div>
                    <div class="panel-body">
                        <div class="form-group  module-content">
                            <label class="control-label">MANUFATTI/PARCHEGGIO</label>
                            <input type="number" class="form-control" name="manufatti_parcheggio_bersaglio">
                        </div>

                        <div class="form-group  module-content">
                            <label class="control-label">AREA VERDE</label>

                            <input type="number" class="form-control" name="area_verde_bersaglio">
                        </div>

                        <div class="form-group  module-content">
                            <label class="control-label">AREA MERCATALE</label>
                            <input type="number" class="form-control" name="area_mercatale_bersaglio">
                        </div>

                        <div class="form-group  module-content">
                            <label class="control-label">VIABILITA/BANCHINA SPART.</label>
                            <input type="number" class="form-control" name="viabilita_banchina_bersaglio">
                        </div>

                        <div class="form-group  module-content">
                            <label class="control-label">ZONA PEDONALE</label>

                            <input type="number" class="form-control" name="zona_pedonale_bersaglio">
                        </div>

                        <div class="form-group  module-content">
                            <label class="control-label">PARCHEGGIO</label>
                            <input type="number" class="form-control" name="parcheggio_bersaglio">
                        </div>

                        <div class="form-group  module-content">
                            <label class="control-label">VERDE SCOLASTICO</label>
                            <input type="number" class="form-control" name="verde_scolastico_bersaglio">
                        </div>

                        <div class="form-group  module-content">
                            <label class="control-label">CAPITOZZO</label>

                            <input type="number" class="form-control" name="capitozzo_bersaglio">
                        </div>

                        <div class="form-group  module-content">
                            <label class="control-label">CARPOFORI DIFFUSI</label>
                            <input type="number" class="form-control" name="carpofori_diffusi_bersaglio">
                        </div>

                        <div class="form-group  module-content">
                            <label class="control-label">CARPOFORI LOCALIZZATI</label>
                            <input type="number" class="form-control" name="carpofori_localizzati_bersaglio">
                        </div>

                        <div class="form-group  module-content">
                            <label class="control-label">CAVITA' ESPOSTA/CARIE</label>

                            <input type="number" class="form-control" name="cavita_esposta_carie_bersaglio">
                        </div>

                        <div class="form-group  module-content">
                            <label class="control-label">CAVITA' OCCULTA SOSPETTA</label>
                            <input type="number" class="form-control" name="cavita_occulta_sospetta_bersaglio">
                        </div>

                        <div class="form-group  module-content">
                            <label class="control-label">CODOMIN. CORTECCIA INCLUSA</label>
                            <input type="number" class="form-control" name="codominio_corteccia_inclusa_bersaglio">
                        </div>

                        <div class="form-group  module-content">
                            <label class="control-label">COSTOLATURE ELICOIDALI</label>

                            <input type="number" class="form-control" name="costolature_elicoidali_bersaglio">
                        </div>

                        <div class="form-group  module-content">
                            <label class="control-label">COSTOLATURE LONGITUDINALI</label>
                            <input type="number" class="form-control" name="costolature_longitudinali_bersaglio">
                        </div>

                        <div class="form-group  module-content">
                            <label class="control-label">CRACK DA COMPRESSIONE</label>
                            <input type="number" class="form-control" name="crack_da_compressione_bersaglio">
                        </div>

                        <div class="form-group  module-content">
                            <label class="control-label">CRACK DA TRAZIONE</label>

                            <input type="number" class="form-control" name="crack_da_trazione_bersaglio">
                        </div>

                        <div class="form-group  module-content">
                            <label class="control-label">CRETTO CORTECCIA INCLUSA</label>
                            <input type="number" class="form-control" name="cretto_corteccia_inclusa_bersaglio">
                        </div>

                        <div class="form-group  module-content">
                            <label class="control-label">CRETTO ELICOIDALE/LONG</label>
                            <input type="number" class="form-control" name="cretto_elicoidale_bersaglio">
                        </div>

                        <div class="form-group  module-content">
                            <label class="control-label">CRETTO RADIALE</label>

                            <input type="number" class="form-control" name="cretto_radiale_bersaglio">
                        </div>

                        <div class="form-group  module-content">
                            <label class="control-label">DANNI DA FULMINE</label>
                            <input type="number" class="form-control" name="danni_da_fulmine_bersaglio">
                        </div>

                        <div class="form-group  module-content">
                            <label class="control-label">DECORTICAZIONE DIFFUSA</label>
                            <input type="number" class="form-control" name="decortazione_diffusa_bersaglio">
                        </div>

                        <div class="form-group  module-content">
                            <label class="control-label">DECORTICAZIONE SUPERFICIALE</label>

                            <input type="number" class="form-control" name="decortazione_superficiale_bersaglio">
                        </div>

                        <div class="form-group  module-content">
                            <label class="control-label">DECADIMENTI / NECROSI</label>
                            <input type="number" class="form-control" name="decadimenti_necrosi_bersaglio">
                        </div>

                        <div class="form-group  module-content">
                            <label class="control-label">ESSUDATI</label>
                            <input type="number" class="form-control" name="essudati_bersaglio">
                        </div>

                        <div class="form-group  module-content">
                            <label class="control-label">FERITE DA TAGLIO MARCESCENTI</label>
                            <input type="number" class="form-control" name="ferite_da_taglio_marcescenti_bersaglio">
                        </div>

                        <div class="form-group  module-content">
                            <label class="control-label">FERITE RIMARGINATE</label>

                            <input type="number" class="form-control" name="ferite_rimarginate_bersaglio">
                        </div>

                        <div class="form-group  module-content">
                            <label class="control-label">FORMA A BOTTIGLIA</label>
                            <input type="number" class="form-control" name="forma_a_bottiglia_bersaglio">
                        </div>

                        <div class="form-group  module-content">
                            <label class="control-label">FUSTO INCLINATO</label>
                            <input type="number" class="form-control" name="fusto_inclinato_bersaglio">
                        </div>

                        <div class="form-group  module-content">
                            <label class="control-label">FUSTO MOLTO INCLINATO</label>

                            <input type="number" class="form-control" name="fusto_molto_inclinato_bersaglio">
                        </div>

                        <div class="form-group  module-content">
                            <label class="control-label">INCLUSIONE DI CORTECCIA</label>
                            <input type="number" class="form-control" name="inclusione_di_corteccia_bersaglio">
                        </div>

                        <div class="form-group  module-content">
                            <label class="control-label">INSETTI XILOFAGI</label>
                            <input type="number" class="form-control" name="insetti_xilofagi_bersaglio">
                        </div>

                        <div class="form-group  module-content">
                            <label class="control-label">IPERTROFIE-IPERPLASIA</label>
                            <input type="number" class="form-control" name="ipertrofie_iperplasia_bersaglio">
                        </div>

                        <div class="form-group  module-content">
                            <label class="control-label">LESIONI APERTE</label>

                            <input type="number" class="form-control" name="lesioni_aperte_bersaglio">
                        </div>

                        <div class="form-group  module-content">
                            <label class="control-label">LESIONI CICATRIZZATE</label>
                            <input type="number" class="form-control" name="lesioni_cicatrizzate_bersaglio">
                        </div>

                        <div class="form-group  module-content">
                            <label class="control-label">ORIFIZI-FESSURE</label>
                            <input type="number" class="form-control" name="orifizi_fessure_bersaglio">
                        </div>

                        <div class="form-group  module-content">
                            <label class="control-label">RICACCI DIFFUSI</label>

                            <input type="number" class="form-control" name="ricacci_diffusi_bersaglio">
                        </div>

                        <div class="form-group  module-content">
                            <label class="control-label">RIGONFIAMENTO ANULARE</label>
                            <input type="number" class="form-control" name="rigonfiamento_anulare_bersaglio">
                        </div>

                        <div class="form-group  module-content">
                            <label class="control-label">RIGONFIAMENTO UNILATERALE</label>
                            <input type="number" class="form-control" name="rigonfiamento_unilaterale_bersaglio">
                        </div>

                        <div class="form-group  module-content">
                            <label class="control-label">FESSURAZIONI</label>

                            <input type="number" class="form-control" name="fessurazioni_bersaglio">
                        </div>

                        <div class="form-group  module-content">
                            <label class="control-label">TORSIONE DEL FUSTO</label>
                            <input type="number" class="form-control" name="torsione_del_fusto_bersaglio">
                        </div>

                    </div>
                </div>
            </div>

            <div id="colletto" class="col-md-4 col-sm-6 hidden">

                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title">COLLETTO</h3>
                    </div>
                    <div class="panel-body">
                        <div class="form-group  module-content">
                            <label class="control-label">CARPOFORI DIFFUSI</label>
                            <input type="number" class="form-control" name="carpofori_diffusi_colletto">
                        </div>

                        <div class="form-group  module-content">
                            <label class="control-label">CARPOFORI LOCALIZZATI</label>
                            <input type="number" class="form-control" name="carpofori_localizzati_colletto">
                        </div>

                        <div class="form-group  module-content">
                            <label class="control-label">CAVIT
                                A ESPOSTE/CARIE</label>
                            <input type="number" class="form-control" name="cavita_esposte_carie_colletto">
                        </div>

                        <div class="form-group  module-content">
                            <label class="control-label">CAVITA OCCULTA SOSPETTA</label>
                            <input type="number" class="form-control" name="cavita_occulta_sospetta_colletto">
                        </div>

                        <div class="form-group  module-content">
                            <label class="control-label">CODOMINANZE</label>
                            <input type="number" class="form-control" name="codominanze_colletto">
                        </div>

                        <div class="form-group  module-content">
                            <label class="control-label">COLLETTO INTERRARO</label>
                            <input type="number" class="form-control" name="colletto_interrato_colletto">
                        </div>

                        <div class="form-group  module-content">
                            <label class="control-label">CONTRAFFORTE CON CONTROSERVIZI</label>
                            <input type="number" class="form-control" name="contrafforte_con_controservizi_colletto">
                        </div>

                        <div class="form-group  module-content">
                            <label class="control-label">CONTRAFFORTE DI REAZIONE </label>
                            <input type="number" class="form-control" name="contrafforte_di_reazione_colletto">
                        </div>

                        <div class="form-group  module-content">
                            <label class="control-label">CONTRAFFORTE LESIONATO</label>
                            <input type="number" class="form-control" name="contrafforte_lesionato_colletto">
                        </div>

                        <div class="form-group  module-content">
                            <label class="control-label">DECADIMENTO PROFONDO</label>
                            <input type="number" class="form-control" name="decadimento_profondo_colletto">
                        </div>

                        <div class="form-group  module-content">
                            <label class="control-label">DECADIMENTO SUPERFICIALE</label>
                            <input type="number" class="form-control" name="decadimento_superficiale_colletto">
                        </div>

                        <div class="form-group  module-content">
                            <label class="control-label">DECORTICAZIONE</label>
                            <input type="number" class="form-control" name="decorticazione_colletto">
                        </div>

                        <div class="form-group  module-content">
                            <label class="control-label">DECORTICAZIONI DIFFUSE</label>
                            <input type="number" class="form-control" name="decorticazioni_diffuse_colletto">
                        </div>

                        <div class="form-group  module-content">
                            <label class="control-label">DEPRESSIONI E CONCAVITA</label>
                            <input type="number" class="form-control" name="depressioni_e_concavita_colletto">
                        </div>

                        <div class="form-group  module-content">
                            <label class="control-label">FALSO COLLETTO</label>
                            <input type="number" class="form-control" name="falso_colletto_colletto">
                        </div>

                        <div class="form-group  module-content">
                            <label class="control-label">INCLUSIONE CORPI ESTRANEI</label>
                            <input type="number" class="form-control" name="inclusioni_corpi_estranei_colletto">
                        </div>

                        <div class="form-group  module-content">
                            <label class="control-label">INSETTI XILOFAGI</label>
                            <input type="number" class="form-control" name="insetti_xilofagi_colletto">
                        </div>

                        <div class="form-group  module-content">
                            <label class="control-label">IPERTROFIE - IPERPLASIE</label>
                            <input type="number" class="form-control" name="ipertrofie_iperplaste_colletto">
                        </div>

                        <div class="form-group  module-content">
                            <label class="control-label">LESIONI APERTE</label>
                            <input type="number" class="form-control" name="lesioni_aperte_colletto">
                        </div>

                        <div class="form-group  module-content">
                            <label class="control-label">LESIONI CICATRIZZATE</label>
                            <input type="number" class="form-control" name="lesioni_cicatrizzate_colletto">
                        </div>

                        <div class="form-group  module-content">
                            <label class="control-label">MICELIO DIFFUSO</label>
                            <input type="number" class="form-control" name="micelio_diffuso_colletto">
                        </div>

                        <div class="form-group  module-content">
                            <label class="control-label">MICELIO LOCALIZZATO</label>
                            <input type="number" class="form-control" name="micelio_localizzato_colletto">
                        </div>

                        <div class="form-group  module-content">
                            <label class="control-label">ORIFIZIO - FESSURA</label>
                            <input type="number" class="form-control" name="orifizio_fessura_colletto">
                        </div>

                        <div class="form-group  module-content">
                            <label class="control-label">PIEDE ESPANSO A CONO</label>
                            <input type="number" class="form-control" name="piede_espanso_a_cono_colletto">
                        </div>

                        <div class="form-group  module-content">
                            <label class="control-label">RADICE/I STROZZANTE/I</label>
                            <input type="number" class="form-control" name="radici_strozzanti_colletto">
                        </div>

                        <div class="form-group  module-content">
                            <label class="control-label">RADICI AFFIORANTI DECORTIC.</label>
                            <input type="number" class="form-control" name="radici_affioranti_decortic_colletto">
                        </div>

                        <div class="form-group  module-content">
                            <label class="control-label">RADICI AFFIORANTI</label>
                            <input type="number" class="form-control" name="radici_affioranti_colletto">
                        </div>

                        <div class="form-group  module-content">
                            <label class="control-label">RAMPICANTI</label>
                            <input type="number" class="form-control" name="rampicanti_colletto">
                        </div>

                        <div class="form-group  module-content">
                            <label class="control-label">RICACCI BASALI</label>
                            <input type="number" class="form-control" name="ricacci_basali_colletto">
                        </div>

                        <div class="form-group  module-content">
                            <label class="control-label">SOLLEVAMENTO ZOLLA</label>
                            <input type="number" class="form-control" name="sollevamento_zolla_colletto">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row" id="nav_buttons">
            <div class="col-md-12 text-center" >
                <ul class="pager ">
                    <li id="previous" class="previous hidden"><a>&larr; Precedente</a></li>
                    <li>
                        <button id="invia" type="submit" class="btn btn-primary btn-lg">
                              <span class="glyphicon glyphicon-floppy-disk" aria-hidden="true"></span> Salva
                        </button>
                    </li>
                    <li id="next" class="next"><a>Successivo &rarr;</a></li>
                </ul>
            </div>
        </div>

        <input id="page_status" type="number" value="1" class="hidden">

    </form>

</body>
</html>
