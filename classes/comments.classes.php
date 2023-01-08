<?php

class Comments extends Dbh
{
    protected function getAllComments($threadId)
    {
        $stmt = $this->connect()->prepare('SELECT comments.id, users.nick_name, comments.content, comments.creation_date FROM comments INNER JOIN users ON comments.author_id = users.id INNER JOIN posts ON comments.post_id = posts.id WHERE comments.post_id = ? ORDER BY creation_date ASC');

        if (!$stmt->execute(array($threadId))) {
            $stmt = null;
            header("location: ../error.php?code=Kigsawlot");
            exit();
        }

        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $stmt = null;

        return $data;
    }

    protected function addComment($authorId, $threadId, $content, $getBackURL)
    {
        // Add comment without a parent
        $stmt = $this->connect()->prepare('INSERT INTO comments (post_id, author_id, content) SELECT posts.id, users.id, ? FROM posts, users WHERE posts.id = ? AND users.id = ?');

        if (!$stmt->execute(array($content, $threadId, $authorId))) {
            $stmt = null;
            header("location: ../error.php?code=Gitmazo");
            exit();
        }

        $stmt = null;
    }
}
