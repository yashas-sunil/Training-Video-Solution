<?php

namespace App\Common;

class PaymentStatus
{
    const SUCCESS = 1;
    const FAILURE = 2;
    const RETURNED = 3;
    const ABORTED = 4;
    const PENDING = 5;
}
