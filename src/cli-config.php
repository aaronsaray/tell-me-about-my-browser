<?php
/**
 * The Doctrine Config file
 *
 * @author Aaron Saray
 */

use \Doctrine\ORM\Tools\Console\ConsoleRunner;

require 'bootstrap.php';

return ConsoleRunner::createHelperSet(\AboutBrowser\Util\Di::getInstance()['entityManager']);