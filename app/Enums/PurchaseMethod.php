<?php

namespace App\Enums;

enum PurchaseMethod: int
{
    case CASH = 0;
    case HUTANG = 1;
    case TRANSFER = 2;
}
