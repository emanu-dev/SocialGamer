<?php
class Relationship {
  
    public $userOne;
    public $userTwo;
    
    /**
     * Status de Amizade
     *  0	Pendente
     * 1	Aceita
     * 2	Rejeitada
     * 3	Bloqueada
     */
    public $status = 0;
    public $actionUserId;
      
    public function getUserOne() {
      return $this->userOne;
    }
    
    public function setUserOne(User $userOne) {
      $this->userOne = $userOne;
    }
    
    public function getUserTwo() {
      return $this->userTwo;
    }
    
    public function setUserTwo(User $userTwo) {
      $this->userTwo = $userTwo;
    }
    
    public function getStatus() {
      return $this->status;
    }
    
    public function setStatus($status) {
      $this->status = $status;
    }
    
    public function getActionUserId() {
      return $this->actionUserId;
    }
    
    public function setActionUserId($actionUserId) {
      $this->actionUserId = $actionUserId;
    }
    
    public function arrToRelationship($row, $db) {
      if (!empty($row)) {
        if (isset($row['user_one_id']) && isset($row['user_two_id'])) {

          $resultObj = $db->query('SELECT * FROM `user` WHERE `user`.`userID` IN ('
            . (int)$row['user_one_id'] . ', ' . (int)$row['user_two_id'] . ')');
          
          $usersArr = array();
          while($record = $resultObj->fetch_assoc()) {
            $usersArr[] = $record;
          }
          
          $userOne = new User();
          $userTwo = new User();
          
          if ($row['user_one_id'] < $row['user_two_id']) {
            $userOne->arrToUser($usersArr[0]);
            $userTwo->arrToUser($usersArr[1]);
          } else {
            $userOne->arrToUser($usersArr[1]);
            $userTwo->arrToUser($usersArr[0]);
          }
          
          $this->setUserOne($userOne);
          $this->setUserTwo($userTwo);
        }
        
        isset($row['status']) ? $this->setStatus((int)$row['status']) : '';
        isset($row['action_user_id']) ? 
          $this->setActionUserId((int)$row['action_user_id']) : '';
      }
    }
  }
?>