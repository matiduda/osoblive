<?php

class SubmitContr extends Submit
{
    private $groupId;
    private $title;
    private $content;
    private $authorId;

    public function __construct($groupId, $title, $content, $authorId)
    {
        $this->groupId = $groupId;
        $this->title = $title;
        $this->content = $content;
        $this->authorId = $authorId;
    }

    public function submitPost()
    {
        if ($this->emptyInput() !== false) {
            header("location: ../submit.php?error=emptyinput");
            exit();
        }

        $this->setPost($this->groupId, $this->title, $this->content, $this->authorId);

        // TODO: Go to the posted thread
        header("location: ../submit.php?error=none");
        exit();
    }

    private function emptyInput()
    {
        $result = null;

        if (empty($this->content) || empty($this->title)) {
            $result = true;
        } else {
            $result = false;
        }

        return $result;
    }
}