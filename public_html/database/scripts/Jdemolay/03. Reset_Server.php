<?php
define ( 'SYSPATH', 1 );
include dirname(__FILE__) . '/../../../scripts/libs/KLogger.php';
include dirname(__FILE__) . "/../../../application/config/database.php";

$mysqli = mysqli_connect( 'localhost', $config['default']['connection']['user'], $config['default']['connection']['pass'] ) or die('error: cannot connect to database');

if ($mysqli == false) {
	die(mysqli_error($mysqli));
}
$mysqli->select_db($config['default']['connection']['database'] );
$log = new KLogger('reset_server.log', 'debug');

$log->LogDebug('--- start ---');
$log->LogDebug('Connecting to jdemolay db...');

try {
	
	$mysqli->query("set autocommit = 0");
	$mysqli->query("start transaction");
	$mysqli->query("begin");
		
	//Recupero vecchie capitali
	
	$log->LogDebug('-> Recovering old capitals...');

	/*
	$urbino = $mysqli->query ("SELECT * FROM kingdoms WHERE name like '%urbino%'") or die (mysqli_error($mysqli));
	if (mysqli_num_rows($urbino)==0)
		#$mysqli->query("INSERT INTO `kingdoms` (`id`, `name`, `image`, `status`, `title`, `slogan`, `color`, `language1`, `language2`, `lastattacked`, `activityscore`, `forumurl`) VALUES (NULL, 'kingdoms.duchy-urbino', 'duchy-urbino', '', 'global.title_grandduke', '', '#7bc7ff', '', '', NULL, 0.00000, NULL);
		$mysqli->query("INSERT INTO `kingdoms` (`name`, `image`, `status`, `title`, `slogan`, `color`, `language1`, `language2`, `lastattacked`, `activityscore`, `forumurl`) VALUES ('kingdoms.duchy-urbino', 'duchy-urbino', '', 'global.title_grandduke', '', '#7bc7ff', '', '', NULL, 0.00000, NULL);
	") or die ( mysqli_error($mysqli));
	 */

	$log->LogDebug('-> updating regions...');
	
	$mysqli->query("update regions set capital=1, kingdom_id = ( select id from kingdoms where name ='kingdoms.duchy-normandia') where name = 'regions.avranches'") or die( mysqli_error($mysqli));
	$mysqli->query("update regions set capital=1, kingdom_id = ( select id from kingdoms where name ='kingdoms.kingdom-serbia') where name = 'regions.beograde'") or die( mysqli_error($mysqli));
	$mysqli->query("update regions set capital=1, kingdom_id = ( select id from kingdoms where name ='kingdoms.empire-byzantine') where name = 'regions.konstantinoupolis'") or die( mysqli_error($mysqli));
	$mysqli->query("update regions set capital=1, kingdom_id = ( select id from kingdoms where name ='kingdoms.duchy-aquitania') where name = 'regions.bordeaux'") or die( mysqli_error($mysqli));
	$mysqli->query("update regions set capital=1, kingdom_id = ( select id from kingdoms where name ='kingdoms.duchy-sassonia') where name = 'regions.bremen'") or die( mysqli_error($mysqli));
	$mysqli->query("update regions set capital=1, kingdom_id = ( select id from kingdoms where name ='kingdoms.county-fiandre') where name = 'regions.brugge'") or die( mysqli_error($mysqli));
	$mysqli->query("update regions set capital=1, kingdom_id = ( select id from kingdoms where name ='kingdoms.kingdom-castiglia') where name = 'regions.burgos'") or die( mysqli_error($mysqli));
	$mysqli->query("update regions set capital=1, kingdom_id = ( select id from kingdoms where name ='kingdoms.kingdom-ottoman') where name = 'regions.bursa'") or die( mysqli_error($mysqli));
	$mysqli->query("update regions set capital=1, kingdom_id = ( select id from kingdoms where name ='kingdoms.kingdom-sardegna') where name = 'regions.cagliari'") or die( mysqli_error($mysqli));
	$mysqli->query("update regions set capital=1, kingdom_id = ( select id from kingdoms where name ='kingdoms.kingdom-mamluk') where name = 'regions.cairo'") or die( mysqli_error($mysqli));
	$mysqli->query("update regions set capital=1, kingdom_id = ( select id from kingdoms where name ='kingdoms.kingdom-cyrene') where name = 'regions.derne'") or die( mysqli_error($mysqli));
	$mysqli->query("update regions set capital=1, kingdom_id = ( select id from kingdoms where name ='kingdoms.kingdom-bulgaria') where name = 'regions.tyrnovo'") or die( mysqli_error($mysqli));
	$mysqli->query("update regions set capital=1, kingdom_id = ( select id from kingdoms where name ='kingdoms.kingdom-irlanda') where name = 'regions.dublin'") or die( mysqli_error($mysqli));
	$mysqli->query("update regions set capital=1, kingdom_id = ( select id from kingdoms where name ='kingdoms.kingdom-albania') where name = 'regions.dyrrachion'") or die( mysqli_error($mysqli));
	$mysqli->query("update regions set capital=1, kingdom_id = ( select id from kingdoms where name ='kingdoms.duchy-ferrara') where name = 'regions.ferrara'") or die( mysqli_error($mysqli));
	$mysqli->query("update regions set capital=1, kingdom_id = ( select id from kingdoms where name ='kingdoms.republic-firenze') where name = 'regions.firenze'") or die( mysqli_error($mysqli));
	$mysqli->query("update regions set capital=1, kingdom_id = ( select id from kingdoms where name ='kingdoms.republic-genova') where name = 'regions.genoa'") or die( mysqli_error($mysqli));
	$mysqli->query("update regions set capital=1, kingdom_id = ( select id from kingdoms where name ='kingdoms.sultanate-granada') where name = 'regions.granada'") or die( mysqli_error($mysqli));
	$mysqli->query("update regions set capital=1, kingdom_id = ( select id from kingdoms where name ='kingdoms.principality-galles') where name = 'regions.gwynnedd'") or die( mysqli_error($mysqli));
	$mysqli->query("update regions set capital=1, kingdom_id = ( select id from kingdoms where name ='kingdoms.kingdom-seljuq') where name = 'regions.ikonion'") or die( mysqli_error($mysqli));
	$mysqli->query("update regions set capital=1, kingdom_id = ( select id from kingdoms where name ='kingdoms.kingdom-jerusalem') where name = 'regions.jerusalem'") or die( mysqli_error($mysqli));
	$mysqli->query("update regions set capital=1, kingdom_id = ( select id from kingdoms where name ='kingdoms.principality-kiev') where name = 'regions.kiev'") or die( mysqli_error($mysqli));
	$mysqli->query("update regions set capital=1, kingdom_id = ( select id from kingdoms where name ='kingdoms.kingdom-prussia') where name = 'regions.konigsberg'") or die( mysqli_error($mysqli));
	$mysqli->query("update regions set capital=1, kingdom_id = ( select id from kingdoms where name ='kingdoms.kingdom-polonia') where name = 'regions.krakowskie'") or die( mysqli_error($mysqli));
	$mysqli->query("update regions set capital=1, kingdom_id = ( select id from kingdoms where name ='kingdoms.kingdom-portogallo') where name = 'regions.lisboa'") or die( mysqli_error($mysqli));
	$mysqli->query("update regions set capital=1, kingdom_id = ( select id from kingdoms where name ='kingdoms.kingdom-inghilterra') where name = 'regions.london'") or die( mysqli_error($mysqli));
	$mysqli->query("update regions set capital=1, kingdom_id = ( select id from kingdoms where name ='kingdoms.kingdom-scozia') where name = 'regions.lothian'") or die( mysqli_error($mysqli));
	$mysqli->query("update regions set capital=1, kingdom_id = ( select id from kingdoms where name ='kingdoms.duchy-milano') where name = 'regions.lombardia'") or die( mysqli_error($mysqli));
	$mysqli->query("update regions set capital=1, kingdom_id = ( select id from kingdoms where name ='kingdoms.kingdom-napoli') where name = 'regions.napoli'") or die( mysqli_error($mysqli));
	$mysqli->query("update regions set capital=1, kingdom_id = ( select id from kingdoms where name ='kingdoms.duchy-baviera') where name = 'regions.oberbayern'") or die( mysqli_error($mysqli));
	$mysqli->query("update regions set capital=1, kingdom_id = ( select id from kingdoms where name ='kingdoms.kingdom-sweden') where name = 'regions.ostergot-land'") or die( mysqli_error($mysqli));
	$mysqli->query("update regions set capital=1, kingdom_id = ( select id from kingdoms where name ='kingdoms.kingdom-sicilia') where name = 'regions.palermo'") or die( mysqli_error($mysqli));
	$mysqli->query("update regions set capital=1, kingdom_id = ( select id from kingdoms where name ='kingdoms.kingdom-francia') where name = 'regions.ile-de-france'") or die( mysqli_error($mysqli));
	#$log->LogDebug('-> no error');
	#$mysqli->query("update regions set capital=1, kingdom_id = ( select id from kingdoms where name ='kingdoms.kingdom-ungheria') where name = 'regions.pest'") or die( mysqli_error($mysqli));
	#$log->LogDebug('-> no error');
	$mysqli->query("update regions set capital=1, kingdom_id = ( select id from kingdoms where name ='kingdoms.kingdom-boemia') where name = 'regions.praha'") or die( mysqli_error($mysqli));
	$mysqli->query("update regions set capital=1, kingdom_id = ( select id from kingdoms where name ='kingdoms.republic-roma') where name = 'regions.roma'") or die( mysqli_error($mysqli));
	$mysqli->query("update regions set capital=1, kingdom_id = ( select id from kingdoms where name ='kingdoms.duchy-savoia') where name = 'regions.savoy'") or die( mysqli_error($mysqli));
	$mysqli->query("update regions set capital=1, kingdom_id = ( select id from kingdoms where name ='kingdoms.republic-siena') where name = 'regions.siena'") or die( mysqli_error($mysqli));
	$mysqli->query("update regions set capital=1, kingdom_id = ( select id from kingdoms where name ='kingdoms.kingdom-danimarca') where name = 'regions.sjaelland'") or die( mysqli_error($mysqli));
	$mysqli->query("update regions set capital=1, kingdom_id = ( select id from kingdoms where name ='kingdoms.principality-valacchia') where name = 'regions.turnu'") or die( mysqli_error($mysqli));
	#$log->LogDebug('-> no error');
	#$mysqli->query("update regions set capital=1, kingdom_id = ( select id from kingdoms where name ='kingdoms.duchy-urbino') where name = 'regions.urbino'") or die( mysqli_error($mysqli));
	#$log->LogDebug('-> no error');
	$mysqli->query("update regions set capital=1, kingdom_id = ( select id from kingdoms where name ='kingdoms.kingdom-aragona') where name = 'regions.valencia'") or die( mysqli_error($mysqli));
	$log->LogDebug('-> no error');
	$mysqli->query("update regions set capital=1, kingdom_id = ( select id from kingdoms where name ='kingdoms.republic-venezia') where name = 'regions.venezia'") or die( mysqli_error($mysqli));
	$mysqli->query("update regions set capital=1, kingdom_id = ( select id from kingdoms where name ='kingdoms.grand-duchy-lithuania') where name = 'regions.vilnius'") or die( mysqli_error($mysqli));

	/*
	$log->LogDebug('-> Removing unwanted Kingdoms...');
	
	// Rimozione vecchi regni mergiati e relative regioni
	
	$mysqli->query("
	update regions 
	set capital = false, 
	status = 'disabled',
	kingdom_id = 37 
	where kingdom_id in
	(select id from kingdoms where name in
	(
		'kingdoms.duchy-sassonia',
		'kingdoms.county-fiandre',
		'kingdoms.kingdom-irlanda',
		'kingdoms.grand-duchy-lithuania',
		'kingdoms.kingdom-sweden',
		'kingdoms.kingdom-prussia',
		'kingdoms.kingdom-danimarca',
		'kingdoms.kingdom-ottoman',
		'kingdoms.kingdom-seljuq',
		'kingdoms.kingdom-jerusalem',
		'kingdoms.kingdom-italy',
		'kingdoms.kingdom-sardegna',
		'kingdoms.kingdom-napoli',
		'kingdoms.republic-siena',
		'kingdoms.despotate-odrin',
		'kingdoms.kingdom-mamluk',
		'kingdoms.kingdom-cyrene',
		'kingdoms.kingdom-portogallo',
		'kingdoms.kingdom-inghilterra',
		'kingdoms.principality-galles',
		'kingdoms.kingdom-scozia',
		'kingdoms.kingdom-sweden'
	)); ") or die( mysqli_error($mysqli));
	
	$mysqli->query("update kingdoms
	set status = 'deleted'
	where name in
	(
	'kingdoms.duchy-sassonia',
	'kingdoms.county-fiandre',
	'kingdoms.kingdom-irlanda',
	'kingdoms.grand-duchy-lithuania',
	'kingdoms.kingdom-sweden',
	'kingdoms.kingdom-prussia',
	'kingdoms.kingdom-danimarca',
	'kingdoms.kingdom-ottoman',
	'kingdoms.kingdom-seljuq',
	'kingdoms.kingdom-jerusalem',
	'kingdoms.kingdom-italy',
	'kingdoms.kingdom-sardegna',
	'kingdoms.kingdom-napoli',
	'kingdoms.republic-siena',
	'kingdoms.despotate-odrin',
	'kingdoms.kingdom-mamluk',
	'kingdoms.kingdom-cyrene',
	'kingdoms.kingdom-portogallo',
	'kingdoms.kingdom-inghilterra',
	'kingdoms.principality-galles',
	'kingdoms.kingdom-scozia',
	'kingdoms.kingdom-sweden'
	);") or die( mysqli_error($mysqli));
	 */

	#set status='disabled', kingdom_id = 37 
	$mysqli->query("
	update regions 
	set kingdom_id = 37 
	where name in 
	(
	'regions.forcalquier',
	'regions.provence',
	'regions.venaissin',
	'regions.mainz',
	'regions.pfalz',
	'regions.nordgau',
	'regions.thouars',
	'regions.auvergne',
	'regions.forez',
	'regions.viviers',
	'regions.gevaudan',
	'regions.rouergue',
	'regions.toulouse',
	'regions.carcassonne',
	'regions.montpellier',
	'regions.narbonne',
	'regions.foix',
	'regions.rosello',
	'regions.urgell',
	'regions.empuries',
	'regions.lieida',
	'regions.barcelona',
	'regions.tarragona',
	'regions.compostela',
	'regions.santiago',
	'regions.el-bierzo',
	'regions.porto',
	'regions.braganza',
	'regions.zamora',
	'regions.coimbra',
	'regions.castelo branco',
	'regions.salamanca',
	'regions.lisboa',
	'regions.aicacer-do-sal',
	'regions.silves',
	'regions.faro',
	'regions.niebla',
	'regions.aracena',
	'regions.cadiz',
	'regions.sevilla',
	'regions.algeciras',
	'regions.malaga',
	'regions.evora',
	'regions.alcantara',
	'regions.plasencia',
	'regions.mertola',
	'regions.caceres',
	'regions.badajoz',
	'regions.lion',
	'regions.denthlivre',
	'regions.cornouaille',
	'regions.nantes',
	'regions.vannes',
	'regions.brugge',
	'regions.gent',
	'regions.liege',
	'regions.luxembourg',
	'regions.andernach',
	'regions.julich',
	'regions.loon',
	'regions.breda',
	'regions.zeeland',
	'regions.cornwall',
	'regions.exeter',
	'regions.devon',
	'regions.dorset',
	'regions.sommerset',
	'regions.hampshire',
	'regions.sussex',
	'regions.kent',
	'regions.surrey',
	'regions.salisbury',
	'regions.bristol',
	'regions.oxford',
	'regions.essex',
	'regions.norfolk',
	'regions.suffolk',
	'regions.lincoln',
	'regions.northampton',
	'regions.warwick',
	'regions.hereford',
	'regions.gwent',
	'regions.london',
	'regions.leicester',
	'regions.derby',
	'regions.lancaster',
	'regions.york',
	'regions.chester',
	'regions.powys',
	'regions.gwynnedd',
	'regions.glamorgan',
	'regions.dyfed',
	'regions.perfed-dwald',
	'regions.glocester',
	'regions.shrewsbury',
	'regions.westmorland',
	'regions.durkham',
	'regions.cumberland',
	'regions.north-cumberland',
	'regions.birwick',
	'regions.galloway',
	'regions.carrick',
	'regions.argyll',
	'regions.atholl',
	'regions.angus',
	'regions.moray',
	'regions.mar ',
	'regions.buchan',
	'regions.ross',
	'regions.sutherland',
	'regions.fife',
	'regions.caithness',
	'regions.strathclyde',
	'regions.lothian',
	'regions.desmumu',
	'regions.urmumu',
	'regions.tuadmumu',
	'regions.laigin',
	'regions.galway',
	'regions.mide',
	'regions.osraigh',
	'regions.dublin',
	'regions.ulaid',
	'regions.tir-loghain',
	'regions.tir-connah',
	'regions.mayd',
	'regions.ziigo',
	'regions.bremen',
	'regions.celle',
	'regions.lueneburg',
	'regions.altmark',
	'regions.anhalt',
	'regions.leipzig',
	'regions.thueringen',
	'regions.weimar',
	'regions.nirsau',
	'regions.koln',
	'regions.goettingen',
	'regions.kleve',
	'regions.munster',
	'regions.braunschweig',
	'regions.oldenburg',
	'regions.osnabrueck',
	'regions.ostfriesland',
	'regions.frisia',
	'regions.gelre',
	'regions.westfriesland',
	'regions.holland',
	'regions.utrecht',
	'regions.jylland',
	'regions.slesvig',
	'regions.fyn',
	'regions.sjaelland',
	'regions.holstein',
	'regions.hamburg',
	'regions.luebeck',
	'regions.mecklenburg',
	'regions.rosrock',
	'regions.werle',
	'regions.wolgagt',
	'regions.brandenburg',
	'regions.lausitz',
	'regions.bergenshus',
	'regions.oppland',
	'regions.varmland',
	'regions.dalarna',
	'regions.gastrikland',
	'regions.uppland',
	'regions.soderman-land',
	'regions.ostergot-land',
	'regions.smaland',
	'regions.kalmarian',
	'regions.skanf',
	'regions.finnveden',
	'regions.halland',
	'regions.vastergotland',
	'regions.viken',
	'regions.daz',
	'regions.akershus',
	'regions.vestiold',
	'regions.agder',
	'regions.rogaland',
	'regions.telemark',
	'regions.narke',
	'regions.stettin',
	'regions.slupsk',
	'regions.danzig',
	'regions.lubusz',
	'regions.gnieznienskie',
	'regions.kujawy',
	'regions.kaliskie',
	'regions.wielkopolska',
	'regions.baden',
	'regions.fursten-berg',
	'regions.leiningen',
	'regions.franken',
	'regions.wurttemberg',
	'regions.ansbach',
	'regions.korsun',
	'regions.oleshye',
	'regions.lower-dniepr',
	'regions.crimea',
	'regions.theodosia',
	'regions.korchev',
	'regions.yalta',
	'regions.peresechen',
	'regions.olvia',
	'regions.belgoroc',
	'regions.naxos',
	'regions.rhodos',
	'regions.kafia',
	'regions.chadax',
	'regions.limisol',
	'regions.famagusta',
	'regions.ibiza',
	'regions.gotland',
	'regions.chelminskie',
	'regions.konigsberg',
	'regions.sambia',
	'regions.memel',
	'regions.kurs',
	'regions.zimigalians',
	'regions.vilnius',
	'regions.scalovia',
	'regions.galindia',
	'regions.mazowsze',
	'regions.yatviagi',
	'regions.sudovia',
	'regions.auksmayts',
	'regions.polotsk',
	'regions.minsk',
	'regions.podlasie',
	'regions.lublin',
	'regions.berestye',
	'regions.pinsk',
	'regions.turov',
	'regions.lyubech',
	'regions.chernigov',
	'regions.pereslavl',
	'regions.chortitza',
	'regions.lukomorie',
	'regions.lower-don',
	'regions.sirte',
	'regions.tini',
	'regions.zanara',
	'regions.bengasi',
	'regions.derne',
	'regions.ugrela',
	'regions.trobuch',
	'regions.cherfus',
	'regions.cazales',
	'regions.berton',
	'regions.nitriota',
	'regions.alexandria',
	'regions.cairo',
	'regions.damietta',
	'regions.suez',
	'regions.aggara',
	'regions.gazza',
	'regions.negev',
	'regions.edom',
	'regions.jerusalem',
	'regions.jaffa',
	'regions.moab',
	'regions.caesarea',
	'regions.golan',
	'regions.acre',
	'regions.tyrus',
	'regions.tortosa',
	'regions.antiochia',
	'regions.iskenderon',
	'regions.sis',
	'regions.amasya',
	'regions.sinope',
	'regions.kostamonou',
	'regions.ankara',
	'regions.yozgat',
	'regions.ikonion',
	'regions.adana',
	'regions.tarsos',
	'regions.dorylaion',
	'regions.nikomadeia',
	'regions.nicea',
	'regions.afyon',
	'regions.attaleia',
	'regions.myra',
	'regions.kutahya',
	'regions.smyrna',
	'regions.abydos',
	'regions.bursa')") or die (mysqli_error($mysqli));
	
	// Resetto tutte le regioni a indipendenti
	
	$log->LogDebug('Resetting independent regions...');

	$mysqli->query( "update regions set kingdom_id = 37 where capital = false") or die (mysqli_error($mysqli));

	$log->LogDebug('Reset Kingdoms...');
	
	//restore all kingdoms

	$mysqli->query( "update kingdoms set slogan='', language1 = '',
	language2='', lastattacked=null, activityscore=0, forumurl=null") or die (mysqli_error($mysqli));

	$mysqli->query( "delete from kingdoms_history") or die (mysqli_error($mysqli));

	// Rimuovo tutte le strutture
	

	$mysqli->query( "SET FOREIGN_KEY_CHECKS = 0;") or die (mysqli_error($mysqli));
	$mysqli->query( "truncate table structures") or die (mysqli_error($mysqli));
	$mysqli->query( "SET FOREIGN_KEY_CHECKS = 1;") or die (mysqli_error($mysqli));
	$log->LogDebug('-> Fixing diplomacy...');
	
	// Fix Capitals
	
	$log->LogDebug('Fixing capitals...');
	
	$capitals = $mysqli->query("select * from regions where capital = true") or die(mysqli_error($mysqli));
	while ( $row = mysqli_fetch_assoc( $capitals ) )
	{
			$log->LogDebug("Processing capital : {$row['name']}");
		
		// pal. reale
		$mysqli->query("insert into structures (
		id, parent_structure_id, structure_type_id, region_id, character_id, size) values (
		null, null, (select id from structure_types where type = 'royalpalace_1'),
		{$row['id']}, NULL, 'small')") or die(mysqli_error($mysqli));
		
		$royalpalaceid = $mysqli->insert_id;
		
		// castello
		$mysqli->query("insert into structures (
		id, parent_structure_id, structure_type_id, region_id, character_id, size) values (
		null, {$royalpalaceid}, (select id from structure_types where type = 'castle_1'),
		{$row['id']}, NULL, 'small')") or die(mysqli_error($mysqli));
		
		$castleid = $mysqli->insert_id;
		
		// tribunale
		$mysqli->query("insert into structures (
		id, parent_structure_id, structure_type_id, region_id, character_id, size) values (
		null, {$castleid}, (select id from structure_types where type = 'court_1'),
		{$row['id']}, NULL, 'small')") or die(mysqli_error($mysqli));
		
		// barracks
		$mysqli->query("insert into structures (
		id, parent_structure_id, structure_type_id, region_id, character_id, size) values (
		null, {$castleid}, (select id from structure_types where type = 'barracks_1'),
		{$row['id']}, NULL, 'small')") or die(mysqli_error($mysqli));
		
		$mysqli->query("insert into structures (
		id, parent_structure_id, structure_type_id, region_id, character_id, size) values (
		null, {$castleid}, (select id from structure_types where type = 'tavern_1'),
		{$row['id']}, NULL, 'small')") or die(mysqli_error($mysqli));
		
		$mysqli->query("insert into structures (
		id, parent_structure_id, structure_type_id, region_id, character_id, size) values (
		null, {$castleid}, (select id from structure_types where type = 'market_1'),
		{$row['id']}, NULL, 'small')") or die(mysqli_error($mysqli));

		# Add training grounds and academy to all kingdoms capitals
		# @jpicard
		$mysqli->query("insert into structures (
		id, parent_structure_id, structure_type_id, region_id, character_id, size) values (
		null, {$castleid}, (select id from structure_types where type = 'trainingground_1'),
		{$row['id']}, NULL, 'small')") or die(mysqli_error($mysqli));

		$mysqli->query("insert into structures (
		id, parent_structure_id, structure_type_id, region_id, character_id, size) values (
		null, {$castleid}, (select id from structure_types where type = 'academy_1'),
		{$row['id']}, NULL, 'small')") or die(mysqli_error($mysqli));
		
		$sql = "
			select rp.id  
			from regions_paths rp 
			where rp.region_id = {$row['id']}
			and   rp.type in ( 'sea', 'mixed' ) ";
		
		$paths = $mysqli->query($sql) or die (mysqli_error($mysqli));
		$regions = mysqli_num_rows($paths);
		
		if ( $regions > 0 ) 			
		{
			$log->LogDebug("Adding harbour in region: {$row['name']}");
			$mysqli->query("insert into structures (
			id, parent_structure_id, structure_type_id, region_id, character_id, size) values (
			null, null, (select id from structure_types where type = 'harbor_1'),
			{$row['id']}, NULL, 'small')") or die(mysqli_error($mysqli));
		}
		
		$mysqli->query("insert into structures (
		id, parent_structure_id, structure_type_id, region_id, character_id, size) values (
		null, null, (select id from structure_types where type = 'dump_1'),
		{$row['id']}, NULL, 'small')") or die(mysqli_error($mysqli));
		
	}
	
	// Fix Independent Regions
	$log->LogDebug('Fixing Independent regions...');
	
	$independentregions = $mysqli->query("
	select * from regions 
	where capital = false and kingdom_id = 37
	and type = 'land' ");
	while ( $row = mysqli_fetch_assoc( $independentregions ) )
	{
		
		
		
		$mysqli->query("insert into structures (
		id, parent_structure_id, structure_type_id, region_id, character_id, size) values (
		null, null, (select id from structure_types where type = 'nativevillage_1'),
		{$row['id']}, NULL, 'small')") or die(mysqli_error($mysqli));
		
		$mysqli->query("insert into structures (
		id, parent_structure_id, structure_type_id, region_id, character_id, size) values (
		null, null, (select id from structure_types where type = 'dump_1'),
		{$row['id']}, NULL, 'small')") or die(mysqli_error($mysqli));
		
	}
	
	// Fix Religious HQ
	$log->LogDebug('Fixing Religious HQ 1...');
	
	$mysqli->query("insert into structures (
		id, parent_structure_id, structure_type_id, region_id, character_id, size) values (
		null, null, (select id from structure_types where type = 'religion_1' and church_id = 1),
		(select id from regions where name = 'regions.roma'), NULL, 'small')") or die(mysqli_error($mysqli));
	
	$parentstructure_id = $mysqli->insert_id;
	
	$log->LogDebug('Fixing Religious HQ 2...');
	$mysqli->query("insert into structures (
		id, parent_structure_id, structure_type_id, region_id, character_id, size) values (
	null, {$parentstructure_id}, (select id from structure_types where type = 'religion_2' and church_id = 1),
		(select id from regions where name = 'regions.roma'), NULL, 'small')") or die(mysqli_error($mysqli));
	
	$parentstructure_id = $mysqli->insert_id;
	
	$log->LogDebug('Fixing Religious HQ 3...');
	$mysqli->query("insert into structures (
		id, parent_structure_id, structure_type_id, region_id, character_id, size) values (
	null, {$parentstructure_id}, (select id from structure_types where type = 'religion_3' and church_id = 1),
		(select id from regions where name = 'regions.roma'), NULL, 'small')") or die(mysqli_error($mysqli));
	
	$parentstructure_id = $mysqli->insert_id;
	
	$log->LogDebug('Fixing Religious HQ 4...');
	$mysqli->query("insert into structures (
		id, parent_structure_id, structure_type_id, region_id, character_id, size) values (
	null, {$parentstructure_id}, (select id from structure_types where type = 'religion_4' and church_id = 1),
		(select id from regions where name = 'regions.roma'), NULL, 'small')") or die(mysqli_error($mysqli));
	
	
	/*
	$log->LogDebug('Fixing Religious HQ 5...');
	$mysqli->query("insert into structures (
		id, parent_structure_id, structure_type_id, region_id, character_id, size) values (
		null, null, (select id from structure_types where type = 'religion_1' and church_id = 3),
		(select id from regions where name = 'regions.turnu'), NULL, 'small')") or die(mysqli_error($mysqli));
		
	$parentstructure_id = $mysqli->insert_id;
	
	$log->LogDebug('Fixing Religious HQ 6...');
	$mysqli->query("insert into structures (
		id, parent_structure_id, structure_type_id, region_id, character_id, size) values (
	null, {$parentstructure_id}, (select id from structure_types where type = 'religion_2' and church_id = 3),
		(select id from regions where name = 'regions.turnu'), NULL, 'small')") or die(mysqli_error($mysqli));
	
	$parentstructure_id = $mysqli->insert_id;
	
	$log->LogDebug('Fixing Religious HQ 7...');
	$mysqli->query("insert into structures (
		id, parent_structure_id, structure_type_id, region_id, character_id, size) values (
	null, {$parentstructure_id}, (select id from structure_types where type = 'religion_3' and church_id = 3),
		(select id from regions where name = 'regions.turnu'), NULL, 'small')") or die(mysqli_error($mysqli));
	
	$parentstructure_id = $mysqli->insert_id;
	
	$log->LogDebug('Fixing Religious HQ 8...');
	$mysqli->query("insert into structures (
		id, parent_structure_id, structure_type_id, region_id, character_id, size) values (
	null, {$parentstructure_id}, (select id from structure_types where type = 'religion_4' and church_id = 3),
		(select id from regions where name = 'regions.turnu'), NULL, 'small')") or die(mysqli_error($mysqli));
	 */
	
	$log->LogDebug('Fixing Religious HQ 9...');

	$mysqli->query("insert into structures (
		id, parent_structure_id, structure_type_id, region_id, character_id, size) values (
		null, null, (select id from structure_types where type = 'religion_1' and church_id = 5),
		(select id from regions where name = 'regions.cairo'), NULL, 'small')") or die(mysqli_error($mysqli));
		
	$parentstructure_id = $mysqli->insert_id;
	
	$log->LogDebug('Fixing Religious HQ 10...');
	$mysqli->query("insert into structures (
		id, parent_structure_id, structure_type_id, region_id, character_id, size) values (
	null, {$parentstructure_id}, (select id from structure_types where type = 'religion_2' and church_id = 5),
		(select id from regions where name = 'regions.cairo'), NULL, 'small')") or die(mysqli_error($mysqli));
	
	$parentstructure_id = $mysqli->insert_id;
	
	$log->LogDebug('Fixing Religious HQ 11...');
	$mysqli->query("insert into structures (
		id, parent_structure_id, structure_type_id, region_id, character_id, size) values (
	null, {$parentstructure_id}, (select id from structure_types where type = 'religion_3' and church_id = 5),
		(select id from regions where name = 'regions.cairo'), NULL, 'small')") or die(mysqli_error($mysqli));
	
	$parentstructure_id = $mysqli->insert_id;
	
	$log->LogDebug('Fixing Religious HQ 12...');
	$mysqli->query("insert into structures (
		id, parent_structure_id, structure_type_id, region_id, character_id, size) values (
	null, {$parentstructure_id}, (select id from structure_types where type = 'religion_4' and church_id = 5),
		(select id from regions where name = 'regions.cairo'), NULL, 'small')") or die(mysqli_error($mysqli));
			
	$log->LogDebug('Fixing Religious HQ 13...');
	$mysqli->query("insert into structures (
		id, parent_structure_id, structure_type_id, region_id, character_id, size) values (
		null, null, (select id from structure_types where type = 'religion_1' and church_id = 6),
		(select id from regions where name = 'regions.kiev'), NULL, 'small')") or die(mysqli_error($mysqli));
	
	$parentstructure_id = $mysqli->insert_id;
	
	$log->LogDebug('Fixing Religious HQ 14...');
	$mysqli->query("insert into structures (
		id, parent_structure_id, structure_type_id, region_id, character_id, size) values (
	null, {$parentstructure_id}, (select id from structure_types where type = 'religion_2' and church_id = 6),
		(select id from regions where name = 'regions.kiev'), NULL, 'small')") or die(mysqli_error($mysqli));
	
	$parentstructure_id = $mysqli->insert_id;
	
	$log->LogDebug('Fixing Religious HQ 15...');
	$mysqli->query("insert into structures (
		id, parent_structure_id, structure_type_id, region_id, character_id, size) values (
	null, {$parentstructure_id}, (select id from structure_types where type = 'religion_3' and church_id = 6),
		(select id from regions where name = 'regions.kiev'), NULL, 'small')") or die(mysqli_error($mysqli));
	
	$parentstructure_id = $mysqli->insert_id;
	
	$log->LogDebug('Fixing Religious HQ 16...');
	$mysqli->query("insert into structures (
		id, parent_structure_id, structure_type_id, region_id, character_id, size) values (
	null, {$parentstructure_id}, (select id from structure_types where type = 'religion_4' and church_id = 6),
		(select id from regions where name = 'regions.kiev'), NULL, 'small')") or die(mysqli_error($mysqli));
	
	
	$log -> LogDebug('Adding nativevillages to independent regions...');
	$rset = $mysqli->query("
	select distinct r.id, r.name, s.structure_type_id from regions r, structures s
	where r.kingdom_id = 37
	and   s.region_id = r.id 
	and   r.`type` != 'sea' 
	and   not exists
	(select * from structures where region_id = r.id and structure_type_id 
	= (select id from structure_types where type = 'nativevillage_1'));"
		) or die (mysqli_error($mysqli));
	
	while ( $row = mysqli_fetch_assoc( $rset ) )
		$mysqli->query("insert into structures (
		id, parent_structure_id, structure_type_id, region_id, character_id) values (
		null, null, (select id from structure_types where type = 'nativevillage_1'),
		{$row['id']}, NULL)") or die(mysqli_error($mysqli));
		
	// Rimuovo tutte le risorse.
	
	$log->LogDebug("-> Wiping resources...");
	// non cancello fish shoal.
	$mysqli->query ("delete from structures where structure_type_id in
		( select id from structure_types where parenttype in
		('fish_shoal', 'forest', 'mine', 'breeding_region'))") or die(mysqli_error($mysqli));
	$mysqli->query ("delete from structure_resources") or die(mysqli_error($mysqli));
	
	$log->LogDebug("-> Wiped resources.");
	
	// Riaggiungo le strutture
	
	$log->LogDebug("-> Reinserting resources....");
	
	// load resources
	$resources = 
		array(		
			'land' => array( 
				'forest' =>
					array(
						'mandragora' => array( 'small' => 250, 'medium' => 500, 'large' => 1000),
						'wood_piece' => array( 'small' => 250, 'medium' => 500, 'large' => 1000),
						'medmushroom' => array( 'small' => 250, 'medium' => 500, 'large' => 1000)					
					),
				'mine_iron' => array(
					'iron_piece' => array( 'small' => 250, 'medium' => 500, 'large' => 1000)),
				'mine_clay' => array('clay_piece' => array( 'small' => 250, 'medium' => 500, 'large' => 1000)),
				'breeding_cow_region' => array('cows' => array( 'small' => 20, 'medium' => 40, 'large' => 80)),
				'breeding_sheep_region' => array('sheeps' => array( 'small' => 250, 'medium' => 500, 'large' => 1000)),
				'mine_coal' => array('coal_piece' => array( 'small' => 250, 'medium' => 500, 'large' => 1000)),
				'mine_stone' => array('stone_piece' => array( 'small' => 250, 'medium' => 500, 'large' => 1000)),
				'breeding_bee_region' => array('bees' => array( 'small' => 5000, 'medium' => 10000, 'large' => 20000)),
				'breeding_pig_region' => array('pigs' => array( 'small' => 20, 'medium' => 40, 'large' => 80)),
				'mine_gold' => array('gold_piece' => array( 'small' => 250, 'medium' => 500, 'large' => 1000)),
				'saltern' => array('salt_heap' => array( 'small' => 250, 'medium' => 500, 'large' => 1000)),
				'cave_white_sand' => array('sand_heap' => array( 'small' => 250, 'medium' => 500, 'large' => 1000)),
				'breeding_silkworm_region' => array('silkworms' => array( 'small' => 500, 'medium' => 1000, 'large' => 2000)),
			),
			'sea' => array (
				'fish_shoal' => array('fish' => array( 'small' => 20, 'medium' => 40, 'large' => 80)),						
			)
		);
	
	$dimension = array('small', 'medium', 'large');	
	$log->LogDebug("-> Processing regions...");	
	$regions = $mysqli->query("select * from regions");
	
	while ( $row = mysqli_fetch_assoc( $regions ) )
	{
		
		$log->LogDebug("-> Processing region {$row['name']}...");
		$structure = array_rand($resources[$row['type']]);
		$size = $dimension[rand(0,2)];
		//$log->logDebug("-> Adding resource [{$structure}] size [{$size}] to region: {$row['name']}");
		
		$mysqli->query("insert into structures (
		id, parent_structure_id, structure_type_id, region_id, character_id, size) values (
		null, null, (select id from structure_types where type = '{$structure}'),
		{$row['id']}, NULL, '{$size}')") or die(mysqli_error($mysqli));
		
		$structure_id = $mysqli->insert_id;
		
		foreach ($resources[$row['type']][$structure] as $_resource => $_dimension)
		{
			$resourcesize = $_dimension[$size];
			$log->logDebug("-> Adding {$_resource} {$size} {$resourcesize} to region: {$row['name']}");
			$sql = "INSERT INTO `structure_resources` 
			VALUES (NULL, {$structure_id}, '{$_resource}', {$resourcesize}, {$resourcesize}, unix_timestamp()	)";
			//$log->LogDebug($sql);
			$mysqli->query($sql) or die(mysqli_error($mysqli));
				
		}
	
	}	
	
	// Fixing diplomacy
	$log->LogDebug('-> Fixing diplomacy...');	
	$mysqli->query("truncate table diplomacy_relations");
	$kingdomssource = $mysqli->query("select * from kingdoms_v") or die(mysqli_error($mysqli));
	$kingdomstarget = $mysqli->query("select * from kingdoms_v") or die(mysqli_error($mysqli));
	while ( $row = mysqli_fetch_assoc( $kingdomssource ))
	{
		while ( $row1 = mysqli_fetch_assoc( $kingdomstarget ))
		{
			$log->LogDebug("-> Fixing diplomacy {$row['name']} {$row1['name']}");	
			if ($row1['id'] != $row['id'] )	
				$mysqli->query("INSERT INTO `diplomacy_relations` (`id`, `sourcekingdom_id`, `targetkingdom_id`, `type`, `description`, `timestamp`, `signedby`) VALUES (NULL, {$row['id']}, {$row1['id']}, 'neutral', NULL, 
			unix_timestamp() - (15*24*3600), NULL );") or die(mysqli_error($mysqli));
		}
		mysqli_data_seek ( $kingdomstarget , 0 );
	}	
	$log->LogDebug('-> Fixing taxes...');	
	$mysqli->query("truncate table taxes");
	$mysqli->query("truncate table kingdom_taxes");
	$kingdoms = $mysqli->query("select * from kingdoms_v") or die(mysqli_error($mysqli));
	while ( $row = mysqli_fetch_assoc( $kingdoms ) )
	{
		$mysqli->query("INSERT INTO `taxes` (`id`, `tag`, `type`, `region_id`, `kingdom_id`, `name`, `description`, `value`) VALUES (NULL, 'kingdom_property', 'kingdom', NULL, {$row['id']}, 'taxes.kingdom_property', 'taxes.kingdom_property_desc', 5);") or die(mysqli_error($mysqli));
		
		$mysqli->query("INSERT INTO `taxes` (`id`, `tag`, `type`, `region_id`, `kingdom_id`, `name`, `description`, `value`) VALUES (NULL, 'kingdom_selling', 'kingdom', NULL, {$row['id']}, 'taxes.kingdom_selling', 'taxes.kingdom_selling_desc', 5);") or die(mysqli_error($mysqli));
		
		$mysqli->query("INSERT INTO `kingdom_taxes` (`id`, `kingdom_id`, `name`, `hostile`, `neutral`, `friendly`, `allied`, `citizen`) VALUES (NULL, {$row['id']}, 'distributiontax', 5, 5, 5, 5, 5);") or die(mysqli_error($mysqli));
		
	}
	$regions = $mysqli->query("select * from regions") or die(mysqli_error($mysqli));
	$mysqli->query("truncate table region_taxes") or die(mysqli_error($mysqli));
	
	while ( $row = mysqli_fetch_assoc( $regions ) )
	{
		
		$mysqli->query("INSERT INTO `taxes` (`id`, `tag`, `type`, `region_id`, `kingdom_id`, `name`, `description`, `value`) VALUES (NULL, 'region_selling', 'region', {$row['id']}, NULL, 'taxes.region_selling', 'taxes.region_selling_desc', 5);") or die(mysqli_error($mysqli));
		
		$mysqli->query("INSERT INTO `region_taxes` (`id`, `region_id`, `name`, `param1`, `hostile`, `neutral`, `friendly`, `allied`, `citizen`, `timestamp`) VALUES (NULL, {$row['id']}, 'valueaddedtax', NULL, 5, 5, 5, 5, 2, unix_timestamp())") or die(mysqli_error($mysqli));

	}

	/******************
	 * Custom fixes
	 *
	 * TODO: Figure out the root cause and fix them in a less hacky way
	 *
	 * @jpicard
	 * *****************/
	$log->LogDebug('-> Custom fixes..');
	
	//Fix independent regions
	$mysqli->query("UPDATE regions SET capital = '0' WHERE name = 'regions.siena';") or die( mysqli_error($mysqli));
	$mysqli->query("UPDATE regions SET capital = '0' WHERE name = 'regions.firenze';") or die( mysqli_error($mysqli));
	$mysqli->query("UPDATE regions SET kingdom_id = '37' WHERE name = 'regions.siena';") or die( mysqli_error($mysqli));
	$mysqli->query("UPDATE regions SET kingdom_id = '37' WHERE name = 'regions.firenze';") or die( mysqli_error($mysqli));

	//Fix broken kingdoms
	$mysqli->query("UPDATE regions SET kingdom_id = '19' WHERE name = 'regions.lothian';") or die(mysqli_error($mysqli));
	$mysqli->query("UPDATE regions SET kingdom_id = '28' WHERE name = 'regions.lisboa';") or die(mysqli_error($mysqli));
	$mysqli->query("UPDATE regions SET kingdom_id = '18' WHERE name = 'regions.london';") or die(mysqli_error($mysqli));
	$mysqli->query("UPDATE regions SET kingdom_id = '34' WHERE name = 'regions.sjaelland';") or die(mysqli_error($mysqli));
	$mysqli->query("UPDATE regions SET kingdom_id = '39' WHERE name = 'regions.konigsberg';") or die(mysqli_error($mysqli));
	$mysqli->query("UPDATE regions SET kingdom_id = '45' WHERE name = 'regions.bursa';") or die(mysqli_error($mysqli));
	$mysqli->query("UPDATE regions SET kingdom_id = '25' WHERE name = 'regions.brugge';") or die(mysqli_error($mysqli));
		
	$log->LogDebug('-> Committing...');
	$mysqli->query("commit");
	$log->LogDebug('-> Committed.');
	
}	catch (Exception $e)
{
		$log ->LogDebug( $e->getMessage() );
		$log->LogDebug('-> Rollbacking...');
		$mysqli->query("rollback");
		$log->LogDebug('-> Rollbacked');
}
?>
