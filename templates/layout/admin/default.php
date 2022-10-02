<!DOCTYPE html>
<html lang="ja">
<head>
<?= $this->element('admin/parts/head'); ?>
</head>
<body>
    <div class="container-fluid">
    <div class="row">
        <div class="col-12">
<?= $this->element('admin/parts/header'); ?>
<?= $this->fetch('content') ?>
<?= $this->element('admin/parts/footer'); ?>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.1.slim.min.js" integrity="sha256-w8CvhFs7iHNVUtnSP0YKEg00p9Ih13rlL9zGqvLdePA=" crossorigin="anonymous"></script>
</body>
</html>
