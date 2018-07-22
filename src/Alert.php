<?php

namespace Palmtree\BootstrapAlerts;

class Alert
{
    /** @var string */
    protected $data;
    /** @var string */
    protected $type;
    /** @var string */
    protected $icon;
    /** @var bool */
    protected $dismissible;
    /** @var string */
    protected $templateFile;

    /**
     * Alert constructor.
     *
     * @param string $data
     * @param string $type
     * @param null   $icon
     * @param bool   $dismissible
     * @param null   $templateFile
     */
    public function __construct($data, $type = 'success', $icon = null, $dismissible = false, $templateFile = null)
    {
        $this
            ->setData($data)
            ->setType($type)
            ->setIcon($icon)
            ->setDismissible($dismissible);

        if (is_null($templateFile)) {
            $templateFile = realpath(__DIR__ . '/../views/alert.html.php');
        }

        $this->setTemplateFile($templateFile);
    }

    /**
     * @return string
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * @param string $data
     *
     * @return Alert
     */
    public function setData($data)
    {
        $this->data = $data;

        return $this;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param string $type
     *
     * @return Alert
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @return string
     */
    public function getIcon()
    {
        return $this->icon;
    }

    /**
     * @param string $icon
     *
     * @return Alert
     */
    public function setIcon($icon)
    {
        $this->icon = $icon;

        return $this;
    }

    /**
     * @return bool
     */
    public function isDismissible()
    {
        return $this->dismissible;
    }

    /**
     * @param bool $dismissible
     *
     * @return Alert
     */
    public function setDismissible($dismissible)
    {
        $this->dismissible = $dismissible;

        return $this;
    }

    /**
     * @return string
     */
    public function getClassAttr()
    {
        $classes = [
            'alert',
            sprintf('alert-%s', $this->getType()),
        ];

        if ($this->isDismissible()) {
            array_push($classes, 'alert-dismissible', 'fade', 'show');
        }

        return implode(' ', $classes);
    }

    /**
     * @return string
     */
    public function getTemplateFile()
    {
        return $this->templateFile;
    }

    /**
     * @param string $templateFile
     *
     * @return Alert
     */
    public function setTemplateFile($templateFile)
    {
        $this->templateFile = $templateFile;

        return $this;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        ob_start();

        $alert = $this;

        include $this->getTemplateFile();

        return ob_get_clean();
    }
}
