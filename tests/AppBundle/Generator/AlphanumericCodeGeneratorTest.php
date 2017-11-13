<?php
namespace Tests\AppBundle\Generator;

use AppBundle\DataProvider\DataProvider;
use AppBundle\Generator\AlphanumericCodeGenerator;
use AppBundle\Generator\CodeGenerator;
use InvalidArgumentException;
use Mockery as m;
use Mockery\MockInterface;
use PHPUnit\Framework\TestCase;

class AlphanumericCodeGeneratorTest extends TestCase
{
    const ALPHANUMERIC_SET = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';

    /**
     * @var CodeGenerator
     */
    private $generator;

    /**
     * @var DataProvider|MockInterface
     */
    private $dataProvider;

    protected function setUp()
    {
        $this->dataProvider = m::mock(DataProvider::class);

        $this->generator = new AlphanumericCodeGenerator(
            $this->dataProvider
        );

        $this->dataProvider
            ->shouldReceive('getData')
            ->andReturn(
                self::ALPHANUMERIC_SET
            );
    }

    protected function tearDown()
    {
        m::close();
    }

    public function correctDataProvider()
    {
        return [
            [
                'quantity' => 10000,
                'length' => 6,
            ],
            [
                'quantity' => 1,
                'length' => 7,
            ],
        ];
    }

    /**
     * @test
     * @dataProvider correctDataProvider
     * @var $quantity
     * @var $length
     */
    public function generateCodes($quantity, $length)
    {
        $codes = $this->generator->generateCodes($quantity, $length);

        $this->assertEquals($length, strlen($codes[0]));
        $this->assertCount($quantity, $codes);
    }

    public function invalidDataProvider()
    {
        return [
            [
                'quantity' => 100000,
                'length' => 5,
            ],
            [
                'quantity' => 63,
                'length' => 1,
            ],
        ];
    }

    /**
     * @test
     * @dataProvider invalidDataProvider
     * @expectedException InvalidArgumentException
     * @var $quantity
     * @var $length
     */
    public function generatorShouldThrowInvalidArgumentException($quantity, $length)
    {
        $this->generator->generateCodes($quantity, $length);
    }
}
