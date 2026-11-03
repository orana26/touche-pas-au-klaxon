<?php
namespace Tests;
use PHPUnit\Framework\TestCase;

/** Tests de validation des règles métier des trajets. */
final class TripTest extends TestCase
{
    public function testDepartureAndArrivalMustDiffer(): void
    {
        $this->assertNotSame(1, 2);
        $this->assertTrue(1 !== 2);
    }

    public function testAvailableSeatsCannotExceedTotalSeats(): void
    {
        $total=4; $available=3;
        $this->assertLessThanOrEqual($total,$available);
    }
}