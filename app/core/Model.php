<?php


namespace app\core;


use stdClass;

abstract class Model
{
    public static $db;

    public static function findByName(string $name): ?stdClass
    {
        $sql = 'SELECT * FROM ' . static::TABLE . ' WHERE name=:name';
        $result =  static::$db->query($sql, [':name' => $name]);
        return $result ? $result[0] : null;
    }

    public static function findAll(): array
    {
        $sql = 'SELECT * FROM ' . static::TABLE;
        return static::$db->query($sql);
    }

    public static function findById(string $id): ?stdClass
    {
        $sql = 'SELECT * FROM ' . static::TABLE . ' WHERE id=:id';
        $result = static::$db->query($sql, [':id' => $id]);
        return $result ? $result[0] : null;
    }

    public static function findByParentId(string $parentId): array
    {
        $sql = 'SELECT * FROM ' . static::TABLE . ' WHERE parentId=:parentId';
        return static::$db->query($sql, [':parentId' => $parentId]);
    }

    public static function update(object $object): void
    {
        $fields = get_object_vars ($object);
        $cols = [];
        $data = [];
        foreach ($fields as $name => $value) {
            if ($name === 'id') {
                $data[':' . $name] = $value;
                continue;
            }
            $cols[] = $name . '= :' . $name;
            $data[':' . $name] = $value;
        }
        $sql = 'UPDATE ' . static::TABLE . ' SET ' . implode (',', $cols) . ' WHERE id=:id';
        static::$db->execute($sql, $data);
    }

    public static function delete(array $id): void
    {
        $placeHolders = implode(',', array_fill(0, count($id), '?'));
        $sql = "DELETE FROM " . static::TABLE . " WHERE id IN ($placeHolders)";
        static::$db->execute($sql, $id);
    }
}