<?php

require_once($_SERVER['DOCUMENT_ROOT'] . '/web-lab/LB4-5/.core/index.php');

$itemAction = new ItemAction(DB::getInstance());
$itemAction->deleteClassroom();

header("Location: ".'/web-lab/LB4-5/secret/secret_page.php?delete_result=true');
exit();

?>