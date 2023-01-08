<?php

class Submit extends Dbh
{
    protected function setPost($groupId, $title, $content, $authorId)
    {
        $stmt = $this->connect()->prepare('INSERT INTO posts (section_id, title, content, author_id) SELECT ?, ?, ?, users.id FROM users WHERE users.id = ?');
        if (!$stmt->execute(array($groupId, $title, $content, $authorId))) {
            $stmt = null;
            header("location: ../submit.php?error=stmtfailed");
            exit();
        }

        $stmt = null;
    }


    protected function getSections()
    {
        $stmt = $this->connect()->prepare('SELECT * FROM sections');

        if (!$stmt->execute()) {
            $stmt = null;
            header("location: ../submit.php?error=stmtfailed");
            exit();
        }

        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt = null;

        return $data;
    }
}
