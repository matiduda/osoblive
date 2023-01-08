<?php

class GroupView extends Group
{
    private $groupName;
    private $userId;

    public function __construct($groupName, $userId)
    {
        $this->groupName = $groupName;
        $this->userId = $userId;
    }

    public function displayGroupInfo($postId)
    {
        $data = $this->getGroupInfo($this->groupName);
        $subscribed = $this->isUserSubscribedTo($this->groupName, $this->userId);
        $numberOfSubscribers = $this->getNumberOfSubscribers($this->groupName);

        if (empty($data["description"])) {
            $data["description"] = "Ta grupa nie posiada opisu";
        }

        if (empty($data)) {
            echo "<p>Ta grupa nie istnieje</p><br>";
            return;
        }

        echo '<div class="group-info-wrapper">';
        echo "<h4><a href=\"group.php?name={$data["title"]}\">{$data["title"]}</a></h4>";
        echo "<p>{$data["description"]}</p>";
        echo "<h3>wątki&emsp;<strong>{$data["numberOfPosts"]}</strong></h3>";
        echo "<h3>subskrybujący&emsp;<strong>{$numberOfSubscribers}</strong></h3>";

        echo "<form action=\"includes/group.inc.php\" method=\"post\"><br>";
        echo "<input type=\"hidden\" name=\"groupName\" id=\"hiddenField\" value=\"{$this->groupName}\" />";
        echo "<input type=\"hidden\" name=\"postId\" id=\"hiddenField\" value=\"{$postId}\" />";

        if ($this->userId !== null) {
            if (!$subscribed) {
                echo '<button class="comment-button subscribe-button" type="submit" name="submit">Subskrybuj<i class="fa fa-check"></button>';
            } else {
                echo '<button class="comment-button subscribe-button" type="submit" name="submit">Wypisz się<i class="fa fa-check"></button>';
            }
        }
        echo "</form>";

        echo '</div>';
    }
}
