<?php 
/*
    CE TRAVAIL EST REALISE DANS LE CADRE DU COURS DE PHP DE G3 GENIE INFORMATIQUE
    EN FACULTE DES SCIENCES INFORMATIQUES

    TRAVAIL PRATIQUE NUMERO 1 : FACTURATION

    ETUDIANT : MUMBERE MALULE JACQUES
    DIRIGE PAR : Dr. PATRICK MUKALA

 */
namespace App\Controller;
use Src\Auth\FormValidator as Form;
use \App;

/**
* 		
*/
class RootController extends AppController
{

    public function __construct()
	{
		parent::__construct();
	}

    /**
     *@return void
     */
    public function index()
	{
        $unitPrice = [
            'router' => 200,
            'switch' => 150,
            'hub'    => 50,
            'ssd'    => 12.9,
            'micro'    => 59.99,
            'camera'    => 299.99
        ];

		if (isset($_POST['add'])) {

            if(isset($_POST['client'])){
                $this->session->add('client', $_POST['client']);
            }
            if (!Form::isEmpty(['product','quatity'])) {

			    if (is_int($_POST['quatity']))
                    $this->messages->setMessage('La quantité doit etre un entier');

                if (count($this->messages->getMessage('error')) == 0) {

                    if ($this->addOnFacture($_POST)) {
                        $message = abs($_POST['quatity']) .' '.$_POST['product'] .' ajouté(s) à la facture';
                        $this->messages->setMessage($message, 'success');
                    }
                }

            }else
			    $this->messages->setMessage('Veuillez completer tous les champ');

		}

		if (isset($_POST['delete'])) {
            if ($this->session->getValue($_POST['prod'])) {
                $this->session->unsetKey($_POST['prod']);
                $message = $_POST['prod'].' a été retité de la facture';
                $this->messages->setMessage($message);
            }
		}

        if (isset($_POST['facture'])) {
            $factured = $_SESSION;

            //methode à creer pour ne pas dupiquer le code
            unset($factured['appFlashMessages']);
            unset($factured['client']);

            if (count($factured) > 0) {
            	$this->session->destroy();
            	$this->messages->setMessage('Le client a été facturé','success');
            	$this->app->redirect('root.index');
            }else
                $this->messages->setMessage('La facture est vide');
        }

		/*echo '<pre>';
		$this->session->dump();
        echo '</pre>';*/

        $facture = $_SESSION;

        //methode à creer pour ne pas dupiquer le code
        unset($facture['appFlashMessages']);
        unset($facture['client']);
       /* echo '<pre>';
        var_dump($facture);
        echo '</pre>';*/


		$this->render('root.index',compact('facture','unitPrice'));
	}


    /**
     * @param $post
     * @return mixed
     */
    private function addOnFacture($post)
    {
        if (key_exists($post['product'],$this->session->getSession()))
            return $this->session->add(
                $post['product'],
                ($this->session->getValue($post['product']) + abs($post['quatity']))
            );
        else
            return $this->session->add($post['product'], abs($post['quatity']));
	}


    /**
     *@return void
     */
    public function _404()
	{
		$this->render('root.404');
	}

}

 
