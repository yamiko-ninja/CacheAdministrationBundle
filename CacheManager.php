<?php
namespace Yamiko\CacheAdministrationBundle;

use Symfony\Component\Filesystem\Exception\FileNotFoundException;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Finder\Finder;
use Monolog\Logger;

/**
 * Class CacheManager
 * @package Yamiko\CacheAdministrationBundle
 */
class CacheManager
{
    /** @var Filesystem */
    private $filesystm;

    /** @var  Logger */
    private $logger;

    /** @var string path to cache directory */
    private $cacheDir;

    /**
     * @param string $cacheDir path to application root directory
     */
    public function __construct($cacheDir, Logger $logger)
    {
        if (!is_dir($cacheDir)) {
            throw new FileNotFoundException(null, 0, null, $cacheDir);
        }
        $this->cacheDir = $cacheDir;
        $this->filesystm = new Filesystem();
        $this->logger = $logger;
    }

    /**
     * Clear annotations cache
     */
    public function clearAnnotations()
    {
        $this->logger->notice("clearing annotations cache");
        $this->filesystm->remove($this->cacheDir.'/annotations');
        $this->logger->notice("finished clearing annotations cache");
    }

    /**
     * clear assetic cache
     */
    public function clearAssetic()
    {
        $this->logger->notice("clearing assetic cache");
        $this->filesystm->remove($this->cacheDir.'/assetic');
        $this->logger->notice("finished clearing assetic cache");
    }

    /**
     * clear doctrine cache
     */
    public function clearDoctrine()
    {
        $this->logger->notice("clearing doctrine cache");
        $this->filesystm->remove($this->cacheDir.'/doctrine');
        $this->logger->notice("finished clearing doctrine cache");
    }

    /**
     * clear translations cache
     */
    public function clearTranslations()
    {
        $this->logger->notice("clearing translations cache");
        $this->filesystm->remove($this->cacheDir.'/translations');
        $this->logger->notice("finished clearing translations cache");
    }

    /**
     * clear profiles cache
     */
    public function clearProfiles()
    {
        $this->logger->notice("clearing profiler cache");
        $this->filesystm->remove($this->cacheDir.'/profiler');
        $this->logger->notice("finished clearing profiler cache");
    }

    /**
     * clear container cache
     */
    public function clearContainer()
    {
        $this->logger->notice("clearing container cache");
        $finder = new Finder();
        $finder->name('*ProjectContainer*');
        $this->filesystm->remove($finder->in($this->cacheDir.DIRECTORY_SEPARATOR));
        $this->logger->notice("finished clearing container cache");
    }

    /**
     * clear routing cache
     */
    public function clearRouting()
    {
        $this->logger->notice("clearing routing cache");
        $finder = new Finder();
        $finder->name('*UrlGenerator*');
        $this->filesystm->remove($finder->in($this->cacheDir.'/'));
        $finder->name('*UrlMatcher*');
        $this->filesystm->remove($finder->in($this->cacheDir.'/'));
        $this->logger->notice("finished clearing routing cache");
    }

    /**
     * clear classes cache
     */
    public function clearClasses()
    {
        $this->logger->notice("clearing classes cache");
        $finder = new Finder();
        $finder->name('classes*');
        $this->filesystm->remove($finder->in($this->cacheDir.'/'));
        $this->logger->notice("finished clearing classes cache");
    }

    /**
     * clear templates cache
     */
    public function clearTemplates()
    {
        $this->logger->notice("clearing templates cache");
        $this->filesystm->remove($this->cacheDir.'/twig');
        $finder = new Finder();
        $finder->name('templates*');
        $this->filesystm->remove($finder->in($this->cacheDir.'/'));
        $this->logger->notice("finished clearing templates cache");
    }

    /**
     * clear all caches
     */
    public function clearAll()
    {
        $this->logger->notice("clearing all caches");
        $this->clearAnnotations();
        $this->clearAssetic();
        $this->clearContainer();
        $this->clearClasses();
        $this->clearDoctrine();
        $this->clearRouting();
        $this->clearTemplates();
        $this->logger->notice("finished clearing annotations cache");
    }
}
