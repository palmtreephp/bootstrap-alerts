<?php

declare(strict_types=1);

namespace Palmtree\BootstrapAlerts;

class AlertManager implements \IteratorAggregate
{
    /** @var list<Alert> */
    private array $alerts = [];

    /** @var array<string, string> Map of error_type => font awesome icon */
    private array $iconMap = [
        'success' => 'check-circle',
        'danger' => 'exclamation-circle',
        'info' => 'question-circle',
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
     * @return list<Alert>
     */
    public function getAlerts(string $type = null): array
    {
        if (null !== $type) {
            return array_values(array_filter($this->alerts, fn (Alert $alert) => $alert->getType() === $type));
        }

        return $this->alerts;
    }

    public function hasAlerts(string $type = null): bool
    {
        return \count($this->getAlerts($type)) > 0;
    }

    public function clearAlerts(string $type = null): void
    {
        if ($type) {
            $this->alerts = array_values(array_filter($this->alerts, fn (Alert $alert) => $alert->getType() === $type));
        } else {
            $this->alerts = [];
        }
    }

    public function clearAlert(Alert $alertToClear): void
    {
        $this->alerts = array_filter($this->alerts, fn (Alert $alert) => $alert !== $alertToClear);
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

    public function addIconMapEntry(string $type, string $icon): void
    {
        $this->iconMap[$type] = $icon;
    }

    public function getMappedIcon(string $type, string $default = ''): ?string
    {
        return $this->iconMap[$type] ?? $default;
    }

    public function getIterator(): \ArrayIterator
    {
        return new \ArrayIterator($this->getAlerts());
    }

    public function __toString()
    {
        $result = [];

        foreach ($this->getAlerts() as $alert) {
            $result[] = $alert->__toString();
        }

        return implode("\n", $result);
    }

    public function __serialize(): array
    {
        return $this->alerts;
    }

    public function __unserialize(array $data): void
    {
        $this->alerts = $data;
    }
}
