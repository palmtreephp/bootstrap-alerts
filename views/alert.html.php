<?php /** @var Palmtree\BootstrapAlerts\Alert $alert */ ?>
<div class="<?= $alert->getClassAttr(); ?>" role="alert">
    <?php if ($alert->getIcon()) { ?>
        <span class="fa fa-<?= $alert->getIcon(); ?>"></span>
    <?php } ?>
    <?= $alert->getData(); ?>
    <?php if ($alert->isDismissible()) { ?>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    <?php } ?>
</div>
