<?php
    class Console {
        private $consoleId;
        private $apiId;
        private $name;
        private $iconSrc;
        private $pictureSrc;

        public function getConsoleId()
        {
            return $this->consoleId;
        }

        public function setConsoleId($consoleId)
        {
            $this->consoleId = $consoleId;
            return $this;
        }
        
        public function getApiId()
        {
            return $this->apiId;
        }

        public function setApiId($apiId)
        {
            $this->apiId = $apiId;
            return $this;
        }

        public function getName()
        {
            return $this->name;
        }

        public function setName($name)
        {
            $this->name = $name;
            return $this;
        }

        public function getIconSrc()
        {
            return $this->iconSrc;
        }

        public function setIconSrc($iconSrc)
        {
            $this->iconSrc = $iconSrc;
            return $this;
        }

        public function getPictureSrc()
        {
            return $this->pictureSrc;
        }

        public function setPictureSrc($pictureSrc)
        {
            $this->pictureSrc = $pictureSrc;
            return $this;
        }        

        public function getConsole($db, $id) {
            $resultObj = $db->query('SELECT * FROM `consoles` ' . 
                        'WHERE `consoles`.`consoleId` = ' . (int) $id);
            $console_details = $resultObj->fetch_assoc();
            $console = new Console();
            $console->arrToConsole($console_details);
            return $console;
				}
				
				public function arrToConsole($consoleRow) {
					if (!empty($consoleRow)) {
						isset($consoleRow['consoleId']) ? 
							$this->setGameId($consoleRow['consoleId']) : '';
							isset($consoleRow['apiId']) ? 
							$this->setApiId($consoleRow['apiId']) : '';
							isset($consoleRow['cname']) ? 
							$this->setName($consoleRow['cname']) : '';
							isset($consoleRow['icon']) ? 
							$this->setIconSrc($consoleRow['icon']) : '';
							isset($consoleRow['picture']) ? 
							$this->setPictureSrc($consoleRow['picture']) : '';
					}
				}

    }
?>