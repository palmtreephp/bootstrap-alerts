<?php

namespace Palmtree\BootstrapAlerts;

class AlertManager implements \IteratorAggregate
{
    /** @var Alert[] */
    protected $alerts = [];
    /** @var array Map of error_type => font awesome icon */
    protected $iconMap = [
        'success' => 'check-circle',
        'danger'  => 'exclamation-circle',
        'info'    => 'question-circle',
        'warning' => 'exclamation-triangle',
    ];

    /**
     * @param string $html
     * @param string $type
     * @param bool   $dismissible
     *
     * @return AlertManager
     */
    public function addAlert($html, $type = 'success', $dismissible = false)
    {
        $this->alerts[] = new Alert($html, $type, $this->getMappedIcon($type), $dismissible);

        return $this;
    }

    /**
     * @param string $html
     * @param bool   $dismissible
     *
     * @return AlertManager
     */
    public function addSuccess($html, $dismissible = true)
    {
        return $this->addAlert($html, 'success', $dismissible);
    }

    /**
     * @param string $html
     * @param bool   $dismissible
     *
     * @return AlertManager
     */
    public function addError($html, $dismissible = false)
    {
        return $this->addAlert($html, 'danger', $dismissible);
    }

    /**
     * @param string $html
     * @param bool   $dismissible
     *
     * @return AlertManager
     */
    public function addInfo($html, $dismissible = true)
    {
        return $this->addAlert($html, 'info', $dismissible);
    }

    /**
     * @param string $html
     * @param bool   $dismissible
     *
     * @return AlertManager
     */
    public function addWarning($html, $dismissible = true)
    {
        return $this->addAlert($html, 'warning', $dismissible);
    }

    /**
     * @param string $type Filter by alert type
     *
     * @return Alert[]
     */
    public function getAlerts($type = null)
    {
        if (!is_null($type)) {
            return array_filter($this->alerts, function (Alert $alert) use ($type) {
                return $alert->getType() === $type;
            });
        }

        return $this->alerts;
    }

    /**
     * @param array $iconMap
     *
     * @return AlertManager
     */
    public function setIconMap(array $iconMap)
    {
        $this->iconMap = $iconMap;

        return $this;
    }

    /**
     * @return array
     */
    public function getIconMap()
    {
        return $this->iconMap;
    }

    /**
     * @param string $type
     * @param string $icon
     */
    public function addIconMapEntry($type, $icon)
    {
        $this->iconMap[$type] = $icon;
    }

    /**
     * @param string $type
     * @param string $default
     *
     * @return mixed|null
     */
    public function getMappedIcon($type, $default = '')
    {
        return isset($this->iconMap[$type]) ? $this->iconMap[$type] : $default;
    }

    /**
     * @inheritDoc
     */
    public function getIterator()
    {
        return new \ArrayIterator($this->getAlerts());
    }

    public function __toString()
    {
        $result = '';

        foreach ($this->getAlerts() as $alert) {
            $result .= $alert->__toString();
        }

        return $result;
    }
}
