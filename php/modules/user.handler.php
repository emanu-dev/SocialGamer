<?php
class User {
  
  private $userId;
  private $userName;
  private $dob;
  private $password;

  public function getUserId() {
    return $this->userId;
  }

  public function setUserId($userId) {
    $this->userId = $userId;
  }

  public function getUsername() {
    return $this->userName;
  }

  public function setUsername($userName) {
    $this->userName = $userName;
  }

  public function getDob() {
    return $this->dob;
  }

  public function setDob($dob) {
    $this->dob = $dob;
  }

  public function getPassword() {
    return $this->password;
  }

  public function setPassword($password) {
    $this->password = $password;
  }

  public function getUser($db, $id) {
    $resultObj = $db->query('SELECT * FROM `user` ' . 
                'WHERE `user`.`userID` = ' . (int) $id);
    $user_details = $resultObj->fetch_assoc();
    $user = new User();
    $user->arrToUser($user_details);
    return $user;
  }

  public function arrToUser($userRow) {
    if (!empty($userRow)) {
      isset($userRow['userID']) ? 
        $this->setUserId($userRow['userID']) : '';
      isset($userRow['username']) ? 
        $this->setUsername($userRow['username']) : '';
      isset($userRow['dob']) ? 
        $this->setDob($userRow['dob']) : '';
      isset($userRow['password']) ? 
        $this->setPassword($userRow['password']) : '';
    }
  }


  public function getUserGamesWithTag($db, $limit = 3, $tag = 'Jogando') {
    $query = "SELECT games.gameId, owned_games.gameId, owned_games.userID, tags.gameId, tags.tag, tags.userID FROM owned_games INNER JOIN games ON owned_games.gameId=games.gameId INNER JOIN tags ON games.gameId=tags.gameId WHERE owned_games.userId='". (int) $this->getUserId()."' AND tags.tag = '". $tag ."' LIMIT ".$limit;

    $resultObj = $db->query($query);
    
    $owned_games = array();
    while($row = $resultObj->fetch_array())
    {
        $owned_games[] = $row;
    }    

    return $owned_games;
  }

    public function getUserGames($db, $limit = 100) {
        $query = "SELECT games.gameId, owned_games.gameId, owned_games.userID, tags.gameId, tags.tag, tags.userID FROM owned_games INNER JOIN games ON owned_games.gameId=games.gameId INNER JOIN tags ON games.gameId=tags.gameId WHERE owned_games.userId='". (int) $this->getUserId()."' LIMIT ".$limit;

        $resultObj = $db->query($query);

        $owned_games = array();
        while($row = $resultObj->fetch_array())
        {
            $owned_games[] = $row;
        }    

        return $owned_games;
    }  
}