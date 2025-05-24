<?php
namespace Modules\Core\Packages\LiveLession;

interface LiveInterface {
    public function joinApi($lesson, $is_teacher=true);
    public function forceClose($lesson);
}