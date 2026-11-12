<?php

namespace App\Enums;

enum ClassFormat: string
{
    case Online = 'online';
    case Offline = 'offline';
    case Either = 'either';
}
