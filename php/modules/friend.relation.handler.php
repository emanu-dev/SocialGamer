<?php

class Relation {
    
    private $loggedInUser;
    private $db;
  
    public function __construct($db, User $loggedInUser) {
        if ($db == 'undefined') {
            return false;
        }

        $this->loggedInUser = $loggedInUser;
        $this->db = $db;
  }
    
    public function getFriend(Relationship $rel) {
        if ($rel->getUserOne()->getUserId() === $this->loggedInUser->getUserId()) {
            $friend = $rel->getUserTwo();
        } else {
            $friend = $rel->getUserOne();
        }
    
        return $friend;
  }
  
    public function getFriendsList() {
        $id = (int)$this->loggedInUser->getUserId();

        $sql = 'SELECT * FROM `relationship` WHERE ' .
                '(`user_one_id` = ' . $id . ' OR `user_two_id` = '. $id .') ' .
                'AND `status` = 1';
                
        $resultObj = $this->db->query($sql);

        $rels = array();

        while($row = $resultObj->fetch_assoc()) {
            $rel = new Relationship();
            $rel->arrToRelationship($row, $this->db);
            $rels[] = $rel;
        }

        return $rels;
    }
  
    public function getSentFriendRequests() {
        $id = (int) $this->loggedInUser->getUserId();

        $sql = 'SELECT * FROM `relationship` WHERE ' . 
                '(`user_one_id` = ' . $id . ' OR `user_two_id` = ' . $id . ') ' . 
                'AND `status` = 0 '. 
                'AND `action_user_id` = ' . $id;
                
        $resultObj = $this->db->query($sql);

        $rels = array();

        while($row = $resultObj->fetch_assoc()) {
            $rel = new Relationship();
            $rel->arrToRelationship($row, $this->db);
            $rels[] = $rel;
        }

        return $rels;
    }
  
    public function getFriendRequests() {
        $id = (int) $this->loggedInUser->getUserId();

        $sql = 'SELECT * FROM `relationship` ' . 
                'WHERE (`user_one_id` = ' . $id . ' OR `user_two_id` = '. $id .')' . 
                ' AND `status` = 0 ' . 
                'AND `action_user_id` != ' . $id;

        $resultObj = $this->db->query($sql);

        $rels = array();

        while($row = $resultObj->fetch_assoc()) {
            $rel = new Relationship();
            $rel->arrToRelationship($row, $this->db);
            $rels[] = $rel;
        }

        return $rels;
    }
  
    public function getBlockedFriends() {
        $id = (int) $this->loggedInUser->getUserId();

        $sql = 'SELECT * FROM `relationship` ' . 
                'WHERE (`user_one_id` = ' . $id . ' OR `user_two_id` = '. $id .')' . 
                ' AND `status` = 3 ' . 
                'AND `action_user_id` = ' . $id;

        $resultObj = $this->db->query($sql);

        $rels = array();

        while($row = $resultObj->fetch_assoc()) {
            $rel = new Relationship();
            $rel->arrToRelationship($row, $this->db);
            $rels[] = $rel;
        }

        return $rels;
    }
  
    public function getRelationship(User $user) {
        $user_one = (int) $this->loggedInUser->getUserId();
        $user_two = (int) $user->getUserId();

        if ($user_one > $user_two) {
            $temp = $user_one;
            $user_one = $user_two;
            $user_two = $temp;
        }

        $sql = 'SELECT * FROM `relationship` ' .
                'WHERE `user_one_id` = ' . $user_one . 
                ' AND `user_two_id` = ' . $user_two;

        $resultObj = $this->db->query($sql);

        if ($this->db->affected_rows > 0) {
            $row = $resultObj->fetch_assoc();
            $relationship = new Relationship();
            $relationship->arrToRelationship($row, $this->db);
            return $relationship;
        }

        return false;
    }
  
    public function addFriendRequest(User $user) {
        $user_one = (int) $this->loggedInUser->getUserId();
        $action_user_id = $user_one;
        $user_two = (int) $user->getUserId();

        if ($user_one > $user_two) {
            $temp = $user_one;
            $user_one = $user_two;
            $user_two = $temp;
        }

        $sql = 'INSERT INTO `relationship` '
                . '(`user_one_id`, `user_two_id`, `status`, `action_user_id`) '
                . 'VALUES '
                . '(' . $user_one . ', '. $user_two .', 0, '. $action_user_id .')';

        $this->db->query($sql);

        if ($this->db->affected_rows > 0) {
            return true;
        }

        return false;
    }
  
