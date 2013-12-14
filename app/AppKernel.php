<?php

use Symfony\Component\HttpKernel\Kernel;
use Symfony\Component\Config\Loader\LoaderInterface;

class AppKernel extends Kernel
{
    public function registerBundles()
    {
        $bundles = array(
            new Symfony\Bundle\FrameworkBundle\FrameworkBundle(),
            new Symfony\Bundle\SecurityBundle\SecurityBundle(),
            new Symfony\Bundle\TwigBundle\TwigBundle(),
            new Symfony\Bundle\MonologBundle\MonologBundle(),
            new Symfony\Bundle\SwiftmailerBundle\SwiftmailerBundle(),
            new Symfony\Bundle\AsseticBundle\AsseticBundle(),
            new Doctrine\Bundle\DoctrineBundle\DoctrineBundle(),
            new Sensio\Bundle\FrameworkExtraBundle\SensioFrameworkExtraBundle(),
        );

        if (in_array($this->getEnvironment(), array('dev', 'test'))) {
            $bundles[] = new Acme\DemoBundle\AcmeDemoBundle();
            $bundles[] = new Symfony\Bundle\WebProfilerBundle\WebProfilerBundle();
            $bundles[] = new Sensio\Bundle\DistributionBundle\SensioDistributionBundle();
            $bundles[] = new Sensio\Bundle\GeneratorBundle\SensioGeneratorBundle();
        }

        return $bundles;
    }

    public function registerContainerConfiguration(LoaderInterface $loader)
    {
        $loader->load(__DIR__.'/config/config_'.$this->getEnvironment().'.yml');
    }

    // Allow the methods getCacheDir and getLogDir to write to the kernel, and return a
    // a path in the Temp directory. Taken from http://chrisdev.de/2012/01/26/symfony2-mit-cloudcontrol/
    public function getCacheDir()
    {
        if ($this->getEnvironment() != 'prod') {
            parent::getLogDir();
        }
        
        $dir = sys_get_temp_dir() . '/sf2standard/cache';
        if (!is_dir($dir)) {
            mkdir($dir, 0777, true);
        }
        
        return $dir;
    }
 
    public function getLogDir()
    {
        if ($this->getEnvironment() != 'prod') {
            parent::getLogDir();
        }
        
        $dir = sys_get_temp_dir() . '/sf2standard/logs';
        if (!is_dir($dir)) {
            mkdir($dir, 0777, true);
        }
        
        return $dir;
    }
}
