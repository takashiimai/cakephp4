<?php
    $this->loadHelper('Paginator', ['templates' => 'admin/paginator-template']);
?>
<main>
    <section>
        <h1 class="h3">お知らせ一覧</h1>
        <div class="text-end mb-3">
            <a href="<?= $this->Url->build(['_name' => 'admin.post.add']) ?>" class="btn btn-primary btn-sm">新規作成</a>
        </div>

<?php if ($message = $this->Flash->render('message')): ?>
        <div class="alert alert-info">
            <?= $message ?>
        </div>
<?php endif ?>
<?php if ($error = $this->Flash->render('error')): ?>
        <div class="alert alert-danger">
            <?= $error ?>
        </div>
<?php endif ?>

<?php if (count($items)): ?>
        <section>
<?= $this->element('admin/posts/list'); ?>
        </section>
        <div class="text-center">
            <ul class="pagination justify-content-center">
                <?= $this->Paginator->first('<<') ?>
                <?= $this->Paginator->prev('<') ?>
                <?= $this->Paginator->numbers() ?>
                <?= $this->Paginator->next('>') ?>
                <?= $this->Paginator->last('>>') ?>
            </ul>
        </div>
<?php else: ?>
        <div class="alert alert-info">
            お知らせはありません。
        </div>
<?php endif ?>
    </section>
</main>

