<?php

class SubmitView extends Submit
{
    public function displayGroupList()
    {
        $data = $this->getSections();

        foreach ($data as $key => $value) {
            echo '<option value="' . $value["id"] . '">' . $value["title"] . '</option>';
        }
    }
}
