<?php

namespace App\Enums;

enum PaymentMethod: int
{
    case CASH = 0;
    case TRANSFER = 1;
}
