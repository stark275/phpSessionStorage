<?php 
/*
    CE TRAVAIL EST REALISE DANS LE CADRE DU COURS DE PHP DE G3 GENIE INFORMATIQUE
    EN FACULTE DES SCIENCES INFORMATIQUES

    TRAVAIL PRATIQUE NUMERO 1 : FACTURATION

    ETUDIANT : MUMBERE MALULE JACQUES
    DIRIGE PAR : Dr. PATRICK MUKALA

 */
class App
{
	
		/**
         * @var object Contient une instance de App
         */
        protected static $_instance;

        /**
         * @var object Contient une instance de MysqlDatabase
         */
        protected $db_instance;


        /**
         * @return void
         * Demarre la session et charge composer
         */
        public static function load($vendorPath = '../vendor/autoload.php')
        {
            session_start();
            require $vendorPath;

        }

        /**
         * @return App
         * Crée une instance de App
         */
        public static function getInstance()
        {
            if (empty(self::$_instance)){
                self::$_instance = new App();
            }
            return self::$_instance;
        }

        /**
         * Construit les noms de classe du namespace App
         * @param  string $class Nom de la classe
         * @param  string $type  Type de la classe
         * @return string        Nom complet de la classe
         */
        public static function buildClassName($class,$type)
        {
            $type = ucfirst(strtolower($type));
            return "\App\\".$type."\\".ucfirst(strtolower($class)). $type;
        }

        /**
         * [redirect description]
         * @param  string $dest destination ex: doctor.newDiagnostic
         * @return void
         */
        public function redirect($dest)
        {
            header("Location:index.php?p=$dest");
            exit();
        }

        /**
         * Valide le paramètre "p" dans l'url
         * @return array      Différente parties du paramètre
         */
        public static function scanUrlNew()
        {
            $url =  'root.index';
            $default = explode('.', $url);
            $_404 = explode('.', 'root._404');

            if (isset($_GET['p']) && !empty($_GET['p'])) {
                $url = $_GET['p'];
            }

            if (!isset($url) || empty($url)) {
                return $default;
            }

            $param = explode('.',$url);
            if (count($param) < 2) {
                return ($_404);
            }

            $class = self::buildClassName($param[0],'Controller');

            if (class_exists($class)) {

                if (method_exists($class, $param[1])) {
                    return ($param);
                }
                return ($_404);
            }
            return ($_404);
        }


        /**
         * Verifie la validité d'un paramètre dans l'url selon des regles données
         * ex : ?p=class.meth&id=5&code=h77c4cer48r5 on a (p, id, code)
         * @param  string $param Nom du parametre dans l'url
         * @param  string $type  Type attendu de la variable
         * @return boolean
         */
        public function urlParamIsValid($param, $type = 'numeric', $otherRules = [])
        {
            if (!isset($_GET[$param]) || empty($_GET[$param])) {
                return false;
            }

            $func = 'is_'.$type;
            if (!$func($_GET[$param])) {
                return false;
            }

            return true;
        }


}