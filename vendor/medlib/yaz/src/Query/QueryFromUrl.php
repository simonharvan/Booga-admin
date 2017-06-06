<?php
/**
 * Created by PhpStorm.
 * User: simonharvan
 * Date: 1.6.17
 * Time: 12:45
 */

namespace Medlib\Yaz\Query;


use Medlib\Yaz\Connexion\YazConnexionUrl;
use Medlib\Yaz\Factory\YazFactory;

class QueryFromUrl extends YazFactory
{
    protected $_conn;
    protected $_parts;

    /**
     * QueryFrom constructor.
     * @param string $from
     * @param array $parts
     */
    public function __construct($url, $port, $database, $options = [], $parts) {

        $this->_parts = $parts;

        $this->manager = new YazConnexionUrl($url, $port, $database, $options);

        $this->_conn = $this->manager->connect();

        $indexes = $this->config('indexes');

        $this->_parts['options'] = $indexes['indexes'];
        parent::__construct($this->_conn, "fromUrl", $this->_parts);
    }
}