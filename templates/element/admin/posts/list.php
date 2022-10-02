<table class="table">
    <thead>
        <tr>
            <th>#</th>
            <th scope="col">タイトル</th>
            <th scope="col">公開状態</th>
            <th scope="col">更新日時</th>
            <th scope="col">操作</th>
        </tr>
    </thead>
    <tbody>
<?php foreach ($items as $_row): ?>
        <tr>
            <th scope="row"><?= $_row->id ?></th>
            <td><?= $_row->title ?></td>
            <td><?= \App\Consts\PostStatus::valueOf($_row->status) ?></td>
            <td><?= $_row->updated_at_label ?></td>
            <td>
                <a href="<?= $this->Url->build(['_name' => 'admin.post.edit', 'id' => $_row->id]) ?>" class="btn btn-primary btn-sm">編集</a>
                <a href="" class="btn btn-primary btn-sm">削除</a>
            </td>
        </tr>
<?php endforeach ?>
    </tbody>
</table>