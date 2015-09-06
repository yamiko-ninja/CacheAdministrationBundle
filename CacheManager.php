<?php
namespace Yamiko\CacheAdministrationBundle;

use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Finder\Finder;
use Symfony\Component\Filesystem\Exception\FileNotFoundException;

/**
 * Class CacheManager
 * @package Yamiko\CacheAdministrationBundle
 */
class CacheManager
{
    private $filesystm;
    private $app_root;
    private $enviroment;
    private $cache_dir;

    public function __construct($app_root, $enviroment)
    {
        if(!is_dir($app_root)){
            throw new FileNotFoundException(null, 0, null, $app_root);
        }
        $this->app_root = $app_root;
        $this->enviroment = $enviroment;
        $this->cache_dir = $app_root . '/' . $enviroment;
        $this->filesystm = new Filesystem();
    }

    public function clearAnnotations()
    {
        $this->filesystm->remove($this->cache_dir . '/annotations');
    }

    public function clearAssetic()
    {
        $this->filesystm->remove($this->cache_dir . '/assetic');
    }

    public function clearDoctrine()
    {
        $this->filesystm->remove($this->cache_dir . '/doctrine');
    }

    public function clearTranslations()
    {
        $this->filesystm->remove($this->cache_dir . '/translations');
    }

    public function clearProfiles()
    {
        $this->filesystm->remove($this->cache_dir . '/profiler');
    }

    public function clearContainer()
    {
        $finder = new Finder();
        $finder->name('*ProjectContainer*');
        $this->filesystm->remove($finder->in($this->cache_dir . '/'));
    }

    public function clearRouting()
    {
        $finder = new Finder();
        $finder->name('*UrlGenerator*');
        $this->filesystm->remove($finder->in($this->cache_dir . '/'));
        $finder->name('*UrlMatcher*');
        $this->filesystm->remove($finder->in($this->cache_dir . '/'));
    }

    public function clearClasses()
    {
        $finder = new Finder();
        $finder->name('classes*');
        $this->filesystm->remove($finder->in($this->cache_dir . '/'));
    }

    public function clearTemplates()
    {
        $this->filesystm->remove($this->cache_dir . '/twig');
        $finder = new Finder();
        $finder->name('templates*');
        $this->filesystm->remove($finder->in($this->cache_dir . '/'));
    }

    public function clearAll()
    {
        $this->clearAnnotations();
        $this->clearAssetic();
        $this->clearContainer();
        $this->clearClasses();
        $this->clearDoctrine();
        $this->clearRouting();
        $this->clearTemplates();
    }
}