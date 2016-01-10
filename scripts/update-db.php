<?php
/**
 * Update the database
 *
 * @author Aaron Saray
 */

chdir(__DIR__ . '/../src');
passthru('../vendor/bin/doctrine orm:schema-tool:update --force');
