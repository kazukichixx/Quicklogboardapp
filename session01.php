<?php
session_start();

$old_session_id = session_id();
// 何か処理,,,,,,,,
session_regenerate_id(true); // 新しいIDが発行

$new_session_id = session_id();

echo $old_session_id;
echo '<br>';
echo $new_session_id;