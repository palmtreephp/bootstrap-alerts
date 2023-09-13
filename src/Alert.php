<?php

declare(strict_types=1);

namespace Palmtree\BootstrapAlerts;

class Alert
{
    private string $data;
    private string $type;
    private string $icon;
    private bool $dismissible;
    private string $templateFile;

    public function __construct(string $data, string $type = 'success', string $icon = null, bool $dismissible = false, string $templateFile = null)
    {
        $this
            ->setData($data)
            ->setType($type)
            ->setIcon($icon)
            ->setDismissible($dismissible);

        if (null === $templateFile) {
            $templateFile = realpath(__DIR__ . '/../views/alert.html.php');
        }

        $this->setTemplateFile($templateFile);
    }

    public function getData(): string
    {
        return $this->data;
    }

    public function setData(string $data): self
    {
        $this->data = $data;

        return $this;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getIcon(): string
    {
        return $this->icon;
    }

    public function setIcon(string $icon): self
    {
        $this->icon = $icon;

        return $this;
    }

    public function isDismissible(): bool
    {
        return $this->dismissible;
    }

    public function setDismissible(bool $dismissible): self
    {
        $this->dismissible = $dismissible;

        return $this;
    }

    public function getClassAttr(): string
    {
        $classes = [
            'alert',
            "alert-$this->type",
        ];

        if ($this->isDismissible()) {
            array_push($classes, 'alert-dismissible', 'fade', 'show');
        }

        return implode(' ', $classes);
    }

    public function getTemplateFile(): string
    {
        return $this->templateFile;
    }

    public function setTemplateFile(string $templateFile): self
    {
        $this->templateFile = $templateFile;

        return $this;
    }

    public function __toString(): string
    {
        ob_start();

        $alert = $this;

        include $this->getTemplateFile();

        return ob_get_clean();
    }
}
