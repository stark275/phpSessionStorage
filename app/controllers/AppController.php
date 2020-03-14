<?php 
/*
    CE TRAVAIL EST REALISE DANS LE CADRE DU COURS DE PHP DE G3 GENIE INFORMATIQUE
    EN FACULTE DES SCIENCES INFORMATIQUES

    TRAVAIL PRATIQUE NUMERO 1 : FACTURATION

    ETUDIANT : MUMBERE MALULE JACQUES
    DIRIGE PAR : Dr. PATRICK MUKALA

 */

/**
* Classe AppControlller
* Controller intermediaire reliant le controller principal
*  (Core\Controller\Controller) à aux controleur du namespace
*  (App\Controller)
*/
namespace App\Controller;
use Src\Controller\Controller;
use \App;

class AppController extends Controller
{	
	/**
	 * [$app description]
	 * @var \App
	 */
	protected $app = null;
	/**
    *@var string Contient le template par défaut
    */
	protected $template = 'default';

	/**
    * @return void
    * Initialise le chemin des vues
    */
	public function __construct()
	{
	    parent::__construct();
		$this->viewpath = ROOT. '/app/views/';
		$this->app = App::getInstance();
    }

}

