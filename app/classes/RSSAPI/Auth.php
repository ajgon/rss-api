<?php
/**
 * Auth class file.
 *
 * PHP version 5.3
 *
 * @category Core
 * @package  RSS-API
 * @author   Igor Rzegocki <igor@rzegocki.pl>
 * @license  http://opensource.org/licenses/BSD-3-Clause The BSD 3-Clause License
 * @link     https://github.com/ajgon/rss-api
 */
namespace RSSAPI;

/**
 * Class used to handle RSS-API authentication.
 *
 * @category Core
 * @package  RSS-API
 * @author   Igor Rzegocki <igor@rzegocki.pl>
 * @license  http://opensource.org/licenses/BSD-3-Clause The BSD 3-Clause License
 * @link     https://github.com/ajgon/rss-api
 */
class Auth
{
    private $_api_key = '';

    /**
     * Auth constructor
     *
     * @param  string $api_key Api key - a md5 of email:password string.
     */
    public function __construct($api_key)
    {
        $this->_api_key = preg_replace('/[^0-9a-f]/', '', $api_key);
    }

    /**
     * Validates api_key against database of approved tokens.
     *
     * @return boolean Is api_key valid?
     */
    public function validate()
    {
        return \ORM::for_table('users')->where('api_key', $this->_api_key)->count() === 1;
    }
}
