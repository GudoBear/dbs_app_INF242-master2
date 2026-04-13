<?php
 
class database{
 
    function opencon() : PDO{
        return new PDO(
    dsn: 'mysql:host=localhost;
        dbname=library',
        username:'root', 
        password:''); 
    }
    function insertUser($email, $password_hash, $is_active){
        $con = $this->opencon();

        try{
             $stmt = $con->beginTransaction();
             $stmt = $con->prepare('INSERT INTO Users (Username, password_hash, is_active)VALUES (?,?,?)');
             $stmt->execute([$email, $password_hash, $is_active]);
             $user_id = $con->lastInsertId();
             $con->commit();
             return $user_id;
        }catch(PDOException $e){
            if($con->inTransaction()){
                $con->rollBack();
    }
    throw $e;
}
}
    function insertBorrowers($firstname, $lastname, $email, $phone, $member_since, $is_active) {
        $con = $this->opencon();
        try{
            $stmt = $con->beginTransaction();
             $stmt = $con->prepare('INSERT INTO Borrowers (borrower_firstname, borrower_lastname, borrower_email, borrower_phone_number, borrower_member_since, is_active)VALUES (?,?,?,?,?,?)');
             $stmt->execute([$firstname, $lastname, $email, $phone, $member_since, $is_active]);
             $borrowers_id = $con->lastInsertId();
             $con->commit();
             return $borrowers_id;
        }catch(PDOException $e){
            if($con->inTransaction()){
                $con->rollBack();

            }
            throw $e;
    }
 }
 function insertBorroweruser($user_id, $borrower_id)
 {
        $con = $this->opencon();
        try{
            $stmt = $con->beginTransaction();
             $stmt = $con->prepare('INSERT INTO BorrowerUser(user_id, borrower_id)VALUES (?,?)');
             $stmt->execute([$user_id, $borrower_id]);
             $bu_id = $con->lastInsertId();
             $con->commit();
             return $bu_id;
        }catch(PDOException $e){
            if($con->inTransaction()){
                $con->rollBack();

            }
            throw $e;
    }
 }

function viewBorroweruser(){
    $con = $this->opencon();
    return $con->query("SELECT * from Borrowers")->fetchAll();
}

function insertBorroweraddress($borrower_id, $ba_house_number, $ba_street, $ba_barangay, $ba_city, $ba_province, $ba_postal_code, $is_primary){
     $con = $this->opencon();
        try{
            $stmt = $con->beginTransaction();
             $stmt = $con->prepare('INSERT INTO BorrowerAddress(borrower_id, ba_house_number, ba_street, ba_barangay, ba_city, ba_province, ba_postal_code, is_primary)
             VALUES (?,?,?,?,?,?,?,?)');
             $stmt->execute([$borrower_id, $ba_house_number, $ba_street, $ba_barangay, $ba_city, $ba_province, $ba_postal_code, $is_primary]);
             $ba_id = $con->lastInsertId();
             $con->commit();
             return $ba_id;
        }catch(PDOException $e){
            if($con->inTransaction()){
                $con->rollBack();

            }
            throw $e;
    }
}

}
?>