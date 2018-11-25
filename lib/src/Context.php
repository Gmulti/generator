<?php

namespace Generator;

class Context
{
    /**
     * List class services
     * @var array
     */
    protected $services = [];


    /**
     * Set services
     * @param array $services
     * @return Context
     */
    public function set_services($services)
    {
        foreach ($services as $service) {
            $this->set_service($service);
        }
        return $this;
    }

    /**
     * Set a service
     * @param string $service
     * @return Context
     */
    public function set_service($service)
    {
        $name = explode('\\', $service);
        end($name);
        $key                             = key($name);
        $this->services[ $name[ $key ] ] = $service;
        return $this;
    }


    /**
     * Get services
     * @return array
     */
    public function get_services()
    {
        return $this->services;
    }

    /**
     * Get one service by classname
     * @param string $name
     * @return object
     */
    public function get_service($name)
    {
        if (! array_key_exists($name, $this->services)) {
            return null;
            // @TODO : Throw exception
        }

        if (is_string($this->services[ $name ])) {
            $this->services[ $name ] = new $this->services[ $name ]();
        }

        return $this->services[ $name ];
    }

}
