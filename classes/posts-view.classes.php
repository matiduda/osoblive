<?php

class PostsView extends Posts
{
    const REACTIONS = array(
        "like" => "👍",
        "love" => "❤️",
        "funny" => "😂",
        "sad" => "😥",
        "poop" => "💩"
    );

    public function displayAllPosts()
    {
        $posts = $this->getAllPosts();
        if (!$posts) {
            $this->displayEmptyBox();
        }

        foreach ($posts as $key => $value) {
            $date_text = $this->time_elapsed_string($value["creation_date"]);

            echo '<div class="post-wrapper">';

            echo '<span class="post-title">';
            echo "<strong><a href=\"group.php?name={$value["stitle"]}\">{$value["stitle"]}</a></strong><span> · {$value["nick_name"]} {$date_text}</span>";
            echo '</span>';

            $this->displayReactions($value['id'], "");

            echo "<h3><a href=\"thread.php?group={$value["stitle"]}&id={$value["id"]}\">{$value["title"]}</a></h3>";
            echo "<p>{$value["content"]}</p>";

            echo '</div>';
        }
    }

    public function displayUserPosts($userId)
    {
        $posts = $this->getUserPosts($userId);

        if (!$posts) {
            $this->displayEmptyBox();
        }
        foreach ($posts as $key => $value) {
            $date_text = $this->time_elapsed_string($value["creation_date"]);

            echo '<div class="post-wrapper">';

            echo '<span class="post-title">';
            echo "<strong><a href=\"group.php?name={$value["stitle"]}\">{$value["stitle"]}</a></strong><span> · {$value["nick_name"]} {$date_text}</span>";
            echo '</span>';

            $this->displayReactions($value['id'], "user");

            echo "<h3><a href=\"thread.php?group={$value["stitle"]}&id={$value["id"]}\">{$value["title"]}</a></h3>";
            echo "<p>{$value["content"]}</p>";
            echo '</div>';
        }
    }

    public function displayPostsFromGroup($userId, $groupName)
    {
        $posts = $this->getPostsFromGroup($groupName);

        if (!$posts) {
            $this->displayEmptyBox();
        }
        foreach ($posts as $key => $value) {
            $date_text = $this->time_elapsed_string($value["creation_date"]);
            $postId = $value['id'];

            echo '<div class="post-wrapper">';

            echo '<span class="post-title">';
            echo "<strong></strong><span>{$value["nick_name"]} · {$date_text}</span>";
            echo '</span>';

            $this->displayReactions($postId, $groupName);

            echo "<h3><a href=\"thread.php?group={$value["stitle"]}&id={$value["id"]}\">{$value["title"]}</a></h3>";
            echo "<p>{$value["content"]}</p>";

            $this->displayModeratorOptions($userId, $groupName, $postId);

            echo '</div>';
        }
    }

    public function displaySinglePost($userId, $groupName, $postId)
    {
        $value = $this->getSinglePost($groupName, $postId);
        $date_text = $this->time_elapsed_string($value["creation_date"]);
        $postId = $value['id'];

        echo '<div class="thread-post">';
        echo '<span class="post-title">';
        echo "<strong></strong><span>{$value["nick_name"]} · {$date_text}</span>";
        echo '</span>';

        $this->displayReactions($postId, $groupName);

        echo "<h3><a href=\"thread.php?group={$value["stitle"]}&id={$value["id"]}\">{$value["title"]}</a></h3>";
        echo "<p>{$value["content"]}</p>";

        $this->displayModeratorOptions($userId, $groupName, $postId);

        echo '</div>';
    }

    private function displayModeratorOptions($userId, $groupName, $postId)
    {
        $permissions = $this->getUserPermissions($userId, $groupName);

        if ($permissions['id'] == 1 || $permissions['id'] == 2) {
            // Display moderator options
            echo '<div class="admin-options-wrapper">';
            echo "<form action=\"includes/post-operations.inc.php\" method=\"post\">";

            echo "<input type=\"hidden\" name=\"postId\" id=\"hiddenField\" value=\"{$postId}\" />";
            echo "<input type=\"hidden\" name=\"groupName\" id=\"hiddenField\" value=\"{$groupName}\" />";

            echo '<button class="comment-button edit-button" type="submit" name="1">Usuń<i class="fa fa-check"></button>';
            echo '<button class="comment-button edit-button" type="submit" name="2">Ban<i class="fa fa-check"></button>';
            echo "</form>";
            echo '</div>';
        }
    }


    private function displayReactions($postId, $groupName, $arr = self::REACTIONS)
    {
        $reactions = $this->getReactions($postId);
        echo '<div class="reactions-wrapper">';
        echo "<form action=\"includes/add-reaction.inc.php\" method=\"post\"><br>";

        echo "<input type=\"hidden\" name=\"postId\" id=\"hiddenField\" value=\"{$postId}\" />";
        echo "<input type=\"hidden\" name=\"groupName\" id=\"hiddenField\" value=\"{$groupName}\" />";

        foreach ($reactions as $a => $r) {
            $reactionId = $r['id'];
            echo "<button class=\"reaction-button\" type=\"\submit\" name=\"{$reactionId}\">{$arr[$r["name"]]} {$r["cnt"]}</button>";
        }
        echo "</form>";
        echo '</div>';
    }

    private function displayEmptyBox()
    {
        echo '<div class="post-wrapper">';
        echo "<p>Brak postów</p>";
        echo '</div>';
    }

    private function time_elapsed_string($datetime, $full = false)
    {
        $now = new DateTime;
        $ago = new DateTime($datetime);
        $diff = $now->diff($ago);

        $diff->w = floor($diff->d / 7);
        $diff->d -= $diff->w * 7;

        $string = array(
            'y' => 'lata',
            'm' => 'mies.',
            'w' => 'tyg.',
            'd' => 'dni',
            'h' => 'godz.',
            'i' => 'min.',
            's' => 'sek.',
        );

        foreach ($string as $k => &$v) {
            if ($diff->$k) {
                $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? '' : '');
            } else {
                unset($string[$k]);
            }
        }

        if (!$full) $string = array_slice($string, 0, 1);
        return $string ? implode(', ', $string) . ' temu' : 'przed chwilą';
    }
}
