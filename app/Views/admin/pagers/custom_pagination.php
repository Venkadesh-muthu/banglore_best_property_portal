<?php if ($pager->hasPreviousPage()): ?>
    <li class="datatable-pagination-list-item">
        <a href="<?= $pager->getPreviousPage() ?>" class="datatable-pagination-list-item-link" aria-label="Previous">‹</a>
    </li>
<?php endif ?>

<?php foreach ($pager->links() as $link): ?>
    <li class="datatable-pagination-list-item <?= $link['active'] ? 'datatable-active' : '' ?>">
        <a href="<?= $link['uri'] ?>" class="datatable-pagination-list-item-link"><?= $link['title'] ?></a>
    </li>
<?php endforeach; ?>

<?php if ($pager->hasNextPage()): ?>
    <li class="datatable-pagination-list-item">
        <a href="<?= $pager->getNextPage() ?>" class="datatable-pagination-list-item-link" aria-label="Next">›</a>
    </li>
<?php endif ?>