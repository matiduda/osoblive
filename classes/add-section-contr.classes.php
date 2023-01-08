<?php

class AddSectionContr extends AddSection
{
    private $sectionName;
    private $adminId;
    private $description;

    public function __construct($sectionName, $adminId, $description)
    {
        $this->sectionName = $sectionName;
        $this->adminId = $adminId;
        $this->description = $description;
    }

    public function add()
    {
        if ($this->emptyInput() !== false) {
            header("location: ../addsection.php?error=emptyinput");
            exit();
        }

        if ($this->invalidName() !== false) {
            header("location: ../addsection.php?error=invalidname");
            exit();
        }

        if ($this->sectionExists() !== false) {
            header("location: ../addsection.php?error=sectionexists");
            exit();
        }

        $this->setSection($this->sectionName, $this->adminId, $this->description);
    }
    // Error checking methods

    private function emptyInput()
    {
        $result = null;

        if (empty($this->sectionName) || empty($this->description)) {
            $result = true;
        } else {
            $result = false;
        }

        return $result;
    }

    private function invalidName()
    {
        $result = null;

        if (!preg_match("/^[a-zA-Z0-9]*$/", $this->sectionName)) {
            $result = true;
        } else {
            $result = false;
        }

        return $result;
    }

    private function sectionExists()
    {
        $result = null;

        if (!$this->checkSection($this->sectionName)) {
            $result = true;
        } else {
            $result = false;
        }

        return $result;
    }
}