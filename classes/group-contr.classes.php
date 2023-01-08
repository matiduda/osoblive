<?php

class GroupContr extends Group
{
    private $groupName;
    private $userId;
    private $getBackURL;

    public function __construct($groupName, $userId, $getBackURL)
    {
        $this->groupName = $groupName;
        $this->userId = $userId;
        $this->getBackURL = $getBackURL;
    }

    public function switchSubsctiption()
    {
        if (!$this->isUserSubscribedTo($this->groupName, $this->userId)) {
            // Subscribe
            $this->subscribeUserToGroup($this->groupName, $this->userId);
        } else {
            // Delete subscription entry
            $this->unsubscribeUserFromGroup($this->groupName, $this->userId);
        }
    }
}