    public function acceptFriendRequest(User $user) {
        $user_one = (int) $this->loggedInUser->getUserId();
        $action_user_id = $user_one;
        $user_two = $user->getUserId();

        if ($user_one > $user_two) {
            $temp = $user_one;
            $user_one = $user_two;
            $user_two = $temp;
        }

        $sql = 'UPDATE `relationship` '
                . 'SET `status` = 1, `action_user_id` = '. $action_user_id 
                .' WHERE `user_one_id` = '. $user_one 
                .' AND `user_two_id` = ' . $user_two;

        $this->db->query($sql);

        if ($this->db->affected_rows > 0) {
            return true;
        }

        return false;
    }
  
    public function declineFriendRequest(User $user) {
        $user_one = (int) $this->loggedInUser->getUserId();
        $action_user_id = $user_one;
        $user_two = $user->getUserId();

        if ($user_one > $user_two) {
            $temp = $user_one;
            $user_one = $user_two;
            $user_two = $temp;
        }

        $sql = 'UPDATE `relationship` '
                . 'SET `status` = 2, `action_user_id` = '. $action_user_id 
                .' WHERE `user_one_id` = '. $user_one 
                .' AND `user_two_id` = ' . $user_two;
                
        $this->db->query($sql);

        if ($this->db->affected_rows > 0) {
            return true;
        }

        return false;
    }
  
    public function cancelFriendRequest(User $user) {
        $user_one = (int) $this->loggedInUser->getUserId();
        $user_two = (int) $user->getUserId();

        if ($user_one > $user_two) {
            $temp = $user_one;
            $user_one = $user_two;
            $user_two = $temp;
        }

        $sql = 'DELETE FROM `relationship` ' .
                'WHERE `user_one_id` = ' . $user_one . 
                ' AND `user_two_id` = ' . $user_two .
                ' AND `status` = 0';

        $this->db->query($sql);

        if ($this->db->affected_rows > 0) {
            return true;
        }

        return false;
    }
  
    public function unfriend(User $user) {
        $user_one = (int) $this->loggedInUser->getUserId();
        $user_two = (int) $user->getUserId();

        if ($user_one > $user_two) {
            $temp = $user_one;
            $user_one = $user_two;
            $user_two = $temp;
        }

        $sql = 'DELETE FROM `relationship` ' .
                'WHERE `user_one_id` = ' . $user_one . 
                ' AND `user_two_id` = ' . $user_two .
                ' AND `status` = 1';

        $this->db->query($sql);

        if ($this->db->affected_rows > 0) {
            return true;
        }

        return false;
    }
  
    public function block(User $user) {
        $user_one = (int) $this->loggedInUser->getUserId();
        $action_user_id = $user_one;
        $user_two = $user->getUserId();

        if ($user_one > $user_two) {
            $temp = $user_one;
            $user_one = $user_two;
            $user_two = $temp;
        }

        $sql = 'UPDATE `relationship` '
                . 'SET `status` = 3, `action_user_id` = '. $action_user_id 
                .' WHERE `user_one_id` = '. $user_one 
                .' AND `user_two_id` = ' . $user_two;
                
        $this->db->query($sql);

        if ($this->db->affected_rows > 0) {
            return true;
        }

        return false;
    }
  
  public function unblockFriend(User $user) {
    $user_one = (int) $this->loggedInUser->getUserId();
    $action_user_id = $user_one;
    $user_two = $user->getUserId();

    if ($user_one > $user_two) {
        $temp = $user_one;
        $user_one = $user_two;
        $user_two = $temp;
    }

    $sql = 'UPDATE `relationship` '
            . 'SET `status` = 1, `action_user_id` = '. $action_user_id 
            .' WHERE `user_one_id` = '. $user_one 
            .' AND `user_two_id` = ' . $user_two;
            
    $this->db->query($sql);

    if ($this->db->affected_rows > 0) {
        return true;
    }

    return false;
}
}
?>