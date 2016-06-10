<?php

use Silex\Application;
use Silex\Provider\AssetServiceProvider;
use Silex\Provider\TwigServiceProvider;

require_once __DIR__ . '/vendor/autoload.php';

$app = new Application();

$app['debug'] = true;

/* Configurazione --------------------------------------------------------------------------------------------------- */

$app -> register( new AssetServiceProvider(), array(
	'assets.version' => 'v1',
	'assets.version_format' => '%s?version=%s',
	'assets.named_packages' => array(
		'css' => array('base_path' => __DIR__ . '/css'),
		'fonts' => array('base_path' => __DIR__ . '/fonts'),
		'js' => array('base_path' => __DIR__ . '/js') )
));

$app -> register( new TwigServiceProvider(), array(
	'twig.path' => __DIR__ . '/views',
));

$app -> before( function() use ( $app ) {

	$conn = new mysqli("localhost","root","root","vta");

	if( $conn -> connect_errno )
	{
		echo "Connessione a MySQL fallita: (" . $conn -> connect_errno . ") " . $conn -> connect_error;
	}

	$app['db'] = $conn;
});

/* Routes ----------------------------------------------------------------------------------------------------------- */


$app -> get('/', function() use ( $app ) {

	return $app['twig'] -> render('index.html.twig');
}) -> bind('login');

$app -> post('/auth', function() use ( $app ) {
	session_start();

	/** @var $conn mysqli */
	$conn = $app['db'];

	if(isset($_POST['login-submit'])) {

		if(isset($_POST['login_username']))
			$username=$_POST['login_username'];
		else
			die("no username passed");
		if(isset($_POST['login_password']))
			$password=$_POST['login_password'];
		else
			die("no password passed");

		$query="select * from users where user_name='$username' and user_password='$password'";

		$result=$conn->query($query);

		if($result == false)
			echo "errore di autenticazione";
		else{

			$row = $result->fetch_assoc();



			$_SESSION["user_name"] = $row["user_name"];
			//$_SESSION["type"] = $row["type"];
			$_SESSION["user_password"] = $row["user_password"];

			$result->free();
			$conn->close();

			return $app -> redirect( $app["url_generator"] -> generate('core'));
		}

	}
	else if(isset($_POST['register-submit'])) {

		if(isset($_POST['register_username']) && !empty($_POST['register_username']))
			$username=$_POST['register_username'];
		else die("no username passed");
		if(isset($_POST['register_email']) && !empty($_POST['register_email']))
			$email=$_POST['register_email'];
		else die("no email passed");
		if(isset($_POST['register_password']) && !empty($_POST['register_password']))
			$password=$_POST['register_password'];
		else die("no password passed");

		$query="INSERT INTO users (user_name,user_email,user_password) VALUES ('$username','$email','$password') ";

		$conn -> query( $query );

		return $app -> redirect( $app["url_generator"] -> generate('login'));
	}

	return $app -> redirect('/');
}) -> bind('auth');

$app -> get('/core', function() use ( $app ) {

	session_start();
	if (!isset($_SESSION['user_name'], $_SESSION['user_password'])) die("You are not authorized");
	return $app['twig'] -> render('core.html.twig');

}) -> bind('core');

$app -> post('/query', function() use ( $app ) {
	$json=json_decode(file_get_contents('php://input'),true);

	/** @var $conn mysqli */
	$conn = $app['db'];

	// POPOLAMENTO DATABASE
	$query = 'insert into vta(';
	foreach( $json as $key => $value )
	{
		$query .= $key . ', ';
	}
	$query=substr($query,0,strlen($query)-2);

	$query .= ' ) values (';

	foreach( $json as $key => $value )
	{
		if( is_numeric( $value ))
			$query .= $value . ', ';
		else
			$query .= '\'' . $value . '\', ';
	}
	$query=substr($query,0,strlen($query)-2);


	$query .= ' );';

	$result=$conn->query($query);
	$conn->close();

	if($result == false)
	{
		return $app -> json("ERROR: Unable to store vta on db. Query= ".$query);
	}
	else
	{
		return $app -> json("Successfully executed query");
	}
});

$app -> get('/populates', function () use ( $app ) {

	/** @var $conn mysqli */
	$conn = $app['db'];

	$query="SELECT * FROM vta WHERE id=(SELECT MAX(id) FROM vta)";

	$result=$conn->query($query);
	$conn -> close();

	if($result == false)
		return $app -> json("ERROR: unable to retrieve data. Query= ".$query);
	else {
		$row= $result->fetch_assoc();
		return $app -> json($row);
	}
});

