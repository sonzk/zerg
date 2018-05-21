<?php
/**
 * Created by PhpStorm.
 * User: lanlee
 * Date: 2018/5/11
 * Time: 下午9:24
 */

namespace app\lib\enum;


class OrderStatusEnum
{

    const UNPAID = 1;
    const PAID = 2;
    const DELIVERED = 3;
    const PAID_BUT_NOT_OF = 4;
}