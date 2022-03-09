<?php
namespace dom\codingChallenge;

class TaskController
{

    public static function create($task)
    {
        if(!empty($task)){
            $stmt = PDOdb::getInstance()->prepare("INSERT INTO Tasks (Name, Description, Priority, Status, DateCreated) Values(:name, :description, :priority, 0, datetime('now'))");
            $stmt->bindValue(':name', $task->name);
            $stmt->bindValue(':description', $task->description);
            $stmt->bindValue(':priority', $task->priority);
            return $stmt->execute();
        }
        return false;
    }

    public static function createTables()
    {
        $commands = ['CREATE TABLE IF NOT EXISTS Tasks (
                        Id   INTEGER PRIMARY KEY,
                        Name VARCHAR (255) NOT NULL,
                        Description TEXT NOT NULL,
                        Status tinyint NOT NULL DEFAULT 0,
                        Priority VARCHAR (15) NOT NULL,
                        CompletedDate text,
                        DateCreated text,
                        DateUpdated text
                        )',];
        foreach ($commands as $command) {
            PDOdb::getInstance()->exec($command);
        }
    }

    public static function getById($id)
    {
        $stmt = PDOdb::getInstance()->prepare("SELECT * FROM Tasks WHERE Id = :id;");
        $stmt->execute([":id" => $id]);
        return $stmt->fetchObject();
    }

    public static function remove($id)
    {
        $stmt = PDOdb::getInstance()->prepare("DELETE FROM Tasks WHERE Id = :id;");
        $stmt->bindValue(':id', $id);
        return $stmt->execute();

    }

    public static function complete($id)
    {
        $stmt = PDOdb::getInstance()->prepare("UPDATE Tasks SET Status = 1, CompletedDate = datetime('now') WHERE Id = :id;");
        $stmt->bindValue(':id', $id);
        return $stmt->execute();
    }

    public static function updatePriority($id, $priority)
    {
        $stmt = PDOdb::getInstance()->prepare("UPDATE Tasks SET Priority = :priority, DateUpdated = datetime('now') WHERE Id = :id;");
        return $stmt->execute([":priority" => $priority, ":id" => $id]);
    }

    public static function getAll()
    {
        $stmt = PDOdb::getInstance()->query("SELECT * FROM Tasks");
        return $stmt->fetchAll();
    }

    public static function getAllCompleted()
    {
        $completed = 1;
        $stmt = PDOdb::getInstance()->prepare("SELECT * FROM Tasks WHERE Status = ?;");
        $stmt->execute([$completed]);
        return $stmt->fetchAll();
    }

    public static function getCompletedTaskCount() {

        $stmt = PDOdb::getInstance()->prepare('SELECT COUNT(*) 
                                    FROM Tasks
                                   WHERE Status = ?;');
        $stmt->execute([1]);
        return $stmt->fetchColumn();
    }

    public static function getPendingTaskCount(){
        $stmt = PDOdb::getInstance()->prepare('SELECT COUNT(*) 
                                    FROM Tasks
                                   WHERE Status = ?;');
        $stmt->execute([0]);
        return $stmt->fetchColumn();
    }
}