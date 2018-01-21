<?php

namespace App\Network\Session;

use Cake\Cache\Cache;
use Cake\Core\Configure;
use Cake\Network\Session\DatabaseSession;

class ComboSession extends DatabaseSession
{
    public $cacheKey;

    /**
     * ComboSession constructor.
     */
    public function __construct()
    {
        $this->cacheKey = Configure::read('Session.handler.cache');
        parent::__construct();
    }

    /**
     * Read data from the session.
     *
     * @param string $id The Session ID.
     *
     * @return mixed|string
     */
    public function read($id)
    {
        $result = Cache::read($id, $this->cacheKey);
        if ($result) {
            return $result;
        }

        return parent::read($id);
    }

    /**
     * Write data into the session.
     *
     * @param int   $id Session ID
     * @param mixed $data Data to be written into the session.
     *
     * @return bool
     */
    public function write($id, $data)
    {
        Cache::write($id, $data, $this->cacheKey);

        return parent::write($id, $data);
    }

    /**
     * Destroy a session.
     *
     * @param int $id The Session Id being Modified.
     *
     * @return bool
     */
    public function destroy($id)
    {
        Cache::delete($id, $this->cacheKey);

        return parent::destroy($id);
    }

    /**
     * Removes expired sessions.
     *
     * @param null $expires Time for session expiration
     *
     * @return bool
     */
    public function gc($expires = null)
    {
        return Cache::gc($this->cacheKey) && parent::gc($expires);
    }
}
