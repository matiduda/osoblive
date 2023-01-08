<?php

class CommentsView extends Comments
{
    public function displayAllComments($threadId)
    {
        $posts = $this->getAllComments($threadId);

        foreach ($posts as $key => $value) {
            $date_text = $this->time_elapsed_string($value["creation_date"]);
            echo '<div class="thread-comment">';
            echo "<a>{$value["nick_name"]}</a> · {$date_text}";
            echo "<p>{$value["content"]}</p>";
            echo '</div>';
        }
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