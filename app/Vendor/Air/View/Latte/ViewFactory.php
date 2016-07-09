<?php

namespace App\Vendor\Air\View\Latte;

use Air\View\View;
use Air\View\ViewInterface;
use Air\View\RendererInterface;

/**
 * Class ViewFactory
 * @package App\Vendor\Air\View\Latte
 * @author Petr Pliska <petr.pliska@post.cz>
 */
class ViewFactory extends \Air\View\ViewFactory
{
    /**
     * @var string
     */
    protected $fileExtension = 'latte';

    /**
     * @var RendererInterface
     */
    protected $renderer;

    /**
     * @var array
     */
    protected $defaultData = [];

    /**
     * ViewFactory constructor.
     * @param null $cacheDir
     * @param null $partialsDir
     * @param array $defaultData
     */
    public function __construct($cacheDir = null, $partialsDir = null, $defaultData = [])
    {
        $this->cacheDir = $cacheDir;
        $this->partialsDir = $partialsDir;
        $this->defaultData = $defaultData;

        $this->renderer = new Renderer($this->cacheDir, $this->partialsDir);
    }

    /**
     * @param string $fileName The name of the file to load.
     * @return ViewInterface A view.
     * @throws \Exception
     */
    public function get($fileName)
    {
        return new View($this->renderer, $this->find($fileName), $this->defaultData);
    }

    /**
     * @return string
     */
    public function getFileExtension()
    {
        return $this->fileExtension;
    }

    /**
     * @param string $fileExtension
     */
    public function setFileExtension($fileExtension)
    {
        $this->fileExtension = $fileExtension;
    }
}
