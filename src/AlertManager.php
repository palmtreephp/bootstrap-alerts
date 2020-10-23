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

    public function addAlert(string $html, string $type = 'success', bool $dismissible = false): self
    {
        $this->alerts[] = new Alert($html, $type, $this->getMappedIcon($type), $dismissible);

        return $this;
    }

    public function addSuccess(string $html, bool $dismissible = true): self
    {
        return $this->addAlert($html, 'success', $dismissible);
    }

    public function addError(string $html, bool $dismissible = false): self
    {
        return $this->addAlert($html, 'danger', $dismissible);
    }

    public function addInfo(string $html, bool $dismissible = true): self
    {
        return $this->addAlert($html, 'info', $dismissible);
    }

    public function addWarning(string $html, bool $dismissible = true): self
    {
        return $this->addAlert($html, 'warning', $dismissible);
    }

    /**
     * @return Alert[]
     */
    public function getAlerts(?string $type = null): array
    {
        if (null !== $type) {
            return array_values(array_filter($this->alerts, function (Alert $alert) use ($type) {
                return $alert->getType() === $type;
            }));
        }

        return $this->alerts;
    }

    public function hasAlerts(?string $type = null): bool
    {
        return \count($this->getAlerts($type)) > 0;
    }

    public function clearAlerts(?string $type = null)
    {
        if ($type) {
            $this->alerts = array_values(array_filter($this->alerts, function (Alert $alert) use ($type) {
                return $alert->getType() === $type;
            }));
        } else {
            $this->alerts = [];
        }
    }

    public function clearAlert(Alert $alertToClear)
    {
        $this->alerts = array_filter($this->alerts, function (Alert $alert) use ($alertToClear) {
            return $alert !== $alertToClear;
        });
    }

    public function setIconMap(array $iconMap): self
    {
        $this->iconMap = $iconMap;

        return $this;
    }

    public function getIconMap(): array
    {
        return $this->iconMap;
    }

    public function addIconMapEntry(string $type, string $icon)
    {
        $this->iconMap[$type] = $icon;
    }

    public function getMappedIcon(string $type, string $default = ''): ?string
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
