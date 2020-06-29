<?php

namespace sf\db;

use Sf;

class Model implements ModelInterface
{
    public static $pdo;

    /**
     * Undocumented function
     *
     * @return void
     *
     * CREATE USER 'lee'@'localhost' IDENTIFIED WITH mysql_native_password BY '123456Ac&'
     * GRANT ALL PRIVILEGES ON test.* TO lee@'localhost';
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
            static::$pdo = Sf::createObject('db')->getDb();
            static::$pdo->exec("set names 'utf8'");
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

    public static function bindWhere($condition, $params = null)
    {
        if (is_null($params)) {
            $params = [];
        }

        $where = '';
        if (!empty($condition)) {
            $where .= ' where ';
            $params = array_values($condition);
            $keys = [];
            foreach ($condition as $key => $value) {
                array_push($keys, "$key = ?");
            }
            $where .= implode(' and ', $keys);
        }

        return [$where, $params];
    }

    public static function arr2Model($row)
    {
        $model = new static();
        foreach ($row as $rowKey => $rowValue) {
            $model->$rowKey = $rowValue;
        }
        return $model;
    }


    public static function findOne($condition = null)
    {
        list($where, $params) = static::bindWhere($condition);
        $sql = 'select * from ' . static::tableName() . $where;

        $stmt = static::getDb()->prepare($sql);
        $rs = $stmt->execute($params);

        if ($rs) {
            $row = $stmt->fetch(\PDO::FETCH_ASSOC);
            if (!empty($row)) {
                return static::arr2Model($row);
            }
        }
        return null;
    }

    public static function findAll($condition = null)
    {
        list($where, $params) = static::bindWhere($condition);
        $sql = 'select * from ' . static::tableName() . $where;

        $stmt = static::getDb()->prepare($sql);
        $rs = $stmt->execute($params);
        $models = [];

        if ($rs) {
            $rows = $stmt->fetchAll(\PDO::FETCH_ASSOC);
            foreach ($rows as $row) {
                if (!empty($row)) {
                    $model =  static::arr2Model($row);
                    array_push($models, $model);
                }
            }
        }
        return $models;
    }

    public static function updateAll($condition, $attributes)
    {
        $sql = 'update ' . static::tableName();
        $params = [];

        if (!empty($attributes)) {
            $sql .= ' set ';
            $params = array_values($attributes);
            $keys = [];
            foreach ($attributes as $key => $value) {
                array_push($keys, "$key = ?");
            }
            $sql .= implode(',', $keys);
        }
        list($where, $params) = static::bindWhere($condition, $params);
        $sql .= $where;

        $stmt = static::getDb()->prepare($sql);
        $execResult = $stmt->execute($params);
        if ($execResult) {
            $execResult = $stmt->rowCount();
        }

        return $execResult;
    }

    public static function deleteAll($condition)
    {
        list($where, $params) = static::bindWhere($condition);
        $sql .= 'delete from ' . static::tableName() . $where;

        $stmt = static::getDb()->prepare($sql);
        $execResult = $stmt->execute($params);
        if ($execResult) {
            $execResult = $stmt->rowCount();
        }

        return $execResult;
    }

    public function insert()
    {
        $sql = 'insert into ' . static::tableName();
        $params = [];
        $keys = [];

        foreach ($this as $key => $value) {
            array_push($keys, $key);
            array_push($params, $value);
        }
        $holders = array_fill(0, count($keys), '?');
        $sql .= ' (' . implode(' , ', $keys) . ') values (' .implode(' , ', $holders) . ')';

        $stmt = static::getDb()->prepare($sql);
        $execResult = $stmt->execute($params);
        $primaryKeys = static::primaryKey();
        foreach ($primaryKeys as $name) {
            $lastId = static::getDb()->lastInsertId($name);
            $this->name = (int)$lastId;
        }
        return $execResult;
    }

    public function update()
    {
        $primaryKeys = static::primaryKey();
        $condition = [];
        foreach ($primaryKeys as $key) {
            $condition[$key] = isset($this->$key) ? $this->$key : null;
        }

        $attributes = [];
        foreach ($this as $key => $value) {
            if (!in_array($key, $primaryKeys, true)) {
                $attributes[$key] = $value;
            }
        }
        return static::updateAll($condition, $attributes) !== false;
    }


    public function delete()
    {
        $primaryKeys = static::primaryKey();
        $condition = [];
        foreach ($primaryKeys as $key) {
            $condition[$key] = isset($this->$key) ? $this->$key : null;
        }

        return static::deleteAll($condition) !== false;
    }
}
