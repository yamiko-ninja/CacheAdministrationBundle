<?php
namespace Yamiko\CacheAdministrationBundle;

use PHPUnit_Framework_TestCase;
use Symfony\Component\Filesystem\Exception\FileNotFoundException;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Finder\Finder;

/**
 * Class CacheManager
 * @package Yamiko\CacheAdministrationBundle
 */
class CacheManagerTest extends \PHPUnit_Framework_TestCase
{

    /** @var  CacheManager */
    protected $cache_manager;

    /** @var string test app root */
    private $appRoot = 'app';

    /** @var string test enviroment */
    private $enviroment = 'test';

    /** @var array dirs used in test */
    private $dirs = array(
        'annotations',
        'assetic',
        'doctrine',
        'translations',
        'profiler',
        'twig',
    );

    /** @var array files used in test */
    private $files = array(
        'appTestDebugProjectContainer.php',
        'appTestDebugProjectContainer.php.meta',
        'appTestDebugProjectContainer.xml',
        'appTestDebugProjectContainerCompiler.log',
        'appDevUrlGenerator.php',
        'appDevUrlGenerator.php.meta',
        'appDevUrlMatcher.php',
        'appDevUrlMatcher.php.meta',
        'classes.map',
        'classes.php',
        'classes.php.meta',
        'templates.php',
    );

    /**
     * create necessary files and directories
     */
    public function setUp()
    {
        if (!is_dir($this->appRoot)) {
            mkdir($this->appRoot);
        }
        if (!is_dir($this->appRoot.DIRECTORY_SEPARATOR.$this->enviroment)) {
            mkdir($this->appRoot.DIRECTORY_SEPARATOR.$this->enviroment);
        }

        foreach ($this->dirs as $dir) {
            if (!is_dir($this->appRoot.DIRECTORY_SEPARATOR.$this->enviroment.DIRECTORY_SEPARATOR.$dir)) {
                mkdir($this->appRoot.DIRECTORY_SEPARATOR.$this->enviroment.DIRECTORY_SEPARATOR.$dir);
            }
        }
        foreach ($this->files as $file) {
            if (!file_exists($this->appRoot.DIRECTORY_SEPARATOR.$this->enviroment.DIRECTORY_SEPARATOR.$file)) {
                touch($this->appRoot.DIRECTORY_SEPARATOR.$this->enviroment.DIRECTORY_SEPARATOR.$file);
            }
        }

        $this->cache_manager = new CacheManager($this->appRoot, $this->enviroment);
    }

    /**
     * Destroy any remaining files and directories created during setUP
     */
    public function tearDown()
    {
        foreach ($this->dirs as $dir) {
            if (is_dir($this->appRoot.DIRECTORY_SEPARATOR.$this->enviroment.DIRECTORY_SEPARATOR.$dir)) {
                rmdir($this->appRoot.DIRECTORY_SEPARATOR.$this->enviroment.DIRECTORY_SEPARATOR.$dir);
            }
        }
        foreach ($this->files as $file) {
            if (file_exists($this->appRoot.DIRECTORY_SEPARATOR.$this->enviroment.DIRECTORY_SEPARATOR.$file)) {
                unlink($this->appRoot.DIRECTORY_SEPARATOR.$this->enviroment.DIRECTORY_SEPARATOR.$file);
            }
        }

        if (is_dir($this->appRoot.DIRECTORY_SEPARATOR.$this->enviroment)) {
            rmdir($this->appRoot.DIRECTORY_SEPARATOR.$this->enviroment);
        }
        if (is_dir($this->appRoot)) {
            rmdir($this->appRoot);
        }
    }

    /**
     * test annotation deletion
     * @covers CacheManager::clearAnnotations
     */
    public function testClearAnnotations()
    {
        $this->assertTrue(
            is_dir($this->appRoot.DIRECTORY_SEPARATOR.$this->enviroment.DIRECTORY_SEPARATOR.'annotations')
        );
        $this->cache_manager->clearAnnotations();
        $this->assertFalse(
            is_dir($this->appRoot.DIRECTORY_SEPARATOR.$this->enviroment.DIRECTORY_SEPARATOR.'annotations')
        );
    }


    /**
     * test assetic deletion
     * @covers CacheManager::clearAssetic
     */
    public function testClearAssetic()
    {
        $this->assertTrue(is_dir($this->appRoot.DIRECTORY_SEPARATOR.$this->enviroment.DIRECTORY_SEPARATOR.'assetic'));
        $this->cache_manager->clearAssetic();
        $this->assertFalse(is_dir($this->appRoot.DIRECTORY_SEPARATOR.$this->enviroment.DIRECTORY_SEPARATOR.'assetic'));
    }

    /**
     * test doctrine deletion
     * @covers CacheManager::clearDoctrine
     */
    public function testClearDoctrine()
    {
        $this->assertTrue(is_dir($this->appRoot.DIRECTORY_SEPARATOR.$this->enviroment.DIRECTORY_SEPARATOR.'doctrine'));
        $this->cache_manager->clearDoctrine();
        $this->assertFalse(
            is_dir($this->appRoot.DIRECTORY_SEPARATOR.$this->enviroment.DIRECTORY_SEPARATOR.'doctrine')
        );
    }


    /**
     * test translations deletion
     * @covers CacheManager::clearTranslations
     */
    public function testClearTranslations()
    {
        $this->assertTrue(
            is_dir($this->appRoot.DIRECTORY_SEPARATOR.$this->enviroment.DIRECTORY_SEPARATOR.'translations')
        );
        $this->cache_manager->clearTranslations();
        $this->assertFalse(
            is_dir($this->appRoot.DIRECTORY_SEPARATOR.$this->enviroment.DIRECTORY_SEPARATOR.'translations')
        );
    }

    /**
     * test profile deletion
     * @covers CacheManager::clearProfiles
     */
    public function testClearProfiles()
    {
        $this->assertTrue(is_dir($this->appRoot.DIRECTORY_SEPARATOR.$this->enviroment.DIRECTORY_SEPARATOR.'profiler'));
        $this->cache_manager->clearProfiles();
        $this->assertFalse(
            is_dir($this->appRoot.DIRECTORY_SEPARATOR.$this->enviroment.DIRECTORY_SEPARATOR.'profiler')
        );
    }

    /**
     * test Container deletion
     * @covers CacheManager::clearContainer
     */
    public function testClearContainer()
    {

    }

    /**
     * test routing deletion
     * @covers CacheManager::clearRouting
     */
    public function testClearRouting()
    {

    }

    /**
     * test class deletion
     * @covers CacheManager::clearClasses
     */
    public function testClearClasses()
    {

    }

    /**
     * test template deletion
     * @covers CacheManager::clearTemplate
     */
    public function testClearTemplates()
    {

    }

    /**
     * test all deletion
     * @covers CacheManager::clearAll
     */
    public function clearAll()
    {
        //$this->clearAnnotations();
        //$this->clearAssetic();
        //$this->clearContainer();
        //$this->clearClasses();
        //$this->clearDoctrine();
        //$this->clearRouting();
        //$this->clearTemplates();
    }
}