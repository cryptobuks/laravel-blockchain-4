<?php

namespace Tavux\LaravelBlockchain;


trait HasBlockchainWallet
{
    public function blockchainWallets(){
        return $this->hasMany(BlockchainWallet::class);
    }
}
