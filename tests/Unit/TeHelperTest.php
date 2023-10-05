<?php

namespace Tests\Unit;

use DTApi\Helpers\TeHelper;
use Tests\TestCase;

class TeHelperTest extends TestCase
{
    /**
     * @dataProvider expirationDataProvider
     */
    public function testWillExpireAt($due_time, $created_at, $expected)
    {
        $result = TeHelper::willExpireAt($due_time, $created_at);
        $this->assertEquals($expected, $result);
    }
}
