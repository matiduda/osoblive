<?php

class Posts extends Dbh
{
    protected function getAllPosts()
    {
        $stmt = $this->connect()->prepare('SELECT posts.id, posts.title, content, creation_date, users.nick_name, sections.title AS stitle FROM posts INNER JOIN users ON posts.author_id = users.id INNER JOIN sections ON posts.section_id = sections.id ORDER BY creation_date DESC');
        if (!$stmt->execute()) {
            $stmt = null;
            header("location: ../error.php?code=Utjaabi");
            exit();
        }

        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $stmt = null;

        return $data;
    }

    protected function getUserPosts($userId)
    {
        $stmt = $this->connect()->prepare('SELECT posts.id, posts.title, content, creation_date, users.nick_name, sections.title AS stitle FROM posts INNER JOIN sections ON posts.section_id = sections.id INNER JOIN users_sections ON users_sections.section_id = posts.section_id INNER JOIN users ON users_sections.user_id = users.id WHERE users_sections.user_id = ? ORDER BY creation_date DESC');

        if (!$stmt->execute(array($userId))) {
            $stmt = null;
            header("location: ../error.php?code=Jidrimwu");
            exit();
        }

        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt = null;
        return $data;
    }

    protected function getPostsFromGroup($groupName)
    {
        $stmt = $this->connect()->prepare('SELECT posts.id, posts.title, content, creation_date, users.nick_name, sections.title AS stitle FROM posts INNER JOIN users ON posts.author_id = users.id INNER JOIN sections ON posts.section_id = sections.id WHERE sections.title = ? ORDER BY creation_date DESC');
        if (!$stmt->execute(array($groupName))) {
            $stmt = null;
            header("location: ../error.php?code=Jopatcem");
            exit();
        }

        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $stmt = null;

        return $data;
    }

    protected function getSinglePost($groupName, $postId)
    {
        $stmt = $this->connect()->prepare('SELECT posts.id, posts.title, content, creation_date, users.nick_name, sections.title AS stitle FROM posts INNER JOIN users ON posts.author_id = users.id INNER JOIN sections ON posts.section_id = sections.id WHERE sections.title = ? AND posts.id = ? ORDER BY creation_date DESC');
        if (!$stmt->execute(array($groupName, $postId))) {
            $stmt = null;
            header("location: ../error.php?code=Rakemrav");
            exit();
        }

        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $stmt = null;

        return $data[0];
    }

    protected function setReaction($postId, $userId, $reactionIndex)
    {
        $stmt = $this->connect()->prepare('INSERT INTO posts_reactions (user_id, post_id, reaction_id) VALUES (?, ?, ?)');

        if (!$stmt->execute(array($userId, $postId, $reactionIndex))) {
            $stmt = null;
            header("location: ../error.php?code=Pejinezew");
            exit();
        }

        $stmt = null;
    }

    protected function getUserReactionToPost($postId, $userId)
    {
        $stmt = $this->connect()->prepare('SELECT reaction_id FROM posts_reactions WHERE user_id = ? AND post_id = ?');

        if (!$stmt->execute(array($userId, $postId))) {
            $stmt = null;
            header("location: ../group.php?error=Zamabaw");
            exit();
        }

        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $stmt = null;

        if ($data[0] === null) {
            return -1;
        }

        return $data[0]['reaction_id'];
    }

    protected function removeUserReactionFromPost($postId, $userId)
    {
        $stmt = $this->connect()->prepare('DELETE FROM posts_reactions WHERE user_id = ? AND post_id = ?');

        if (!$stmt->execute(array($userId, $postId))) {
            $stmt = null;
            header("location: ../error.php?code=Buoheir");
            exit();
        }

        $stmt = null;
    }

    protected function getReactions($postId)
    {
        $stmt = $this->connect()->prepare('SELECT r.id, r.name, count(pr.reaction_id) as cnt from reactions r LEFT JOIN posts_reactions pr ON r.id = pr.reaction_id AND pr.post_id = ? GROUP BY r.id ORDER BY cnt DESC');
        if (!$stmt->execute(array($postId))) {
            $stmt = null;
            header("location: ../error.php?code=Odaifva");
            exit();
        }

        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt = null;
        return $data;
    }

    protected function getGroupId($groupName)
    {
        $stmt = $this->connect()->prepare('SELECT id FROM sections WHERE title = ?');
        if (!$stmt->execute(array($groupName))) {
            return null;
        }

        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $stmt = null;

        return $data[0]['id'];
    }

    protected function getAuthorId($postId)
    {
        $stmt = $this->connect()->prepare('SELECT author_id FROM posts WHERE id = ?');
        if (!$stmt->execute(array($postId))) {
            return null;
        }

        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $stmt = null;

        return $data[0]['author_id'];
    }

    protected function getUserPermissions($userId, $groupName)
    {
        $sectionId = $this->getGroupId($groupName);
        if (!$sectionId) {
            header("location: ../group.php?error=Luwnuhuc");

            exit();
        }

        $stmt = $this->connect()->prepare('SELECT * FROM users_permissions WHERE user_id = ? AND section_id = ?');
        if (!$stmt->execute(array($userId, $sectionId))) {
            $stmt = null;
            header("location: ../error.php?code=Cifailu");
            exit();
        }

        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt = null;
        return $data[0];
    }

    protected function banUserFromGroup($userId, $groupName)
    {
        $sectionId = $this->getGroupId($groupName);
        if (!$sectionId) {
            header("location: ../error.php?code=Purfupzo");
            exit();
        }
        $stmt = $this->connect()->prepare('INSERT INTO users_permissions (section_id, user_id, permission_id) VALUES (?, ?, ?);');
        if (!$stmt->execute(array($sectionId, $userId, 3))) {
            $stmt = null;
            header("location: ../error.php?code=Esejukful");
            exit();
        }

        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt = null;
    }

    protected function deletePostFromDatabase($postId)
    {
        // Remove all reactions
        $stmt = $this->connect()->prepare('DELETE FROM posts_reactions WHERE posts_reactions.post_id = ?;');
        if (!$stmt->execute(array($postId))) {
            $stmt = null;
            header("location: ../error.php?code=Uhpiuz");

            exit();
        }

        // Remove all comments
        $stmt = $this->connect()->prepare('DELETE FROM comments WHERE comments.post_id = ?;');
        if (!$stmt->execute(array($postId))) {
            $stmt = null;
            header("location: ../error.php?code=Ubiractib");
            exit();
        }

        $stmt = null;
        $stmt = $this->connect()->prepare('DELETE FROM posts WHERE id = ?');
        if (!$stmt->execute(array($postId))) {
            $stmt = null;
            header("location: ../error.php?code=Picuda");
            exit();
        }

        $stmt = null;
    }
}
