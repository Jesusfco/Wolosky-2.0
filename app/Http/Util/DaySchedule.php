<?php

namespace Wolosky\Util;


class DaySchedule {
    public $day;
    public $schedules = [];

    public function dayView() {
        if($this->day == 1)
            return 'LUNES';
        if($this->day == 2)
            return 'LUNES';
        if($this->day == 3)
            return 'LUNES';
        if($this->day == 4)
            return 'LUNES';
        if($this->day == 5)
            return 'LUNES';
        if($this->day == 6)
            return 'LUNES';
        if($this->day == 7)
            return 'LUNES';
    }
}