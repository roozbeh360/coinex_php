<?php


namespace Roozbeh\CoinexPhp;

use phpDocumentor\Reflection\Types\Integer;

class Common
{
    use Initiator\Api;

    /*
     * https://github.com/coinexcom/coinex_exchange_api/wiki/070currency_rate
     */
    public function acquireCurrencyRate(){
        $this->connection->url = '/common/currency/rate';
        return $this->prepareResult($this->connection->send());
    }

    /*
     * https://github.com/coinexcom/coinex_exchange_api/wiki/071asset_config
     */
    /**
     * @param string|null $coinType
     * @return mixed
     */
    public function AcquireAssetConfig(string $coinType = null){
        $this->connection->url = '/common/asset/config';
        $this->connection->params = ['coin_type'=>$coinType];
        return $this->prepareResult($this->connection->send());
    }

    /*
     * https://github.com/coinexcom/coinex_exchange_api/wiki/Acquire-Site-Maintain-Info
     */
    public function acquireSiteMaintainInfo(){
        $this->connection->url = '/common/maintain/info';
        return $this->prepareResult($this->connection->send());
    }

}