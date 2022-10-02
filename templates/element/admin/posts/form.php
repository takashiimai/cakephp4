 <input type="hidden" name="_csrfToken" autocomplete="off" value="<?= $this->request->getAttribute('csrfToken') ?>">
<input type="hidden" name="id" value="<?= $item->id ?>">

<div class="mb-3 row">
    <label for="title" class="col-2 col-form-label text-end">タイトル</label>
    <div class="col-10">
        <input type="text" class="form-control" id="title" name="title" value="<?= $item->title ?>">
<?php if (isset($validate['title'])): ?>
        <p class="text-danger my-2"><b><?= reset($validate['title']) ?></b></p>
<?php endif ?>
    </div>
</div>

<div class="mb-3 row">
    <label for="description" class="col-2 col-form-label text-end">内容</label>
    <div class="col-10">
        <textarea class="form-control" id="description" name="description"><?= $item->description ?></textarea>
<?php if (isset($validate['description'])): ?>
        <p class="text-danger my-2"><b><?= reset($validate['description']) ?></b></p>
<?php endif ?>
    </div>
</div>

<div class="mb-3 row">
    <label for="image" class="col-2 col-form-label text-end">画像</label>
    <div class="col-10">
<?php if ($item->image): ?>
        <img src="<?= $item->image_url ?>" class="img-thumbnail" width="200">
<?php endif ?>
        <input type="file" class="form-control" id="image" name="file">
<?php if (isset($validate['file'])): ?>
        <p class="text-danger my-2"><b><?= reset($validate['file']) ?></b></p>
<?php endif ?>
    </div>
</div>

<div class="mb-3 row">
    <label for="image" class="col-2 col-form-label text-end">公開状態</label>
    <div class="col-10">
<?php foreach ($postStatus as $_k => $_v): ?>
        <div class="custom-control custom-checkbox">
            <input type="radio" class="custom-control-input" id="formCheck<?= $_k ?>" name="status" value="<?= $_k ?>" <?= $_k == $item->status ? 'checked' : '' ?>>
            <label for="formCheck<?= $_k ?>" class="custom-control-label">
                <?= $_v ?>
            </label>
        </div>
<?php endforeach; ?>
<?php if (isset($validate['status'])): ?>
        <p class="text-danger my-2"><b><?= reset($validate['status']) ?></b></p>
<?php endif ?>
    </div>
</div>

<div class="text-end">
    <a href="<?= $this->Url->build(['_name' => 'admin.post.index']) ?>" class="btn btn-secondary">キャンセル</a>
    <button type="submit" class="btn btn-primary">送信</a>
</div>