$app -> get('/table', function () use ( $app ) {

	/** @var $conn mysqli */
	$conn = $app['db'];

	$query="SELECT * FROM vta";

	$result=$conn->query($query);
	$conn->close();

	if($result == false)
		return $app -> json("ERROR: unable to retrieve data. Query= ".$query);
	else {
		$superrisultato = [];
		while( $row= $result->fetch_assoc() )
		{
			$superrisultato = array_merge( $superrisultato, [$row] );
		}
		return $app -> json($superrisultato);
	}
});

$app -> get('/install', function() use ( $app ) {

	/** @var $database mysqli */
	$database = $app['db'];

	$query = <<<'QUERY'
CREATE TABLE IF NOT EXISTS users (
  user_id int(11) NOT NULL,
  user_name varchar(64) NOT NULL,
  user_email varchar(254) NOT NULL,
  user_password varchar(254) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3;
QUERY;

	$result = $database -> query( $query );

	if( $result )
	{
		print 'Creazione tabella users riuscita <br />' . PHP_EOL;
	}
	else
	{
		die('Creazione tabella users non riuscita');
	}

	$query = <<<'QUERY'
CREATE TABLE IF NOT EXISTS vta (
  id int(6) unsigned NOT NULL,
  numero int(10) unsigned NOT NULL DEFAULT '7',
  localita varchar(60) NOT NULL,
  codice_ambito int(10) unsigned NOT NULL DEFAULT '7',
  genere varchar(60) NOT NULL,
  specie varchar(60) NOT NULL,
  varieta varchar(60) NOT NULL,
  altezza int(10) unsigned NOT NULL DEFAULT '7',
  diametro_fusto int(10) unsigned NOT NULL DEFAULT '7',
  altezza_fusto_libero int(10) unsigned NOT NULL DEFAULT '7',
  diametro_chioma int(10) unsigned NOT NULL DEFAULT '7',
  monumentale int(10) unsigned NOT NULL DEFAULT '7',
  maturo int(10) unsigned NOT NULL DEFAULT '7',
  adulto int(10) unsigned NOT NULL DEFAULT '7',
  neo_impianto int(10) unsigned NOT NULL DEFAULT '7',
  ceppaia_sede_vuota int(10) unsigned NOT NULL DEFAULT '7',
  morta int(10) unsigned NOT NULL DEFAULT '7',
  carpofori_castello int(10) unsigned NOT NULL DEFAULT '7',
  cavita_esposte_castello int(10) unsigned NOT NULL DEFAULT '7',
  cavita_occulta_castello int(10) unsigned NOT NULL DEFAULT '7',
  codominio_corteccia_inclusa_castello int(10) unsigned NOT NULL DEFAULT '7',
  essudati_castello int(10) unsigned NOT NULL DEFAULT '7',
  ferite_da_taglio_aperte_castello int(10) unsigned NOT NULL DEFAULT '7',
  ferite_da_taglio_marcescenti_castello int(10) unsigned NOT NULL DEFAULT '7',
  ferite_rimarginate_castello int(10) unsigned NOT NULL DEFAULT '7',
  fessurazioni_castello int(10) unsigned NOT NULL DEFAULT '7',
  cavita_occulta_orifizi_castello int(10) unsigned NOT NULL DEFAULT '7',
  branche_capitozzate_chioma int(10) unsigned NOT NULL DEFAULT '7',
  branche_chioma_asimmetrica_chioma int(10) unsigned NOT NULL DEFAULT '7',
  branche_pericolanti_chioma int(10) unsigned NOT NULL DEFAULT '7',
  carpofori_chioma int(10) unsigned NOT NULL DEFAULT '7',
  cavita_esposta_carie_chioma int(10) unsigned NOT NULL DEFAULT '7',
  chioma_filata_chioma int(10) unsigned NOT NULL DEFAULT '7',
  filloptosi_diffusa_seccume_chioma int(10) unsigned NOT NULL DEFAULT '7',
  filloptosi_parziale_chioma int(10) unsigned NOT NULL DEFAULT '7',
  monconi_chioma int(10) unsigned NOT NULL DEFAULT '7',
  monconi_necrotizzati_chioma int(10) unsigned NOT NULL DEFAULT '7',
  orifizi_cavita_chioma int(10) unsigned NOT NULL DEFAULT '7',
  spiombatura_fuori_asse_chioma int(10) unsigned NOT NULL DEFAULT '7',
  spiombatura_in_asse_chioma int(10) unsigned NOT NULL DEFAULT '7',
  colletto_esame_strumentale int(10) unsigned NOT NULL DEFAULT '7',
  fusto_esame_strumentale int(10) unsigned NOT NULL DEFAULT '7',
  forcella_esame_strumentale int(10) unsigned NOT NULL DEFAULT '7',
  branche_primarie_esame_strumentale int(10) unsigned NOT NULL DEFAULT '7',
  controllo_in_quota_esame_strumentale int(10) unsigned NOT NULL DEFAULT '7',
  copertura_vegetale_tipologia_pavimentazione int(10) unsigned NOT NULL DEFAULT '7',
  asfalto_tipologia_pavimentazione int(10) unsigned NOT NULL DEFAULT '7',
  naturale_stabilizzato_tipologia_pavimentazione int(10) unsigned NOT NULL DEFAULT '7',
  martello_ad_impulsi_tipologia_pavimentazione int(10) unsigned NOT NULL DEFAULT '7',
  resistograph_tipologia_pavimentazione int(10) unsigned NOT NULL DEFAULT '7',
  frattometro_tipologia_pavimentazione int(10) unsigned NOT NULL DEFAULT '7',
  tomografo_tipologia_pavimentazione int(10) unsigned NOT NULL DEFAULT '7',
  manufatti_parcheggio_bersaglio int(10) unsigned NOT NULL DEFAULT '7',
  area_verde_bersaglio int(10) unsigned NOT NULL DEFAULT '7',
  area_mercatale_bersaglio int(10) unsigned NOT NULL DEFAULT '7',
  viabilita_banchina_bersaglio int(10) unsigned NOT NULL DEFAULT '7',
  zona_pedonale_bersaglio int(10) unsigned NOT NULL DEFAULT '7',
  parcheggio_bersaglio int(10) unsigned NOT NULL DEFAULT '7',
  verde_scolastico_bersaglio int(10) unsigned NOT NULL DEFAULT '7',
  capitozzo_bersaglio int(10) unsigned NOT NULL DEFAULT '7',
  carpofori_diffusi_bersaglio int(10) unsigned NOT NULL DEFAULT '7',
  carpofori_localizzati_bersaglio int(10) unsigned NOT NULL DEFAULT '7',
  cavita_esposta_carie_bersaglio int(10) unsigned NOT NULL DEFAULT '7',
  cavita_occulta_sospetta_bersaglio int(10) unsigned NOT NULL DEFAULT '7',
  codominio_corteccia_inclusa_bersaglio int(10) unsigned NOT NULL DEFAULT '7',
  costolature_elicoidali_bersaglio int(10) unsigned NOT NULL DEFAULT '7',
  costolature_longitudinali_bersaglio int(10) unsigned NOT NULL DEFAULT '7',
  crack_da_compressione_bersaglio int(10) unsigned NOT NULL DEFAULT '7',
  crack_da_trazione_bersaglio int(10) unsigned NOT NULL DEFAULT '7',
  cretto_corteccia_inclusa_bersaglio int(10) unsigned NOT NULL DEFAULT '7',
  cretto_elicoidale_bersaglio int(10) unsigned NOT NULL DEFAULT '7',
  cretto_radiale_bersaglio int(10) unsigned NOT NULL DEFAULT '7',
  danni_da_fulmine_bersaglio int(10) unsigned NOT NULL DEFAULT '7',
  decortazione_diffusa_bersaglio int(10) unsigned NOT NULL DEFAULT '7',
  decortazione_superficiale_bersaglio int(10) unsigned NOT NULL DEFAULT '7',
  decadimenti_necrosi_bersaglio int(10) unsigned NOT NULL DEFAULT '7',
  essudati_bersaglio int(10) unsigned NOT NULL DEFAULT '7',
  ferite_da_taglio_marcescenti_bersaglio int(10) unsigned NOT NULL DEFAULT '7',
  ferite_rimarginate_bersaglio int(10) unsigned NOT NULL DEFAULT '7',
  forma_a_bottiglia_bersaglio int(10) unsigned NOT NULL DEFAULT '7',
  fusto_inclinato_bersaglio int(10) unsigned NOT NULL DEFAULT '7',
  fusto_molto_inclinato_bersaglio int(10) unsigned NOT NULL DEFAULT '7',
  inclusione_di_corteccia_bersaglio int(10) unsigned NOT NULL DEFAULT '7',
  insetti_xilofagi_bersaglio int(10) unsigned NOT NULL DEFAULT '7',
  ipertrofie_iperplasia_bersaglio int(10) unsigned NOT NULL DEFAULT '7',
  lesioni_aperte_bersaglio int(10) unsigned NOT NULL DEFAULT '7',
  lesioni_cicatrizzate_bersaglio int(10) unsigned NOT NULL DEFAULT '7',
  orifizi_fessure_bersaglio int(10) unsigned NOT NULL DEFAULT '7',
  ricacci_diffusi_bersaglio int(10) unsigned NOT NULL DEFAULT '7',
  rigonfiamento_anulare_bersaglio int(10) unsigned NOT NULL DEFAULT '7',
  rigonfiamento_unilaterale_bersaglio int(10) unsigned NOT NULL DEFAULT '7',
  fessurazioni_bersaglio int(10) unsigned NOT NULL DEFAULT '7',
  torsione_del_fusto_bersaglio int(10) unsigned NOT NULL DEFAULT '7',
  carpofori_diffusi_colletto int(10) unsigned NOT NULL DEFAULT '7',
  carpofori_localizzati_colletto int(10) unsigned NOT NULL DEFAULT '7',
  cavita_esposte_carie_colletto int(10) unsigned NOT NULL DEFAULT '7',
  cavita_occulta_sospetta_colletto int(10) unsigned NOT NULL DEFAULT '7',
  codominanze_colletto int(10) unsigned NOT NULL DEFAULT '7',
  colletto_interrato_colletto int(10) unsigned NOT NULL DEFAULT '7',
  contrafforte_con_controservizi_colletto int(10) unsigned NOT NULL DEFAULT '7',
  contrafforte_di_reazione_colletto int(10) unsigned NOT NULL DEFAULT '7',
  contrafforte_lesionato_colletto int(10) unsigned NOT NULL DEFAULT '7',
  decadimento_profondo_colletto int(10) unsigned NOT NULL DEFAULT '7',
  decadimento_superficiale_colletto int(10) unsigned NOT NULL DEFAULT '7',
  decorticazione_colletto int(10) unsigned NOT NULL DEFAULT '7',
  decorticazioni_diffuse_colletto int(10) unsigned NOT NULL DEFAULT '7',
  depressioni_e_concavita_colletto int(10) unsigned NOT NULL DEFAULT '7',
  falso_colletto_colletto int(10) unsigned NOT NULL DEFAULT '7',
  inclusioni_corpi_estranei_colletto int(10) unsigned NOT NULL DEFAULT '7',
  insetti_xilofagi_colletto int(10) unsigned NOT NULL DEFAULT '7',
  ipertrofie_iperplaste_colletto int(10) unsigned NOT NULL DEFAULT '7',
  lesioni_aperte_colletto int(10) unsigned NOT NULL DEFAULT '7',
  lesioni_cicatrizzate_colletto int(10) unsigned NOT NULL DEFAULT '7',
  micelio_diffuso_colletto int(10) unsigned NOT NULL DEFAULT '7',
  micelio_localizzato_colletto int(10) unsigned NOT NULL DEFAULT '7',
  orifizio_fessura_colletto int(10) unsigned NOT NULL DEFAULT '7',
  piede_espanso_a_cono_colletto int(10) unsigned NOT NULL DEFAULT '7',
  radici_strozzanti_colletto int(10) unsigned NOT NULL DEFAULT '7',
  radici_affioranti_decortic_colletto int(10) unsigned NOT NULL DEFAULT '7',
  radici_affioranti_colletto int(10) unsigned NOT NULL DEFAULT '7',
  rampicanti_colletto int(10) unsigned NOT NULL DEFAULT '7',
  ricacci_basali_colletto int(10) unsigned NOT NULL DEFAULT '7',
  sollevamento_zolla_colletto int(10) unsigned NOT NULL DEFAULT '7'
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=52;
QUERY;

	$result = $database -> query( $query );

	if( $result )
	{
		print 'Creazione tabella vta riuscita<br />' . PHP_EOL;
	}
	else
	{
		die('Creazione tabella vta non riuscita');
	}

	return 'Installazione completata <br />' . PHP_EOL;
});

$app -> run();