<?php
namespace Yamiko\CacheAdministrationBundle;

use Yamiko\CacheAdministrationBundle\CacheManager;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Finder\Finder;
use Symfony\Component\Filesystem\Exception\FileNotFoundException;
use \PHPUnit_Framework_TestCase;

/**
 * Class CacheManager
 * @package Yamiko\CacheAdministrationBundle
 */
class CacheManagerTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @var CacheManager
     */
    protected $cache_manager;
    private $app_root = 'app';
    private $enviroment = 'test';
    private $dirs = array(
        'annotations',
        'assetic',
        'doctrine',
        'translations',
        'profiler',
        'twig',
    );
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

    public function setUp()
    {
        if(!is_dir($this->app_root)) {
            mkdir($this->app_root);
        }
        if(!is_dir($this->app_root.DIRECTORY_SEPARATOR.$this->enviroment)) {
            mkdir($this->app_root.DIRECTORY_SEPARATOR.$this->enviroment);
        }

        foreach($this->dirs as $dir){
            if(!is_dir($this->app_root.DIRECTORY_SEPARATOR.$this->enviroment.DIRECTORY_SEPARATOR.$dir)) {
                mkdir($this->app_root.DIRECTORY_SEPARATOR.$this->enviroment.DIRECTORY_SEPARATOR.$dir);
            }
        }
        foreach($this->files as $file){
            if(!file_exists($this->app_root.DIRECTORY_SEPARATOR.$this->enviroment.DIRECTORY_SEPARATOR.$file)) {
                touch($this->app_root.DIRECTORY_SEPARATOR.$this->enviroment.DIRECTORY_SEPARATOR.$file);
            }
        }

        $this->cache_manager = new CacheManager($this->app_root, $this->enviroment);
    }

    public function tearDown()
    {
        foreach($this->dirs as $dir){
            if(is_dir($this->app_root.DIRECTORY_SEPARATOR.$this->enviroment.DIRECTORY_SEPARATOR.$dir)) {
                rmdir($this->app_root.DIRECTORY_SEPARATOR.$this->enviroment.DIRECTORY_SEPARATOR.$dir);
            }
        }
        foreach($this->files as $file){
            if(file_exists($this->app_root.DIRECTORY_SEPARATOR.$this->enviroment.DIRECTORY_SEPARATOR.$file)) {
                unlink($this->app_root.DIRECTORY_SEPARATOR.$this->enviroment.DIRECTORY_SEPARATOR.$file);
            }
        }

        if(is_dir($this->app_root.DIRECTORY_SEPARATOR.$this->enviroment)) {
            rmdir($this->app_root.DIRECTORY_SEPARATOR.$this->enviroment);
        }
        if(is_dir($this->app_root)) {
            rmdir($this->app_root);
        }
    }

    public function testClearAnnotations()
    {
        $this->assertTrue(is_dir($this->app_root . DIRECTORY_SEPARATOR . $this->enviroment . DIRECTORY_SEPARATOR . 'annotations'));
        $this->cache_manager->clearAnnotations();
        $this->assertFalse(is_dir($this->app_root . DIRECTORY_SEPARATOR . $this->enviroment . DIRECTORY_SEPARATOR . 'annotations'));
    }

    public function testClearAssetic()
    {
        $this->assertTrue(is_dir($this->app_root . DIRECTORY_SEPARATOR . $this->enviroment . DIRECTORY_SEPARATOR . 'assetic'));
        $this->cache_manager->clearAssetic();
        $this->assertFalse(is_dir($this->app_root . DIRECTORY_SEPARATOR . $this->enviroment . DIRECTORY_SEPARATOR . 'assetic'));
    }

    public function testClearDoctrine()
    {
        $this->assertTrue(is_dir($this->app_root . DIRECTORY_SEPARATOR . $this->enviroment . DIRECTORY_SEPARATOR . 'doctrine'));
        $this->cache_manager->clearDoctrine();
        $this->assertFalse(is_dir($this->app_root . DIRECTORY_SEPARATOR . $this->enviroment . DIRECTORY_SEPARATOR . 'doctrine'));
    }

    public function testClearTranslations()
    {
        $this->assertTrue(is_dir($this->app_root . DIRECTORY_SEPARATOR . $this->enviroment . DIRECTORY_SEPARATOR . 'translations'));
        $this->cache_manager->clearTranslations();
        $this->assertFalse(is_dir($this->app_root . DIRECTORY_SEPARATOR . $this->enviroment . DIRECTORY_SEPARATOR . 'translations'));
    }

    public function testClearProfiles()
    {
        $this->assertTrue(is_dir($this->app_root . DIRECTORY_SEPARATOR . $this->enviroment . DIRECTORY_SEPARATOR . 'profiler'));
        $this->cache_manager->clearProfiles();
        $this->assertFalse(is_dir($this->app_root . DIRECTORY_SEPARATOR . $this->enviroment . DIRECTORY_SEPARATOR . 'profiler'));
    }

    public function testClearContainer()
    {

    }

    public function testClearRouting()
    {

    }

    public function testClearClasses()
    {

    }

    public function testClearTemplates()
    {

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