<?php

namespace Tavux\LaravelBlockchain;

use Illuminate\Support\Facades\DB;

trait HasBlockchainAddress
{
    private $_blockchain_address = '';
    public $_blockchain_custom_address = null;
    public $_blockchain_auto_add_custom_password = null;

    public static function boot()
    {
        parent::boot();

        /**
         * Create BlockChainAddress
         */
        self::created(function ($model) {
            $blockchainAddress = new BlockchainAddress();
            if($model->_blockchain_custom_address !== NULL){
                $blockchainAddress->address = $model->_blockchain_custom_address;
            }else{
                $blockchainAddress->address = Jcsofts\LaravelEthereum\Facade\Ethereum::personal_newAccount(
                    $model->_blockchain_auto_add_custom_password?$model->_blockchain_auto_add_custom_password:""
                );
            }

            $blockchainAddress->object_id = $model->id;
            $blockchainAddress->object_type = $model->getTable();
            $blockchainAddress->save();

            $model->_blockchain_custom_password = null;
        });
    }

    /**
     * @return BlockchainAddress|null
     */
    public function getBlockchainAddressAttribute(){
        if($this->_blockchain_address == ''){
            $this->_blockchain_address = DB::table((new BlockchainAddress())->getTable())->where([
                'object_type' => $this->getTable(),
                'object_id' => $this->id
            ])->first();
        }

        return $this->_blockchain_address;
    }

    /**
     * @return string|null
     */
    public function getBlockchainAddress(){
        $this->_blockchain_address = $this->getBlockchainAddressAttribute();
        if($this->_blockchain_address){
            return $this->_blockchain_address->address;
        }

        return null;
    }
}
