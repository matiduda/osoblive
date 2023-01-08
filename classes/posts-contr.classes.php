<?php

class PostsContr extends Posts
{
    private $postId;
    private $groupName;
    private $authorId;

    public function __construct($postId, $groupName, $authorId)
    {
        $this->postId = $postId;
        $this->groupName = $groupName;
        $this->authorId = $authorId;
    }

    public function addReaction($reactionId)
    {
        $userReaction = $this->getUserReactionToPost($this->postId, $this->authorId);
        if ($userReaction == $reactionId) {
            $this->removeUserReactionFromPost($this->postId, $this->authorId);
            return;
        }

        if ($userReaction != -1) {
            $this->removeUserReactionFromPost($this->postId, $this->authorId);
        }

        $this->setReaction($this->postId, $this->authorId, $reactionId);
    }

    public function removePost()
    {
        $permissions = $this->getUserPermissions($this->authorId, $this->groupName);
        if ($permissions['id'] != 1 && $permissions['id'] != 2) {
            return;
        }

        $this->deletePostFromDatabase($this->postId);
    }

    public function banPostAuthorFromGroup()
    {
        $userId = $this->getAuthorId($this->postId);
        echo "getAuthorId: " . $userId . '<br>';


        $permissions = $this->getUserPermissions($userId, $this->groupName);
        echo "permissions: " . $permissions['id'] . '<br>';

        if ($permissions['id'] == 1 || $permissions['id'] == 2) {
            return;
        }
        $this->banUserFromGroup($userId, $this->groupName);
    }
}
