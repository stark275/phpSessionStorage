<?php 
/*
    CE TRAVAIL EST REALISE DANS LE CADRE DU COURS DE PHP DE G3 GENIE INFORMATIQUE
    EN FACULTE DES SCIENCES INFORMATIQUES

    TRAVAIL PRATIQUE NUMERO 1 : FACTURATION

    ETUDIANT : MUMBERE MALULE JACQUES
    DIRIGE PAR : Dr. PATRICK MUKALA

 */
namespace Src\Controller;
use Src\Message\Message;
use Src\Session\Session;


class Controller
{
    /**
    *@var string Contrient le chemin des vues
    */
	protected $viewpath;

    /**
     * @var Message
     */
    protected $messages;

    /**
     * @var Session
     */
    protected $session;


    /**
     * Controller constructor.
     */
    public function __construct()
    {
        $this->messages = new Message();
        $this->session  = new Session();
    }
 
    /**
    * @param $view string Nom de la vue à afficher
    * @param $vars array Tableau contenant les variables à passer à la vue
    * Permet de rendre la vue avec ses variabLE 
    */
	protected function render($view,$vars = [])
	{
	    extract($vars);
        require($this->viewpath.'/'. str_replace('.', '/', $view).'.php');
        $content = ob_get_clean();

        /*$flashMessages = $this->messages->printAllFlashMessages();
        $messages = $this->messages->printAllMessages();*/
        $content = $content;
        require($this->viewpath. 'templates/' . $this->template .'.php');
        /*$this->messages->deleteFromSession();*/

	}

	/**
    * @return void
    */
    protected function forbiden()
    {
        header('HTTP/1.0 403 forbiden');
        die('Acees interdit');
    }

    /**
    * @return void
    */
    protected function notFound()
    {
        header('HTTP/1.0 404 Not Found');
        die('Page introuvable');
    }
}

