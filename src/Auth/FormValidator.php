<?php 
/*
    CE TRAVAIL EST REALISE DANS LE CADRE DU COURS DE PHP DE G3 GENIE INFORMATIQUE
    EN FACULTE DES SCIENCES INFORMATIQUES

    TRAVAIL PRATIQUE NUMERO 1 : FACTURATION

    ETUDIANT : MUMBERE MALULE JACQUES
    DIRIGE PAR : Dr. PATRICK MUKALA

 */
namespace Src\Auth;

class FormValidator 
{

    /**
     *
     */
    public function clearInput()
    {
        if (isset($_SESSION['input'])) {
        	$_SESSION['input'] = [];
        }
    }

	/**
	 * [isEmpty description]
	 * @param  array   $field Tableau contenant les noms des champs
	 * @return boolean        
	 */
	public static function isEmpty($field = [])
	{
		if (count($field) > 0) {
			foreach ($field as $value) {
				if (empty($_POST[$value]) || trim($_POST[$value]) == '') {
					return true;
				}
			}
		}
		return false;
	}

	/**
	 * [e description]
	 * @param  string $str 
	 * @return string            
	 */
	public static function e($str)
	{
		if ($str) {
			return htmlspecialchars($str);
		}	
	}

	
}

