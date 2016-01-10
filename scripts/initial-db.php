<?php
/**
 * Start the initial database
 *
 * @author Aaron Saray
 */

chdir(__DIR__ . '/../src');
passthru('../vendor/bin/doctrine orm:schema-tool:create');
