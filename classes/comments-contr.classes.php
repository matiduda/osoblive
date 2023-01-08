<?php

class CommentsContr extends Comments
{
    private $authorId;
    private $threadId;
    private $commentContent;
    private $getBackURL;

    public function __construct($authorId, $threadId, $commentContent, $getBackURL)
    {
        $this->authorId = $authorId;
        $this->threadId = $threadId;
        $this->commentContent = $commentContent;
        $this->getBackURL = $getBackURL;
    }

    public function add()
    {
        if ($this->emptyInput() !== false) {
            return 'emptyinput';
        }

        $this->addComment($this->authorId, $this->threadId, $this->commentContent, $this->getBackURL);
    }

    private function emptyInput()
    {
        $result = null;

        if (empty($this->commentContent)) {
            $result = true;
        } else {
            $result = false;
        }

        return $result;
    }
}
