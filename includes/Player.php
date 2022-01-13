<?php
require_once 'Database.php';

class Player extends Database
{  
//list season
	public function getRowss($table, $field, $value)
    {
        $sql = "SELECT * FROM ".$table." WHERE {$field}=:{$field}";
        $stmt = $this->conn->prepare($sql);
		$stmt->execute([":{$field}" => $value]);
        if ($stmt->rowCount() > 0) {
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        } else {

            $results = [];
        }
        return $results;
    }
    public function getCountss($table, $field, $value)
    {
        $sql = "SELECT count(*) as pcount FROM ".$table." WHERE {$field}=:{$field}";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([":{$field}" => $value]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['pcount'];
    }
//list Episode
	public function getRowep($table, $field, $value, $giatri, $sss)
    {
        $sql = "SELECT * FROM ".$table." WHERE {$field}=:{$field} AND {$giatri}=".$sss."";
        $stmt = $this->conn->prepare($sql);
		$stmt->execute([":{$field}" => $value]);
        if ($stmt->rowCount() > 0) {
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        } else {

            $results = [];
        }
        return $results;
    }
    public function getCountep($table, $field, $value, $giatri, $sss)
    {
        $sql = "SELECT count(*) as pcount FROM ".$table." WHERE {$field}=:{$field} AND {$giatri}=".$sss."";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([":{$field}" => $value]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['pcount'];
    }
    public function listst($table)
    {
        $sql = "SELECT * FROM ".$table." ORDER BY id DESC LIMIT 1";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        } else {

            $results = [];
        }
        return $results;
    }
    public function add($table,$data)
    {

        if (!empty($data)) {
            $fileds = $placholders = [];
            foreach ($data as $field => $value) {
                $fileds[] = $field;
                $placholders[] = ":{$field}";
            }
        }

        $sql = "INSERT INTO ".$table." (" . implode(',', $fileds) . ") VALUES (" . implode(',', $placholders) . ")";
        $stmt = $this->conn->prepare($sql);
        try {
            $this->conn->beginTransaction();
            $stmt->execute($data);
            $lastInsertedId = $this->conn->lastInsertId();
            $this->conn->commit();
            return $lastInsertedId;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            $this->conn->rollback();
        }

    }
	public function addsub($table,$data)
    {

        if (!empty($data)) {
            $fileds = $placholders = [];
            foreach ($data as $field => $value) {
                $fileds[] = $field;
                $placholders[] = ":{$field}";
            }
        }
        $sql = "INSERT INTO ".$table." (" . implode(',', $fileds) . ") VALUES (" . implode(',', $placholders) . ")";
		$stmt = $this->conn->prepare($sql);
        try {
            $this->conn->beginTransaction();
            $stmt->execute($data);
            $lastInsertedId = $this->conn->lastInsertId();
            $this->conn->commit();
            return $lastInsertedId;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            $this->conn->rollback();
        }

    }

    public function update($table,$data, $id)
    {
        if (!empty($data)) {
            $fileds = '';
            $x = 1;
            $filedsCount = count($data);
            foreach ($data as $field => $value) {
                $fileds .= "{$field}=:{$field}";
                if ($x < $filedsCount) {
                    $fileds .= ", ";
                }
                $x++;
            }
        }
        $sql = "UPDATE ".$table." SET {$fileds} WHERE id=:id";
        $stmt = $this->conn->prepare($sql);
        try {
            $this->conn->beginTransaction();
            $data['id'] = $id;
            $stmt->execute($data);
            $this->conn->commit();
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            $this->conn->rollback();
        }

    }

    /**
     * function is used to get records
     * @param int $stmt
     * @param int @limit
     * @return array $results
     */

    public function getRows($table,$start = 0, $limit = 4)
    {
        $sql = "SELECT * FROM ".$table." ORDER BY id DESC LIMIT {$start},{$limit}";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        } else {

            $results = [];
        }
        return $results;
    }

    // delete row using id
    public function deleteRow($table,$id)
    {
        $sql = "DELETE FROM ".$table."  WHERE id=:id";
        $stmt = $this->conn->prepare($sql);
        try {
            $stmt->execute([':id' => $id]);
            if ($stmt->rowCount() > 0) {
                return true;
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }

    }

    public function getCount($table)
    {
        $sql = "SELECT count(*) as pcount FROM ".$table."";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['pcount'];
    }
    /**
     * function is used to get single record based on the column value
     * @param string $fileds
     * @param any $value
     * @return array $results
     */
    public function getRow($table,$field, $value)
    {

        $sql = "SELECT * FROM ".$table."  WHERE {$field}=:{$field}";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([":{$field}" => $value]);
        if ($stmt->rowCount() > 0) {
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
        } else {
            $result = [];
        }

        return $result;
    }

    public function search($table,$searchText, $start = 0, $limit = 4)
    {
        $sql = "SELECT * FROM ".$table." WHERE tenphim LIKE :search ORDER BY id DESC LIMIT {$start},{$limit}";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([':search' => "{$searchText}%"]);
        if ($stmt->rowCount() > 0) {
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        } else {
            $results = [];
        }

        return $results;
    }

}
