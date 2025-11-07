<?php

namespace App\Enums;

enum CategoriesStatus:int
{
    case PENDING    = 0;
    case PROCESSING = 1;
    case COMPLETED  = 2;
    case CANCELLED  = 4;

    /**
     * Get the Bootstrap class and display text for each status.
     */
    public function labelAndBadge(): array
    {
        return match ($this) {
            self::PENDING    => ['label' => 'Pending', 'badge' => 'bg-secondary'],
            self::PROCESSING => ['label' => 'Processing', 'badge' => 'bg-info'],
            self::COMPLETED  => ['label' => 'Completed', 'badge' => 'bg-success'],
            self::CANCELLED  => ['label' => 'Cancelled', 'badge' => 'bg-danger'],
        };
    }
}
