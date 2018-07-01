<?php
    class Game {
        private $gameId;
        private $apiId;
        private $name;
        private $iconSrc;
        private $pictureSrc;
        private $rating;
        private $releaseDate;
        private $platform;

        public function getPlatform()
        {
            return $this->platform;
        }


        public function setPlatform($platform)
        {
            $this->platform = $platform;
            return $this;
        }

        public function getReleaseDate()
        {
            return $this->releaseDate;
        }

        public function setReleaseDate($releaseDate)
        {
            $this->releaseDate = $releaseDate;
            return $this;
        }


        public function getRating()
        {
            return $this->rating;
        }

        public function setRating($rating)
        {
            $this->rating = $rating;
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

        public function getIconSrc()
        {
            return $this->iconSrc;
        }

        public function setIconSrc($iconSrc)
        {
            $this->iconSrc = $iconSrc;
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

        public function getApiId()
        {
            return $this->apiId;
        }

        public function setApiId($apiId)
        {
            $this->apiId = $apiId;
            return $this;
        }

        public function getGameId()
        {
            return $this->gameId;
        }

        public function setGameId($gameId)
        {
            $this->gameId = $gameId;
            return $this;
        }

        public function getGame($db, $id) {
            $resultObj = $db->query('SELECT * FROM `games` ' . 
                        'WHERE `games`.`gameId` = ' . (int) $id);
            $game_details = $resultObj->fetch_assoc();
            $game = new Game();
            $game->arrToGame($game_details);
            return $game;
				}
				
				public function arrToGame($gameRow) {
					if (!empty($gameRow)) {
						isset($gameRow['gameId']) ? 
							$this->setGameId($gameRow['gameId']) : '';
							isset($gameRow['apiId']) ? 
							$this->setApiId($gameRow['apiId']) : '';
							isset($gameRow['gname']) ? 
							$this->setName($gameRow['gname']) : '';
							isset($gameRow['icon']) ? 
							$this->setIconSrc($gameRow['icon']) : '';
							isset($gameRow['picture']) ? 
							$this->setPictureSrc($gameRow['picture']) : '';
							isset($gameRow['rating']) ? 
							$this->setRating($gameRow['rating']) : '';
							isset($gameRow['releaseDate']) ? 
							$this->setReleaseDate($gameRow['releaseDate']) : '';
							isset($gameRow['platform']) ? 
							$this->setPlatform($gameRow['platform']) : '';
					}
				}
    }
?>