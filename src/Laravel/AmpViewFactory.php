<?php

namespace Just\Amp\Laravel;

use Illuminate\Contracts\Events\Dispatcher;
use Illuminate\Contracts\View\Factory as FactoryContract;
use Illuminate\View\Engines\EngineResolver;
use Illuminate\View\Factory;
use Illuminate\View\ViewFinderInterface;

class AmpViewFactory extends Factory implements FactoryContract
{
    /**
     * @var string
     */
    protected $ampAffix;

    /**
     * AmpViewFactory constructor.
     *
     * @param \Illuminate\View\Engines\EngineResolver $engines
     * @param \Illuminate\View\ViewFinderInterface    $finder
     * @param \Illuminate\Contracts\Events\Dispatcher $events
     * @param string                                  $ampAffix
     */
    public function __construct(EngineResolver $engines, ViewFinderInterface $finder, Dispatcher $events, $ampAffix)
    {
        $this->ampAffix = $ampAffix;

        parent::__construct($engines, $finder, $events);
    }

    /**
     * @param string $view
     * @param array  $data
     * @param array  $mergeData
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function make($view, $data = [], $mergeData = [])
    {
        $routeName = $this->getContainer()->make('router')->currentRouteName();

        if (preg_match('/\.amp$/', $routeName)) {
            $view .= $this->ampAffix;
        }

        return parent::make($view, $data, $mergeData);
    }
}
