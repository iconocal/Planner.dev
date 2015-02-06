<?php

require '../inc/model.class.php';

class person extends Model
{

    public $attributes = [];

	public function insert()
    {
        // var_dump($this->attributes);
        $stmt = $this->dbc->prepare('INSERT INTO people (first_name, last_name, phone) VALUES (:first_name, :last_name, :phone)');
        $stmt->bindValue(':first_name', $this->attributes['first_name'], PDO::PARAM_STR);
        $stmt->bindValue(':last_name', $this->attributes['last_name'], PDO::PARAM_STR);
        $stmt->bindValue(':phone', $this->attributes['phone'], PDO::PARAM_STR);
        $stmt->execute();
	}
	public function update()
    {

	}
	public function delete()
    {

	}

    public static function find($id, $dbc)
    {
        // select one person record by id
        $stmt = $dbc->query("SELECT id, first_name, last_name, phone FROM people WHERE id = $id");
        // use fetchObject() to return a new person instance
        return $stmt->fetch(PDO::FETCH_OBJ);
    }


}

$person = Person::find(4, $dbc);








// $peoples = $stmt->fetchAll(PDO::FETCH_ASSOC);




// $stmt = $dbc->prepare('INSERT INTO people (first_name, last_name, phone) VALUES (:first_name, :last_name, :phone)');

//         $stmt->bindValue(':first_name', $_POST['first_name'], PDO::PARAM_STR);
//         $stmt->bindValue(':last_name', $_POST['last_name'], PDO::PARAM_STR);
//         $stmt->bindValue(':phone', $_POST['phone'], PDO::PARAM_STR);
    
//         $stmt->execute();