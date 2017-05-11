<?php

namespace Model;
class Tasks extends Model
{
    public function getTasks(string $userId)
    {
        $pdo = $this->connectDB();
        if ($pdo) {
            try {
                $pdoSt =
                    $pdo->prepare('
                      SELECT * FROM todo.tasks
                      JOIN task_user ON tasks.id = task_user.task_id
                      JOIN users ON task_user.user_id = users.id
                      WHERE users.id = :userId
                ');
                $pdoSt->execute([
                    ':userId' => $userId,
                ]);
                return $pdoSt->fetchAll();
            } catch (\PDOException $exception) {
                return null;
            }
        }
    }

    public function createTasks($user_id, $description)
    {
        $pdo = $this->connectDB();
        if ($pdo) {
            try {
                $pdoSt =
                    $pdo->prepare('
                      INSERT INTO tasks(`description`) VALUES(:description)
                ');
                $pdoSt->execute([
                    ':description' => $description,
                ]);
                $task_id = $pdo->lastInsertId();
                $this->attach($user_id, $task_id);
                var_dump('record added');
            } catch (\PDOException $exception) {
                return null;
            }
        }
    }

    public function attach($user_id, $task_id)
    {
        $pdo = $this->connectDB();
        if ($pdo) {
            try {
                $pdoSt =
                    $pdo->prepare('
                      INSERT INTO task_user(task_id, user_id) VALUES(:task_id, :user_id)
                ');
                $pdoSt->execute([
                    ':task_id' => $task_id,
                    ':user_id' => $user_id
                ]);
            } catch (\PDOException $exception) {
                return null;
            }
        }
    }

    public function updateTask($id, $description, $is_done)
    {
        $pdo = $this->connectDB();
        if ($pdo) {
            try {
                $pdoSt =
                    $pdo->prepare('
                     UPDATE tasks SET ' . ($description ? 'description = :description, ' : '') . ' is_done = :is_done WHERE id = :id
                ');
                $pdoSt->bindValue(':id', $id);
                $pdoSt->bindValue(':is_done', $is_done);
                if ($description) {
                    $pdoSt->bindValue(':description', $description);
                }
                $pdoSt->execute();
                var_dump('record updated');
            } catch (\PDOException $exception) {
                return null;
            }
        }
    }

    public function deleteTask($id)
    {
        $pdo = $this->connectDB();
        if ($pdo) {
            try {
                $pdoSt =
                    $pdo->prepare('
                     DELETE FROM tasks WHERE id = :id
                ');
                $pdoSt->execute([
                    ':id' => $id,
                ]);
                var_dump('task deleted');
            } catch (\PDOException $exception) {
                return null;
            }
        }
    }


}