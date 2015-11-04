<?php
namespace
use Zend\Loader\AutoloaderFactory;
use Zend\Mvc\Service\ServiceManagerConfig; use Zend\ServiceManager\ServiceManager; use Zend\Stdlib\ArrayUtils;
use RuntimeException;
error_reporting(E_ALL | E_STRICT); chdir(__DIR__);
class Bootstrap {
    protected static $serviceManager ; protected static $config; protected static $bootstrap;
    public static function init() {
// Load the user-defined test configuration file, if it exists; otherwise, load
        if (is_readable(__DIR__ . '/TestConfig.php')) { $testConfig = include __DIR__ . '/TestConfig.php';
        } else {
            $testConfig = include __DIR__ . '/TestConfig.php.dist';
        }
        $zf2ModulePaths = array ();
        if (isset($testConfig['module_listener_options']['module_paths'])) { $modulePaths
$testConfig['module_listener_options']['module_paths']; foreach ($modulePaths as $modulePath) {
                if (($path = static ::findParentPath($modulePath)) ) { $zf2ModulePaths[] = $path;
                    =
                } }
}
        $zf2ModulePaths   = PATH_SEPARATOR;
        static ::initAutoloader();
// use ModuleManager to load this module and it's dependencies
        $baseConfig = array ( 'module_listener_options' => array (
.
? :
implode(PATH_SEPARATOR, $zf2ModulePaths)
. = g e t e n v ( ' Z F 2 _ M O D U L E S _ T E S T _ P A T H S )' (defined('ZF2_MODULES_TEST_PATHS)' ? ZF2_MODULES_TEST_PATHS : '');
$ z f 2 M o d u l e P a t h s
'module_paths' => explode(PATH_SEPARATOR,
            $zf2ModulePaths), ),
);
$config = ArrayUtils::merge($baseConfig, $testConfig);
$serviceManager = new ServiceManager(new ServiceManagerConfig()); $serviceManager->setService('ApplicationConfig', $config); $serviceManager ->get('ModuleManager')->loadModules();
static ::$serviceManager = $serviceManager;
static ::$config = $config; }
    public static function getServiceManager () {
        return  static ::$serviceManager; }
    public static function getConfig() {
        return static ::$config; }
    protected static function in itAutolo ader()
{
$vendorPath = static ::findParentPath('vendor');
if (is_readable($vendorPath . '/autoload.php')) { $loader = include $vendorPath . '/autoload.php';
} else {
        $zf2Path = getenv('ZF2_PATH)' ?: (defined('ZF2_PATH)' ? ZF2_PATH
            : (is_dir($vendorPath . '/ZF2/library') ? $vendorPath . '/ZF2/library' : false ));
        if (!$zf2Path) {
            throw new RuntimeException('Unable to load ZF2. Run `php
composer.pharinstall` or define a ZF2_PATHenvironment variable.'); }
        include $zf2Path . '/Zend/Loader/AutoloaderFactory.php';
    }
AutoloaderFactory::factory(array ( 'Zend\Loader\StandardAutoloader' => array (
    'autoregister_zf' => true , 'namespaces' => array (
        __NAMESPACE__ => __DIR__ . '/' . __NAMESPACE__, ),
),
)); }
protected static function findParentPath($path) {
    $dir = __DIR__;
    $previousDir = '.';
    while (!is_dir($dir . '/' . $path)) {
        $dir = dirname($dir);
        if    ($previousDir  ===  $dir)  return  false ; $previousDir = $dir;
    }
    return $dir . '/' . $path; }
}
Bootstrap::init();