<?php

namespace Application\Entity;

date_default_timezone_set('UTC');

use JsonSerializable;
use DateTime;
use PDO;

use Application\config\MysqlDBAdapter;
use Application\Exception\NotImplementedException;
use Application\Exception\ActiveRecordException;
use Application\Exception\RecordNotFoundException;



final class Logger
{
    public static function log($args): void
    {
        error_log(print_r($args, true));
    }
}


class ActiveRecord implements JsonSerializable
{
    const TABLE_NAME = 'undefined';

    public ?int $id;

    public DateTime $created_at;

    public DateTime $updated_at;

    private $database;

    public function __construct($db_conn = null)
    {
        $this->id = null;
        $this->created_at = new DateTime();
        $this->updated_at = new DateTime();
        $this->database = $db_conn ?? new MysqlDBAdapter();
    }

    public function jsonSerialize()
    {
        throw new NotImplementedException();
    }

    public function save($payload)
    {
        $public_data = $this->getPublicVars();
        $fields = array_merge($public_data, $payload);


        unset($fields['id']);
        $db_fields = [];
        if ($this->id) {
            unset($fields['created_at']);
            $this->updated_at = new DateTime();
        }

        foreach ($fields as $field_name => $value) {
            $value_type = gettype($value);
            switch ($value_type) {
                case 'NULL':
                    $db_fields[$field_name] = 'NULL';
                    break;
                case 'boolean':
                case 'integer':
                case 'string':
                case 'double':
                    $db_fields[$field_name] = $value;
                    break;
                case 'object':
                    switch (get_class($value)) {
                        case 'DateTime':
                            $db_fields[$field_name] = $value->format('Y-m-d H:i:s');
                            break;
                        default:
                            throw (new NotImplementedException('Please handle this object type'));
                            break;
                    }
                    break;
                default:
                    throw (new NotImplementedException('Please handle this type'));
                    break;
            }
        }

        if (is_null($this->id) && is_null($payload['id'])) {
            
            $sql = 'INSERT INTO ' . static::TABLE_NAME;
            $columns = '(' . implode(', ', array_keys($db_fields)) . ')';
            $sql .= " $columns";

            $values = '(' . sprintf('"%s"', implode('","', array_values($db_fields))) . ')';
            $sql .= " VALUES $values;";
           

            $connection = $this->database->getConnection();
            $connection->exec($sql);

            $this->id = $connection->lastInsertId();

            return true;
        }

        $sql = 'UPDATE ' . static::TABLE_NAME;
        $sql .= ' SET ';

        $key_value = [];
        foreach ($db_fields as $field => $value) {
            $key_value[] = "$field=\"$value\"";
        }
        $sql .= implode(', ', $key_value);
        $sql .= ' WHERE id = ' . $payload['id'] . ';';

        $connection = $this->database->getConnection();
        $connection->exec($sql);

        return true;
    }

    public static function find(int $id, $db_conn = null)
    {
        $db = $db_conn ?? new MysqlDBAdapter();
        $sql = 'SELECT * FROM ' . static::TABLE_NAME . " WHERE id = $id LIMIT 1;";
        $conn = $db->getConnection();
        $stmt = $conn->query($sql);
        $stmt->setFetchMode(PDO::FETCH_OBJ);
        $record = $stmt->fetch();

        if ($record) {
            $entity_class = get_called_class();
            $entity = new $entity_class();
            $fields = get_object_vars($record);
            foreach ($fields as $field_name => $value) {
                if (DateTime::createFromFormat('Y-m-d H:i:s', $value) !== false) {
                    $entity->$field_name = new DateTime($value);
                    continue;
                }
                $entity->$field_name = $value;
            }

            return $entity;
        }

        throw (new RecordNotFoundException("Can't find row with ID $id in table " . static::TABLE_NAME));
    }

    public static function findAll(i$db_conn = null)
    {
        $db = $db_conn ?? new MysqlDBAdapter();
        $sql = 'SELECT * FROM ' . static::TABLE_NAME . ";";
        $conn = $db->getConnection();
        $stmt = $conn->query($sql);
        $stmt->setFetchMode(PDO::FETCH_OBJ);
        $records = $stmt->fetchAll();
        return $records;
    }

    // public function destroy()
    // {
        // if (is_null($this->id)) {
            // throw (new ActiveRecordException("Can't delete a row without an id"));
        // }

        // static::delete($this->id);
    // }

    // public static function delete(int $id, $db_conn = null)
    // {
        // $db = $db_conn ?? new MysqlDBAdapter();
        // self::find($id);
        // $sql = 'DELETE FROM ' . static::TABLE_NAME . " WHERE id = $id";
        // $conn = $db->getConnection();
        // $conn->exec($sql);
    // }

    protected function getPublicVars()
    {
        $instance = new class
        {
            function getPublicVars($object)
            {
                return get_object_vars($object);
            }
        };
        return $instance->getPublicVars($this);
    }

    public static function checkEmployeeStatus(object $payload, int $employee_id, $db_conn = null)
    {
        $db = $db_conn ?? new MysqlDBAdapter();
        
        $sql = 'SELECT E.id FROM ' . static::TABLE_NAME . " E LEFT JOIN work_orders WO ON WO.employee_id=E.id INNER JOIN companies C ON E.company_id=C.id INNER JOIN holidays H
        ON E.id=H.employee_id WHERE NOT :proposed_start_date BETWEEN H.start_date
        AND H.end_date AND NOT :proposed_end_date BETWEEN H.start_date AND
        H.end_date AND NOT E.id IN (SELECT id FROM work_orders WHERE status='ACCEPT' AND
        employee_id=E.id);";
        
        
        $conn = $db->getConnection();
        $stmt = $conn->prepare($sql);

        $proposed_start_date = $payload->proposed_start_date->format("%Y-%m-%d %H:%M:%S");
        $proposed_end_date = $payload->proposed_end_date->format("%Y-%m-%d %H:%M:%S");
        
        echo $proposed_start_date;

        $stmt->execute(['proposed_start_date' => $proposed_start_date, 'proposed_end_date' => $proposed_end_date]);
    
        
        $stmt->setFetchMode(PDO::FETCH_OBJ);
        $rows = $stmt->fetchAll();
    
        foreach($rows as $field) {
            if ($field->id == $employee_id) {
                return false;
            }
        }
        return true;
        
    }
}
