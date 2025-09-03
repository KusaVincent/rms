<?php

declare(strict_types=1);

namespace App\Enums;

enum MaintenanceStatus: int
{
    case PENDING = 0;
    case COMPLETED = 1;
    case IN_PROGRESS = 2;
}
