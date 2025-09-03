<?php

$file = dirname(__DIR__, 2).'/vendor/topthink/framework/src/think/route/dispatch/Callback.php';
if (file_exists($file)) {
    $oriSegment = 'if (class_exists($this->class)) {';
    $newSegment = <<<EOF
    \$suffix = \$this->rule->config('controller_suffix') ? 'Controller' : '';
    \$this->class = \$this->class . \$suffix;
EOF;

    $content = file_get_contents($file);
    if (!str_contains($content, 'controller_suffix')) {
        $content = str_replace($oriSegment, $newSegment.$oriSegment, $content);
        file_put_contents($file, $content);
    }
}
