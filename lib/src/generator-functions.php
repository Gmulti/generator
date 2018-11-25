<?php


/**
 * @param string $service
 * @return object
 */
function generator_get_service($service)
{
    return BootstrapContext::get_context()->get_service($service);
}
