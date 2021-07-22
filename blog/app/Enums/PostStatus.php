<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static ActiveDraft()
 * @method static static ActivePublished()
 */
final class PostStatus extends Enum
{
    const Draft     =   0;
    const Published =   1;
}
