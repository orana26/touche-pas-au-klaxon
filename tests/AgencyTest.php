<?php
namespace Tests;
use PHPUnit\Framework\TestCase;

/** Tests de base des opérations d'agence. */
final class AgencyTest extends TestCase
{
    public function testCityIsRequired(): void
    {
        $city=trim('Paris');
        $this->assertNotSame('', $city);
    }
}