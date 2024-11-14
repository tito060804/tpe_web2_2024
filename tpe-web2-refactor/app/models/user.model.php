<<<<<<< HEAD
<?php
require_once 'app/models/models.php';

class UserModel extends Model {

    public function getByEmail($email) {
        $query = $this->db->prepare('SELECT * FROM usuarios WHERE email = ?');
        $query->execute([$email]);
        return $query->fetch(PDO::FETCH_OBJ);
    }
=======
<?php
require_once 'app/models/models.php';

class UserModel extends Model {

    public function getByEmail($email) {
        $query = $this->db->prepare('SELECT * FROM usuario WHERE email = ?');
        $query->execute([$email]);
        return $query->fetch(PDO::FETCH_OBJ);
    }
>>>>>>> 9a73d780875609e05bc53907e964401b3b00b534
}