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
    protected $resourceDefaults = ['index', 'create', 'store', 'show', 'edit', 'update', 'destroy', 'customIndex', 'customListagem',  'customShow', 'customShowPdf', 'customCreate', 'customStore', 'customEdit', 'customUpdate', 'customDestroy'];

    /**
     * Add the create method for a resourceful route.
     *
     * @param  string  $name
     * @param  string  $base
     * @param  string  $controller
     * @param  array  $options
     * @return \Illuminate\Routing\Route
     */
    protected function addResourceCustomListagem($name, $base, $controller, $options)
    {
        $uri = $this->getResourceUri($name). '/custom' . '/listagem';

        $action = $this->getResourceAction($name, $controller, 'customListagem', $options);

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
     * Add the show method for a resourceful route.
     *
     * @param  string  $name
     * @param  string  $base
     * @param  string  $controller
     * @param  array  $options
     * @return \Illuminate\Routing\Route
     */
    protected function addResourceCustomShowPdf($name, $base, $controller, $options)
    {
        $name = $this->getShallowName($name, $options);

        $uri = $this->getResourceUri($name). '/custom' . '/show' . '/pdf/' . '{'.$base.'}';

        $action = $this->getResourceAction($name, $controller, 'customShowPdf', $options);

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

    /**
     * Add the edit method for a resourceful route.
     *
     * @param  string  $name
     * @param  string  $base
     * @param  string  $controller
     * @param  array  $options
     * @return \Illuminate\Routing\Route
     */
    protected function addResourceCustomEdit($name, $base, $controller, $options)
    {
        $name = $this->getShallowName($name, $options);

        $uri = $this->getResourceUri($name) . '/custom/' . '{'.$base.'}/' . static::$verbs['edit'];

        $action = $this->getResourceAction($name, $controller, 'customEdit', $options);

        return $this->router->get($uri, $action);
    }

    /**
     * Add the update method for a resourceful route.
     *
     * @param  string  $name
     * @param  string  $base
     * @param  string  $controller
     * @param  array  $options
     * @return \Illuminate\Routing\Route
     */
    protected function addResourceCustomUpdate($name, $base, $controller, $options)
    {
        $name = $this->getShallowName($name, $options);

        $uri = $this->getResourceUri($name) .'/custom' . '/{'.$base.'}';

        $action = $this->getResourceAction($name, $controller, 'customUpdate', $options);

        return $this->router->match(['PUT', 'PATCH'], $uri, $action);
    }

    /**
     * Add the destroy method for a resourceful route.
     *
     * @param  string  $name
     * @param  string  $base
     * @param  string  $controller
     * @param  array  $options
     * @return \Illuminate\Routing\Route
     */
    protected function addResourceCustomDestroy($name, $base, $controller, $options)
    {
        $name = $this->getShallowName($name, $options);

        $uri = $this->getResourceUri($name) . '/custom' . '/{'.$base.'}';

        $action = $this->getResourceAction($name, $controller, 'customDestroy', $options);

        return $this->router->delete($uri, $action);
    }
}
