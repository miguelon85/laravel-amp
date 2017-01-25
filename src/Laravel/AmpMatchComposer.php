<?php

namespace Just\Amp\Laravel;

use Illuminate\Contracts\Routing\UrlGenerator;
use Illuminate\Routing\Router;
use Illuminate\Contracts\View\View;

class AmpMatchComposer
{
    /**
     * @var \Illuminate\Routing\Router
     */
    private $router;

    /**
     * @var \Illuminate\Contracts\Routing\UrlGenerator
     */
    private $urlGenerator;

    /**
     * @param \Illuminate\Routing\Router                 $router
     * @param \Illuminate\Contracts\Routing\UrlGenerator $urlGenerator
     */
    public function __construct(Router $router, UrlGenerator $urlGenerator)
    {
        $this->router = $router;
        $this->urlGenerator = $urlGenerator;
    }

    /**
     * @param \Illuminate\Contracts\View\View $view
     */
    public function compose(View $view)
    {
        $currentRoute = $this->router->getCurrentRoute();
        $routeName = $currentRoute->getName();

        $matches = preg_match('/\.amp$/', $routeName);

        if ($matches === 0) {
            $action = $currentRoute->getAction();

            if (isset($action['amp'])) {
                $uri = $this->urlGenerator->route($action['amp'], $currentRoute->parameters());

                $view->with('ampUrl', $uri);
            }
        }

        $view->with('hasAmpUrl', isset($uri));
    }
}
