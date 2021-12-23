<?php declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Roozbeh\CoinexPhp\Market;

final class MarketTest extends TestCase
{
    /**
     * @todo get access id and key from https://www.coinex.com/apikey
     */
    private $ac = '<access key>';
    private $sk = '<security key>';

    public function testAcquireMarketList(): void
    {
        $market = new  Market($this->ac,$this->sk);

        $this->assertGreaterThan(0,count($market->acquireMarketList()));
    }

    public function testAcquireMarketStatistics(): void
    {
        $market = new  Market($this->ac,$this->sk);

        $this->assertGreaterThan(0,count($market->acquireMarketStatistics('BCHBTC')));
    }

    public function testAcquireAllMarketData(): void
    {
        $market = new  Market($this->ac,$this->sk);

        $this->assertGreaterThan(0,count($market->acquireAllMarketData()));
    }

    public function testAcquireMarketDepth(): void
    {
        $market = new  Market($this->ac,$this->sk);

        $this->assertGreaterThan(0,count($market->acquireMarketDepth('BCHBTC','0.0',5) ));
    }

}