<?php

require_once('config/dbconnect.php');

class Todo
{
    private $table = 'tasks';
    private $db_manager;

    function __construct()
    {
        $this->db_manager = new DbManager();
        $this->db_manager->connect();
    }

    public function create($name)
    {
        $stmt = $this->db_manager->dbh->prepare('INSERT INTO ' . $this->table .' (name) VALUES (?)');
        $stmt->execute([$name]);

        // 最新のタスクのIDを返す
        $latestId = $this->db_manager->dbh->lastInsertId();
        return $latestId;
    }

    // 一覧を呼び出すためのメソッド

    public function all()
    {
        $stmt = $this->db_manager->dbh->prepare('SELECT * FROM ' . $this->table);
        $stmt->execute();
        $tasks = $stmt->fetchAll();
        return $tasks;
    }

    // editするためのデータを管理

    public function get($id)
    {
        $stmt = $this->db_manager->dbh->prepare('SELECT * FROM '.$this->table.' WHERE id = ?');
        $stmt->execute([$id]);
        $task = $stmt->fetch();

        return $task;
    }

    public function update($name, $id)
{
    $stmt = $this->db_manager->dbh->prepare('UPDATE ' . $this->table .' SET name = ? WHERE id = ?');
    $stmt->execute([$name, $id]);
}

    public function delete($id)
{
    $stmt = $this->db_manager->dbh->prepare('DELETE FROM ' . $this->table .' WHERE id = ?');
    $stmt->execute([$id]);
}

    // タスクを完了させるためのメソッド
    public function done($id)
    {
        // SQLの準備
        $stmt = $this->db_manager->dbh->prepare('UPDATE ' . $this->table .' SET done_flg = 1 WHERE id = ?');
        // 実行
        $stmt->execute([$id]);


    }
}