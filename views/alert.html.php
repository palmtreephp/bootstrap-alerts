<?php /** @var Palmtree\BootstrapAlerts\Alert $alert */ ?>
<div class="<?= $alert->getClassAttr(); ?>" role="alert">
    <?php if ($alert->getIcon()): ?>
        <span class="fa fa-<?= $alert->getIcon(); ?>"></span>
    <?php endif; ?>
    <?= $alert->getData(); ?>
    <?php if ($alert->isDismissible()): ?>
        <button type="button" class="btn-close" data-dismiss="alert" data-bs-dismiss="alert" aria-label="Close">
        </button>
    <?php endif; ?>
</div>
