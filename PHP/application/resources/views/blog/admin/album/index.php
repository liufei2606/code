<?php include __DIR__.'/../header.php'; ?>

    <body id="page-top">

    <!-- Page Wrapper -->
<div id="wrapper">

<?php include __DIR__.'/../sidebar.php'; ?>

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

    <!-- Main Content -->
    <div id="content">

        <?php include __DIR__.'/../nav.php'; ?>

        <!-- Begin Page Content -->
        <div class="container-fluid">

            <!-- DataTales Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">专辑列表</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>封面图</th>
                                <th>名称</th>
                                <th>介绍</th>
                                <th>操作</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($albums as $album) : ?>
                                <tr>
                                    <td><?= $album->id ?></td>
                                    <td>
                                        <?php if ($album->image) : ?>
                                            <img src="<?= $album->image ?>" class="img-thumbnail" style="width: 15em;">
                                        <?php endif; ?>
                                    </td>
                                    <td><?= $album->title ?></td>
                                    <td><?= $album->summary ?></td>
                                    <td>
                                        <a href="/admin/album/edit?id=<?= $album->id ?>" role="button"
                                           class="btn btn-success">编辑</a>
                                        <a href="#" data-toggle="modal" data-target="#deleteModal" role="button"
                                           class="btn btn-danger btn-delete" data-id="<?= $album->id ?>">删除</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                    <?php
                    $pageType = 'albums';
                    include __DIR__.'/../pagination.php';
                    ?>
                </div>
            </div>

        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- End of Main Content -->

<?php
$itemType = 'album';
include __DIR__.'/../delete.php';
include __DIR__.'/../footer.php';
?>