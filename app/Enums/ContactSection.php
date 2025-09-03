<?php

declare(strict_types=1);

namespace App\Enums;

enum ContactSection: int
{
    case ALL = 0;
    case CONTACT = 1;
    case FOOTER = 2;
}
