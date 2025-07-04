<?php 
abstract class Model{

    protected static string $table;
    protected static string $primary_key = "id";

    public static function find(mysqli $mysqli, int $id){
        $sql = sprintf("Select * from %s WHERE %s = ?", 
                        static::$table, 
                        static::$primary_key);
        
        $query = $mysqli->prepare($sql);
        $query->bind_param("i", $id);
        $query->execute();

        $data = $query->get_result()->fetch_assoc();

        return $data ? new static($data) : null;
    }

    public static function all(mysqli $mysqli){
        $sql = sprintf("Select * from %s", static::$table);
        
        $query = $mysqli->prepare($sql);
        $query->execute();

        $data = $query->get_result();

        $objects = [];
        while($row = $data->fetch_assoc()){
            $objects[] = new static($row);
        }

        return $objects;
    }
    public static function create(mysqli $mysqli, array $data, string $types) {
        $columns = implode(", ", array_keys($data));
        $placeholders = implode(", ", array_fill(0, count($data), "?"));
        
        $sql = sprintf("INSERT INTO %s (%s) VALUES (%s)", 
                        static::$table, $columns, $placeholders);
        
        $query = $mysqli->prepare($sql);
        $query->bind_param($types, ...array_values($data));
        $query->execute();

        return $mysqli->insert_id;
    }
    public static function deleteByID(mysqli $mysqli, int $id) {
        $sql = sprintf("DELETE FROM %s WHERE %s = ?",
         static::$table, static::$primary_key);

        $query = $mysqli->prepare($sql);
        $query->bind_param("i", $id);
        
        return $query->execute();  
    }

    public static function deleteAll(mysqli $mysqli) {
        $sql = sprintf("DELETE FROM %s",
         static::$table);

        $query = $mysqli->prepare($sql); 
        
        return $query->execute();  
    }
    public static function update(mysqli $mysqli, string $types, string $column_name, $new_value, int $id){
        $sql = sprintf("UPDATE %s SET %s = ? WHERE %s = ?",
        static::$table, $column_name, static::$primary_key);

        $query = $mysqli->prepare($sql);
        $query->bind_param($types, $new_value, $id);

        return $query->execute();
    }

}



