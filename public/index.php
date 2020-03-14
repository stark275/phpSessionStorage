<?php
/*
	CE TRAVAIL EST REALISE DANS LE CADRE DU COURS DE PHP DE G3 GENIE INFORMATIQUE
	EN FACULTE DES SCIENCES INFORMATIQUES

	TRAVAIL PRATIQUE NUMERO 1

	ETUDIANT : MUMBERE MALULE JACQUES
	DIRIGE PAR : Dr. PATRICK MUKALA

 */
	define('ROOT', dirname(__DIR__));
	require "../app/App.php";
	App::load();
	$urlParts = App::scanUrlNew();
	$controller = App::buildClassName($urlParts[0],'Controller');
	$action = $urlParts[1];
	$controller = new $controller();
	$controller->$action();
