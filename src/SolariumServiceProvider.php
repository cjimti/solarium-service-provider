<?php

namespace Dafiti\Silex;

use Silex\Application;
use Silex\ServiceProviderInterface;
use Solarium\Client;

class SolariumServiceProvider implements ServiceProviderInterface
{
    /**
     * @var string
     */
    private $prefix = 'solarium';

    public function register(Application $app)
    {
        $paramKey = sprintf('%s.config', $this->prefix);

        if (!isset($app[$paramKey])) {
            $app[$paramKey] = [];
        }

        $app[$this->prefix] = $app->share(
            function () use ($app) {
                return new Client($app[$this->prefix . '.config']);
            }
        );
    }

    public function boot(Application $app)
    {
    }

    /**
     * @return string
     */
    public function getPrefix()
    {
        return $this->prefix;
    }

    /**
     * @param string $prefix
     * @return SolariumServiceProvider
     */
    public function setPrefix($prefix)
    {
        $this->prefix = $prefix;
        return $this;
    }
}
