<?php
declare(strict_types=1);

namespace App\Enum;
enum MessageAspect: string
{
    case Question = 'message.types.question';
    case Suggestion = 'message.types.suggestion';
    case Problem = 'message.types.problem';
    case Other = 'message.types.other';
}
