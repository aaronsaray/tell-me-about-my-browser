<?php
/**
 * The custom Dependency injection extension of Pimple
 *
 * @author Aaron Saray
 */

namespace AboutBrowser\Util;

/**
 * Class Di
 * @package AboutBrowser\Util
 */
class Di extends \Pimple\Container
{
    /**
     * @var \AboutBrowser\Util\Di
     */
    protected static $instance;

    /**
     * Get the instance of this
     * @return Di
     */
    public static function getInstance()
    {
        if (is_null(self::$instance)) {
            self::$instance = new self;
        }

        return self::$instance;
    }

    /**
     * Fill the container
     */
    public function __construct()
    {
        $this->offsetSet('entityManager', function($c) {
            $isDevMode = getenv('APPLICATION_ENV') == 'development';
            $config = \Doctrine\ORM\Tools\Setup::createAnnotationMetadataConfiguration(array(__DIR__ . '/../Model'), $isDevMode);

            $conn = array(
                'driver'    =>  'pdo_mysql',
                'dbname'    =>  'browser',
                'user'      =>  getenv('MYSQL_USER'),
                'password'  =>  getenv('MYSQL_PASS')
            );

            $entityManager = \Doctrine\ORM\EntityManager::create($conn, $config);
            return $entityManager;
        });

        $this->offsetSet('visitorService', function($c) {
            return new \AboutBrowser\Service\Visitor($c['entityManager']);
        });
    }
}