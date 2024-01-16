<?php

namespace App\Tests\Unit;

use PHPUnit\Framework\TestCase;
use DTApi\Helpers\TeHelper;

class TeHelperTest extends TestCase
{
    public function testWillExpireAt()
    {
        // Test case 1: $difference <= 90
        $dueTime = now();
        $createdAt = now()->subHours(89);
        $result = TeHelper::willExpireAt($dueTime, $createdAt);
        $this->assertEquals($dueTime->format('Y-m-d H:i:s'), $result);

        // Test case 2: $difference <= 24
        $dueTime = now()->addHours(2);
        $createdAt = now();
        $result = TeHelper::willExpireAt($dueTime, $createdAt);
        $expectedResult = $createdAt->addMinutes(90)->format('Y-m-d H:i:s');
        $this->assertEquals($expectedResult, $result);

        // Test case 3: $difference > 24 && $difference <= 72
        $dueTime = now()->addHours(30);
        $createdAt = now()->subHours(50);
        $result = TeHelper::willExpireAt($dueTime, $createdAt);
        $expectedResult = $createdAt->addHours(16)->format('Y-m-d H:i:s');
        $this->assertEquals($expectedResult, $result);

        // Test case 4: $difference > 72
        $dueTime = now()->addHours(80);
        $createdAt = now()->subHours(100);
        $result = TeHelper::willExpireAt($dueTime, $createdAt);
        $expectedResult = $dueTime->subHours(48)->format('Y-m-d H:i:s');
        $this->assertEquals($expectedResult, $result);
    }
}