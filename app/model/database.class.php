<?php

class Database
{
    private $db;

    public function __construct($f3)
    {
        $this->db = new DB\SQL(
            $f3->get('DB.driver') . ':host=' . $f3->get('DB.host') . ';port=' . $f3->get('DB.port') . ';dbname=' . $f3->get('DB.database'),
            $f3->get('DB.username'),
            $f3->get('DB.password')
        );
    }

    public function exec($sql, $params = [])
    {
        return $this->db->exec($sql, $params);
    }
}

?>