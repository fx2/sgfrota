<?php

namespace App\Custom\Routing;

use Illuminate\Routing\ResourceRegistrar as OriginalRegistrar;

class ResourceRegistrar extends OriginalRegistrar
{
    // add data to the array
    /**
     * The default actions for a resourceful controller.
     *
     * @var array
     */
    protected $resourceDefaults = ['index', 'create', 'store', 'show', 'edit', 'update', 'destroy', 'customIndex', 'customCreate',  'customShow', 'customStore'];


    /**
     * Add the create method for a resourceful route.
     *
     * @param  string  $name
     * @param  string  $base
     * @param  string  $controller
     * @param  array  $options
     * @return \Illuminate\Routing\Route
     */
    protected function addResourceCustomIndex($name, $base, $controller, $options)
    {
        $uri = $this->getResourceUri($name). '/custom' . '/index';

        $action = $this->getResourceAction($name, $controller, 'customIndex', $options);

        return $this->router->get($uri, $action);
    }

    /**
     * Add the create method for a resourceful route.
     *
     * @param  string  $name
     * @param  string  $base
     * @param  string  $controller
     * @param  array  $options
     * @return \Illuminate\Routing\Route
     */
    protected function addResourceCustomCreate($name, $base, $controller, $options)
    {
        $uri = $this->getResourceUri($name). '/custom' . '/create';

        $action = $this->getResourceAction($name, $controller, 'customCreate', $options);

        return $this->router->get($uri, $action);
    }


    /**
     * Add the show method for a resourceful route.
     *
     * @param  string  $name
     * @param  string  $base
     * @param  string  $controller
     * @param  array  $options
     * @return \Illuminate\Routing\Route
     */
    protected function addResourceCustomShow($name, $base, $controller, $options)
    {
        $name = $this->getShallowName($name, $options);

        $uri = $this->getResourceUri($name). '/custom' . '/show/' . '{'.$base.'}';

        $action = $this->getResourceAction($name, $controller, 'customShow', $options);

        return $this->router->get($uri, $action);
    }

    /**
     * Add the store method for a resourceful route.
     *
     * @param  string  $name
     * @param  string  $base
     * @param  string  $controller
     * @param  array  $options
     * @return \Illuminate\Routing\Route
     */
    protected function addResourceCustomStore($name, $base, $controller, $options)
    {
        $uri = $this->getResourceUri($name) . '/custom/' . 'store';

        $action = $this->getResourceAction($name, $controller, 'customStore', $options);

        return $this->router->post($uri, $action);
    }
}