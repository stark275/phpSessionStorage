<?php
    /**
     * Created by PhpStorm.
     * User: stark
     * Date: 06/10/2019
     * Time: 03:02
     */

    namespace Src\Message;


    /**
     * Class Message
     * @package Core\Message
     */
    class Message
    {

        /**
         * @var array
         */
        private $messages = [];

        /**
         * @var array
         */
        protected $flashMessages = [];

        /**
         * Message constructor.
         */
        public function __construct()
        {
            $baseArray = [
                'error' => [],
                'success' => [],
                'info' => []
            ];

            $this->messages = $baseArray;
            $this->flashMessages =  $baseArray;

        }


        /**
         * @return string
         */
        public function printAllFlashMessages()
        {
            $html = '';


            if (isset($_SESSION['appFlashMessages'])) {
                $msg = $_SESSION['appFlashMessages'];
                $type = array_keys($this->messages);// ['error','success','info']
                // utiliser plutot une boucle ;)
                //   dump($msg['success']);
                if (isset($msg['success'])&& count($msg['success']) != 0) {
                    $html .= $this->printFlashMessages($type[1]);
                    //dump($_SESSION,$this->flashMessages,'looly');

                }
                if (isset($msg['error']) && count($msg['error']) != 0) {
                    $html .= $this->printFlashMessages($type[0]);
                }
                if (isset($msg['info']) && count($msg['info'])  != 0) {
                    $html .= $this->printFlashMessages($type[2]);
                }
            }

            return $html;
        }




        public function printFlashMessages($type)
        {
            $class =  $this->getAlertClass($type);
            $html = '<div class="container">';
            $html .= '<div class="alert alert-'.$class.' alert-dismissible alert-message"> ';
            $html .= '<button type="button" class="close" data-dismiss="alert" 
                        aria-hidden="true">&times;</button> ';
            $html .= '<h5><i class="icon fa fa-info"></i> Message  </h5> ';

            foreach ($_SESSION['appFlashMessages'][$type] as $error ) {
                $html .= '<p>'.$error.'</p>';
            }

            $html .= '</div> ';
            $html .= '</div> ';

            return $html;
        }

        public function deleteFromSession()
        {
            foreach ($this->flashMessages as $key => $value ) {
                $_SESSION['appFlashMessages'][$key] = [];
            }
        }

        public function sendTo($dest)
        {
            foreach ($this->flashMessages as $key => $value ) {
                $_SESSION['appFlashMessages'][$key]= $value;
            }
            \App::getInstance()->redirect($dest);
        }


        public function setFlashMessages($flashMessages,$type = 'info')
        {
            $this->flashMessages[$type][] = $flashMessages;
            return $this;
        }

        

        /**
         * @param string $type
         * @return array|mixed
         */
        public function getMessage($type = '')
        {
            if (isset($type) && $type != '') {
            	return $this->messages[$type];
            }
            return $this->messages;
        }


        /**
         * @param $message
         * @param string $type
         */
        public function setMessage($message, $type = 'error')
        {
            $this->messages[$type][]= $message;
        }

        /**
         * @param string $type
         * @param $message
         */
        public function addMessage($message,$type = 'error' )
        {
            $this->setMessage($message,$type);
        }


        /**
         *
         * @param string $type
         * @return string
         */
        public function printMessages($type = 'error')
        {
            $class =  $this->getAlertClass($type);
            $html = '<div class="container">';
            $html .= '<div class="row" style="width: 75%">';
            $html .= '<div class="col-md-12">';
            $html .= '<div class="alert alert-'.$class.' alert-dismissible alert-message"> ';
            $html .= '<button type="button" class="close" data-dismiss="alert" 
                        aria-hidden="true">&times;</button> ';
            $html .= '<h5><i class="icon fa fa-info"></i> Message  </h5> ';
            foreach ($this->messages[$type] as $error ) {
                $html .= '<p> - '.$error.'</p>';
            }
            $html .= '</div> ';
            $html .= '</div> ';
            $html .= '</div> ';
            $html .= '</div> ';



            return $html;

        }

        /**
         * @return string
         */
        public function printAllMessages()
        {
            $html = '';
            $msg =  $this->messages;

           $type = array_keys($this->messages); // ['error','success','info']

            // todo: utiliser plutot une boucle ;)
            if (count($msg['success']) != 0) {
                $html .= $this->printMessages($type[1]);
            }

            if (count($msg['error']) != 0) {
                $html .= $this->printMessages($type[0]);
            }

            if (count($msg['info']) != 0) {
                $html .= $this->printMessages($type[2]);
            }

            return $html;
        }

        /**
         * Retourne une class CSS (bootstrap) de type alert
         * @param $class
         * @return string
         */
        private function getAlertClass($class)
        {

            switch ($class) {
                case 'error':
                    return 'danger';
                    break;

                case 'success':
                    return 'success';
                    break;

                case 'info':
                    return 'info';
                    break;
                default:
                    return 'success';
                    break;
            }
        }
    }