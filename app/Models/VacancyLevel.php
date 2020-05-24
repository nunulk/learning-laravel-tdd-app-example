<?php

namespace App\Models;

class VacancyLevel
{
    private $remainingCount;

    public function __construct(int $remainingCount)
    {
        $this->remainingCount = $remainingCount;
    }

    public function mark(): string
    {
        if ($this->remainingCount === 0) {
            return '×';
        }
        if ($this->remainingCount < 5) {
            return '△';
        }
        return '◎';
    }

    public function __toString()
    {
        return $this->mark();
    }
}
