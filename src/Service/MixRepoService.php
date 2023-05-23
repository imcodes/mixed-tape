<?php

namespace App\Service;

use Psr\Cache\CacheItemInterface;
use Symfony\Component\DependencyInjection\Attribute\Autowire;
use Symfony\Contracts\Cache\CacheInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class MixRepoService
{

    // private $http;
    // private $cache;

    function __construct(
        private HttpClientInterface $http,
        private CacheInterface $cache,
        //#[Autowire('%kernel.debug')]
        private bool $isDebug /*We will define the autowire value for this property in the services.yaml file*/
    )
    {
        // $this->http = $http;
        // $this->cache = $cache;
        // $this->isDebug = $isDebug;
    }

	function getAll(){
        return $this->cache->get('mix_data', function (CacheItemInterface $cachItem) {
            $cachItem->expiresAfter($this->isDebug ? 5:60); // expire in 5sec if debug mode true else 60sec 
            $response = $this->http->request('GET', 'https://raw.githubusercontent.com/SymfonyCasts/vinyl-mixes/main/mixes.json');
            return $response->toArray();
        });
    }
}