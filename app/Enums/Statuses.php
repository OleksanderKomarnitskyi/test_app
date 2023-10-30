<?php

namespace App\Enums;

use App\Traits\Enums\ToArrayConverterTrait;

enum Statuses: string
{
    use ToArrayConverterTrait;

    case Active = 'active';
    case Draft = 'draft';
    case Blocked = 'blocked';

}
