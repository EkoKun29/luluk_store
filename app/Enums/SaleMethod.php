<?php

namespace App\Enums;

enum SaleMethod: int
{
    case CASH = 0;
    case PIUTANG = 1;
    case TRANSFER = 2;
}
