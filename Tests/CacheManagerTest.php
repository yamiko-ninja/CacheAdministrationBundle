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
    private $cacheDir = 'app/test';

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
        if (!is_dir('app')) {
            mkdir('app');
        }
        if (!is_dir($this->cacheDir)) {
            mkdir($this->cacheDir);
        }

        foreach ($this->dirs as $dir) {
            if (!is_dir($this->cacheDir.DIRECTORY_SEPARATOR.$dir)) {
                mkdir($this->cacheDir.DIRECTORY_SEPARATOR.$dir);
            }
        }
        foreach ($this->files as $file) {
            if (!file_exists($this->cacheDir.DIRECTORY_SEPARATOR.$file)) {
                touch($this->cacheDir.DIRECTORY_SEPARATOR.$file);
            }
        }

        $this->cache_manager = new CacheManager($this->cacheDir);
    }

    /**
     * Destroy any remaining files and directories created during setUP
     */
    public function tearDown()
    {
        foreach ($this->dirs as $dir) {
            if (is_dir($this->cacheDir.DIRECTORY_SEPARATOR.$dir)) {
                rmdir($this->cacheDir.DIRECTORY_SEPARATOR.$dir);
            }
        }
        foreach ($this->files as $file) {
            if (file_exists($this->cacheDir.DIRECTORY_SEPARATOR.$file)) {
                unlink($this->cacheDir.DIRECTORY_SEPARATOR.$file);
            }
        }

        if (is_dir($this->cacheDir)) {
            rmdir($this->cacheDir);
        }
        if (is_dir($this->cacheDir)) {
            rmdir($this->cacheDir);
        }
    }

    /**
     * test annotation deletion
     * @covers CacheManager::clearAnnotations
     */
    public function testClearAnnotations()
    {
        $this->assertTrue(
            is_dir($this->cacheDir.DIRECTORY_SEPARATOR.'annotations')
        );
        $this->cache_manager->clearAnnotations();
        $this->assertFalse(
            is_dir($this->cacheDir.DIRECTORY_SEPARATOR.'annotations')
        );
    }


    /**
     * test assetic deletion
     * @covers CacheManager::clearAssetic
     */
    public function testClearAssetic()
    {
        $this->assertTrue(is_dir($this->cacheDir.DIRECTORY_SEPARATOR.'assetic'));
        $this->cache_manager->clearAssetic();
        $this->assertFalse(is_dir($this->cacheDir.DIRECTORY_SEPARATOR.'assetic'));
    }

    /**
     * test doctrine deletion
     * @covers CacheManager::clearDoctrine
     */
    public function testClearDoctrine()
    {
        $this->assertTrue(is_dir($this->cacheDir.DIRECTORY_SEPARATOR.'doctrine'));
        $this->cache_manager->clearDoctrine();
        $this->assertFalse(
            is_dir($this->cacheDir.DIRECTORY_SEPARATOR.'doctrine')
        );
    }


    /**
     * test translations deletion
     * @covers CacheManager::clearTranslations
     */
    public function testClearTranslations()
    {
        $this->assertTrue(
            is_dir($this->cacheDir.DIRECTORY_SEPARATOR.'translations')
        );
        $this->cache_manager->clearTranslations();
        $this->assertFalse(
            is_dir($this->cacheDir.DIRECTORY_SEPARATOR.'translations')
        );
    }

    /**
     * test profile deletion
     * @covers CacheManager::clearProfiles
     */
    public function testClearProfiles()
    {
        $this->assertTrue(is_dir($this->cacheDir.DIRECTORY_SEPARATOR.'profiler'));
        $this->cache_manager->clearProfiles();
        $this->assertFalse(
            is_dir($this->cacheDir.DIRECTORY_SEPARATOR.'profiler')
        );
    }

    /**
     * test Container deletion
     * @covers CacheManager::clearContainer
     */
    public function testClearContainer()
    {
        $this->assertTrue(file_exists($this->cacheDir.DIRECTORY_SEPARATOR.'appTestDebugProjectContainer.php'));
        $this->assertTrue(file_exists($this->cacheDir.DIRECTORY_SEPARATOR.'appTestDebugProjectContainer.php.meta'));
        $this->assertTrue(file_exists($this->cacheDir.DIRECTORY_SEPARATOR.'appTestDebugProjectContainer.xml'));
        $this->assertTrue(file_exists($this->cacheDir.DIRECTORY_SEPARATOR.'appTestDebugProjectContainerCompiler.log'));
        $this->cache_manager->clearContainer();
        $this->assertFalse(file_exists($this->cacheDir.DIRECTORY_SEPARATOR.'appTestDebugProjectContainer.php'));
        $this->assertFalse(file_exists($this->cacheDir.DIRECTORY_SEPARATOR.'appTestDebugProjectContainer.php.meta'));
        $this->assertFalse(file_exists($this->cacheDir.DIRECTORY_SEPARATOR.'appTestDebugProjectContainer.xml'));
        $this->assertFalse(file_exists($this->cacheDir.DIRECTORY_SEPARATOR.'appTestDebugProjectContainerCompiler.log'));
    }

    /**
     * test routing deletion
     * @covers CacheManager::clearRouting
     */
    public function testClearRouting()
    {
        $this->assertTrue(file_exists($this->cacheDir.DIRECTORY_SEPARATOR.'appDevUrlGenerator.php'));
        $this->assertTrue(file_exists($this->cacheDir.DIRECTORY_SEPARATOR.'appDevUrlGenerator.php.meta'));
        $this->assertTrue(file_exists($this->cacheDir.DIRECTORY_SEPARATOR.'appDevUrlMatcher.php'));
        $this->assertTrue(file_exists($this->cacheDir.DIRECTORY_SEPARATOR.'appDevUrlMatcher.php.meta'));
        $this->cache_manager->clearRouting();
        $this->assertFalse(file_exists($this->cacheDir.DIRECTORY_SEPARATOR.'appDevUrlGenerator.php'));
        $this->assertFalse(file_exists($this->cacheDir.DIRECTORY_SEPARATOR.'appDevUrlGenerator.php.meta'));
        $this->assertFalse(file_exists($this->cacheDir.DIRECTORY_SEPARATOR.'appDevUrlMatcher.php'));
        $this->assertFalse(file_exists($this->cacheDir.DIRECTORY_SEPARATOR.'appDevUrlMatcher.php.meta'));
    }

    /**
     * test class deletion
     * @covers CacheManager::clearClasses
     */
    public function testClearClasses()
    {
        $this->assertTrue(file_exists($this->cacheDir.DIRECTORY_SEPARATOR.'classes.map'));
        $this->assertTrue(file_exists($this->cacheDir.DIRECTORY_SEPARATOR.'classes.php'));
        $this->assertTrue(file_exists($this->cacheDir.DIRECTORY_SEPARATOR.'classes.php.meta'));
        $this->cache_manager->clearClasses();
        $this->assertFalse(file_exists($this->cacheDir.DIRECTORY_SEPARATOR.'classes.map'));
        $this->assertFalse(file_exists($this->cacheDir.DIRECTORY_SEPARATOR.'classes.php'));
        $this->assertFalse(file_exists($this->cacheDir.DIRECTORY_SEPARATOR.'classes.php.meta'));
    }

    /**
     * test template deletion
     * @covers CacheManager::clearTemplate
     */
    public function testClearTemplates()
    {
        $this->assertTrue(is_dir($this->cacheDir.DIRECTORY_SEPARATOR.'twig'));
        $this->assertTrue(file_exists($this->cacheDir.DIRECTORY_SEPARATOR.'templates.php'));
        $this->cache_manager->clearTemplates();
        $this->assertFalse(is_dir($this->cacheDir.DIRECTORY_SEPARATOR.'twig'));
        $this->assertFalse(file_exists($this->cacheDir.DIRECTORY_SEPARATOR.'templates.php'));
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