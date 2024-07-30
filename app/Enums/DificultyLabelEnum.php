<?php

namespace App\Enums;

enum DificultyLabelEnum: string
{
    case VERY_EASY =  "Very Easy";
    case EASY = 'Easy';
    case MEDIUM = 'Medium';
    case HARD = 'Hard';
    case VERY_HARD = 'Very Hard';

    public static function toArray(){
        return array_column(self::cases(), 'value');
    }
}
