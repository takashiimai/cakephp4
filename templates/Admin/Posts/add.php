<?php
        $validate = $this->Flash->render('validate', [
            'element' => 'flash/text'
        ]);
        $validate = json_decode($validate, true);
        $this->set(compact('validate'));
?>
<main>
    <section>
        <h1 class="h3">新規登録</h1>

<?php if ($error = $this->Flash->render('error')): ?>
        <div class="alert alert-danger">
            <?= $error ?>
        </div>
<?php endif ?>

            <form method="post" action="<?= $this->Url->build(['_name' => 'admin.post.create']) ?>" enctype="multipart/form-data">

<?= $this->element('admin/posts/form'); ?>

            </form>
    </section>
</main>
