<?php

namespace sf\db;

class Model implements ModelInterface
{
    public static $pdo;

    /**
     * Undocumented function
     *
     * @return void
     *
     * CREATE USER lee@localhost IDENTIFIED BY '123456Ac&'
     * GRANT ALL PRIVILEGES ON test.* TO lee@'%' IDENTIFIED BY '123456Ac&';
     * flush privileges
     *
     * CREATE TABLE IF NOT EXISTS `user` (
     *  id INT(20) NOT NULL AUTO_INCREMENT,
     *  name VARCHAR(50),
     *   age INT(11),
     *   PRIMARY KEY(id)
     * );
     *
     * INSERT INTO `user` (name, age) VALUES('harry', 20), ('tony', 23), ('tom', 24);
     */
    public static function getDb()
    {
        if (empty(static::$pdo)) {
            $host = 'localhost';
            $database = 'test';
            $userName = 'lee';
            $password = '123456Ac&';
            $options = [
                \PDO::ATTR_EMULATE_PREPARES => false,
                \PDO::ATTR_STRINGIFY_FETCHES => false
            ];

            static::$pdo = new \PDO("mysql:host=$host;dbname=$database", $userName, $password, $options);
            static::$pdo->exec('set names utf8');
        }
        return static::$pdo;
    }

    public static function tableName()
    {
        return get_called_class();
    }

    public static function primaryKey()
    {
        return ['id'];
    }

    public static function findOne($condition = null)
    {
        $sql = 'select * from ' . static::tableName() ;
        $params = [];

        if (!empty($condition)) {
            $sql .= ' where ';
            $params = array_values($condition);
            $keys = [];
            foreach ($condition as $key => $value) {
                array_push($keys, "$key = ?");
            }
            $sql .= implode(' and ', $keys);
        }

        $stmt = static::getDb()->prepare($sql);
        $rs = $stmt->execute($params);

        if ($rs) {
            $row = $stmt->fetch(\PDO::FETCH_ASSOC);
            if (!empty($row)) {
                $model = new static();
                foreach ($row as $rowKey => $rowValue) {
                    $model->$rowKey = $rowValue;
                }
                return $model;
            }
        }
        return null;
    }

    public static function findAll($condition)
    {
    }

    public static function updateAll($condition, $attributes)
    {
    }

    public static function deleteAll($condition)
    {
    }

    public function insert()
    {
    }
    public function update()
    {
    }
    public function delete()
    {
    }
}
