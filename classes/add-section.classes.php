<?php

class AddSection extends Dbh
{
    protected function checkSection($sectionName)
    {
        $stmt = $this->connect()->prepare('SELECT * FROM sections WHERE title = ?;');

        if (!$stmt->execute(array($sectionName))) {
            $stmt = null;
            header("location: ../addsection.php?error=stmtfailed");
            exit();
        }

        $resultCheck = null;

        if ($stmt->rowCount() > 0) {
            $resultCheck = false;
        } else {
            $resultCheck = true;
        }

        return $resultCheck;
    }

    protected function setSection($sectionName, $adminId, $description)
    {
        $stmt = $this->connect()->prepare('INSERT INTO sections (title, owner_id, description) VALUES (?, ?, ?);');

        if (!$stmt->execute(array($sectionName, $adminId, $description))) {
            $stmt = null;
            echo "could not set section to {$sectionName}, {$adminId}, {$description}";
            exit();
        }

        $stmt = null;
    }
}