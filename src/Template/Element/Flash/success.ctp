<?php
if (!isset($params['escape']) || $params['escape'] !== false) {
    $message = h($message);
}
?>
<div class="alert alert-success" role = "alert" onclick="this.classList.add('hidden')"><i class="fa fa-check-circle" aria-hidden="true"></i><?= $message ?></div>
