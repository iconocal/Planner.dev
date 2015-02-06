<?php

require '../inc/model.class.php';

class person extends Model
{
	public $attributes = [];

	public function insert()
	{
		$stmt = $this->dbc->prepare('INSERT INTO people (first_name, last_name, phone) VALUES (:first_name, :last_name, :phone)');
        $stmt->bindValue(':first_name', $this->attributes['first_name'], PDO::PARAM_STR);
        $stmt->bindValue(':last_name', $this->attributes['last_name'], PDO::PARAM_STR);
        $stmt->bindValue(':phone', $this->attributes['phone'], PDO::PARAM_STR);
        $stmt->execute();
	}

	public function update()
	{
		$stmt = $this->dbc->prepare('UPDATE people 
			SET first_name = :first_name, last_name = :last_name, phone = :phone 
			WHERE id = :id');
        $stmt->bindValue(':first_name', $this->attributes['first_name'], PDO::PARAM_STR);
		$stmt->bindValue(':last_name', $this->attributes['last_name'], PDO::PARAM_STR);
		$stmt->bindValue(':phone', $this->attributes['phone'], PDO::PARAM_STR);
		$stmt->bindValue(':id', $this->attributes['id'], PDO::PARAM_INT);
		$stmt->execute();
	}

	public function delete()
	{
		$stmt = $this->dbc->prepare('DELETE FROM people
		WHERE id = :id');
		$stmt->bindValue(':id', $this->attributes['id'], PDO::PARAM_INT);
		$stmt->execute();
	}

	public static function find($id, $dbc)
	{
		// select one person record by id
        $stmt = $dbc->prepare("SELECT id, first_name, last_name, phone FROM people WHERE id = :id");
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        // use fetchObject() to return a new person instance
        return $person_row = $stmt->fetch(PDO::FETCH_OBJ);
    }
}

// $p = new Person($dbc);
// $p->first_name = $_POST['first_name'];
