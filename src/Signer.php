<?php

namespace DBD\SignedRequest;

class Signer
{
    /**
     * Key.
     * @var string
     */
    protected $key;

    /**
     * Class constructor.
     * @param string $key
     * @return void
     */
    public function __construct(string $key)
    {
        $this->key = $key;
    }

    /**
     * Static constructor.
     * @param string $key
     * @return \DBD\SignedRequest\Signer
     */
    public static function init(string $key) : self
    {
        return new static($key);
    }

    /**
     * Sign a request.
     * @param array $parameters
     * @return array
     */
    public function sign(array $parameters = []) : array
    {
        $hashedData = json_encode($parameters);
        $hash = md5($hashedData.$this->key);
        $parameters['hashed_data'] = $hashedData;
        $parameters['hash'] = $hash;

        return $parameters;
    }

    /**
     * Validate a request.
     * @param array $parameters
     * @return bool
     */
    public function validate(array $parameters) : bool
    {
        if (! isset($parameters['hashed_data'])) {
            return false;
        }
        if (! isset($parameters['hash'])) {
            return false;
        }

        return $parameters['hash'] == md5($parameters['hashed_data'].$this->key);
    }
}
