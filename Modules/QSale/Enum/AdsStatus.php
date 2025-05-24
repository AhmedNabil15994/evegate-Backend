<?php
namespace Modules\QSale\Enum;

class AdsStatus extends \SplEnum{
    // const __default = self::WAIT;
    const WAIT="wait";
    const PUBLIUSH="publish";
    const CONFIRM="confirm";
    const EXPIRED = "expired";
}