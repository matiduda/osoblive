<?php

class Group extends Dbh
{
    protected function getGroupInfo($groupName)
    {
        $stmt = $this->connect()->prepare('SELECT sections.id, owner_id, sections.title, description, COUNT(sections.id) AS numberOfPosts FROM sections INNER JOIN posts ON posts.section_id = sections.id WHERE sections.title = ? GROUP BY sections.id');
        if (!$stmt->execute(array($groupName))) {
            $stmt = null;
            header("location: ../error.php?code=Efovapog");
            exit();
        }

        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $stmt = null;

        return $data[0];
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

    protected function subscribeUserToGroup($groupName, $userId)
    {
        $sectionId = $this->getGroupId($groupName);
        if (!$sectionId) {
            header("location: ../error.php?code=Fugudzok");
            exit();
        }

        $stmt = $this->connect()->prepare('INSERT INTO users_sections (user_id, section_id) VALUES (?, ?);');

        if (!$stmt->execute(array($userId, $sectionId))) {
            $stmt = null;
            header("location: ../error.php?code=Ozuacvar");
            exit();
        }

        $stmt = null;
    }

    protected function unsubscribeUserFromGroup($groupName, $userId)
    {
        $sectionId = $this->getGroupId($groupName);
        if (!$sectionId) {
            header("location: ../error.php?code=Hamuodu");
            exit();
        }

        $stmt = $this->connect()->prepare('DELETE FROM users_sections WHERE user_id = ? AND section_id = ?');

        if (!$stmt->execute(array($userId, $sectionId))) {
            $stmt = null;
            header("location: ../error.php?code=Imaemta");
            exit();
        }

        $stmt = null;
    }

    protected function isUserSubscribedTo($groupName, $userId)
    {
        $sectionId = $this->getGroupId($groupName);
        if (!$sectionId) {
            header("location: ../error.php?code=Narsehpek");
            exit();
        }

        $stmt = $this->connect()->prepare('SELECT * FROM users_sections WHERE user_id = ? AND section_id = ?');

        if (!$stmt->execute(array($userId, $sectionId))) {
            $stmt = null;
            header("location: ../error.php?code=Jeservo");
            exit();
        }

        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $stmt = null;

        if ($data[0]) {
            return true;
        }

        return false;
    }

    protected function getNumberOfSubscribers($groupName)
    {
        $sectionId = $this->getGroupId($groupName);
        if (!$sectionId) {
            header("location: ../error.php?code=Nagupof");
            exit();
        }

        $stmt = $this->connect()->prepare('SELECT COUNT(id) AS sum FROM `users_sections` WHERE section_id = ?');
        if (!$stmt->execute(array($sectionId))) {
            return null;
        }

        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $stmt = null;

        return $data[0]['sum'];
    }
}
