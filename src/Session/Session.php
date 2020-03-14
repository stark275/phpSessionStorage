<?php
/*
    CE TRAVAIL EST REALISE DANS LE CADRE DU COURS DE PHP DE G3 GENIE INFORMATIQUE
    EN FACULTE DES SCIENCES INFORMATIQUES

    TRAVAIL PRATIQUE NUMERO 1 : FACTURATION

    ETUDIANT : MUMBERE MALULE JACQUES
    DIRIGE PAR : Dr. PATRICK MUKALA

 */
namespace Src\Session;
/**
*
*/
class Session
{

    /**
     * @return bool
     */
    public function destroy()
	{
		return session_destroy();
	}

    /**
     * @param $key
     * @param $value
     * @return mixed
     */
    public function add($key, $value)
    {
       return $_SESSION[$key] = $value;
	}

    /**
     * @param $key
     * @return void
     */
    public function unsetKey($key)
    {
        unset($_SESSION[$key]);
	}

    /**
     * @return string
     */
    public function dump()
    {
        return '<pre>'.var_dump($this->getSession()).'</pre>';
	}

    /**
     * @return array
     */
    public function getSession()
    {
        return $_SESSION;
	}


    /**
     * @param $key string
     * @return bool|mixed
     */
    public function getValue($key)
    {
        if (key_exists($key,$this->getSession())) {
            return $_SESSION[$key];
        }
        return false;
    }
}