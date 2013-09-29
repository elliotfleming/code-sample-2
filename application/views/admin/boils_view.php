
        <div class="row-fluid">
            <div class="span12">

                <div class="backdrop">

                    <section class="breadcrumb">

                        <ul class="breadcrumb">
                            <li><a href="/"><i class="icon-home"></i> Home</a> <span class="divider">/</span></li>
                            <li><a href="/admin"><i class="icon-wrench"></i> Admin</a> <span class="divider">/</span></li>
                            <?php if ($filter != 'all' || $sorted): ?>
                                <li><a href="/admin/boils"><i class="icon-fire"></i> Boils</a> <span class="divider">/</span></li>
                                <?php if ($filter != 'all' &&  $sorted): ?>
                                    <li><a href="/admin/boils/<?= $filter ?>"><i class="icon-filter"></i> <?= ucfirst($filter) ?></a> <span class="divider">/</span></li>
                                    <li class="active"><i class="icon-random"></i> <?= ucfirst($sortType) ?></li>
                                <?php elseif ($filter != 'all' && !$sorted): ?>
                                    <li class="active"><i class="icon-filter"></i> <?= ucfirst($filter) ?></li>
                                <?php elseif ($filter == 'all' && $sorted): ?>
                                    <li class="active"><i class="icon-random"></i> Sorted</li>
                                <?php endif; ?>
                            <?php else: ?>
                                <li class="active"><i class="icon-fire"></i> Boils</li>
                            <?php endif; ?>
                        </ul>

                    </section>

                </div>

                <div class="backdrop">

                    <section class="admin">

                        <div class="filters btn-toolbar">
                            <div class="btn-group">

                                <a href="/admin/boils" class="btn <?php if ($filter == 'all') echo 'active'; ?>"><i class="icon-fire"></i> All</a>
                                <a href="/admin/boils/active" class="btn <?php if ($filter == 'active') echo 'active'; ?>"><i class="icon-ok"></i> Active</a>
                                <a href="/admin/boils/inactive" class="btn <?php if ($filter == 'inactive') echo 'active'; ?>"><i class="icon-ban-circle"></i> Inactive</a>

                            </div>
                        </div>

                        <?php if ($numBoils > 0): ?>

                            <table class="table table-striped">

                                <thead>
                                    <tr>
                                        <th><i class="icon-list"></i> <a href="/admin/boils/<?= $filter ?>/sort/name/<?= $sortNameValue ?>">Name</a> <?php if ($sortName): ?><i class="<?= $sortNameValue == 'asc'? 'icon-chevron-up' : 'icon-chevron-down' ?>"></i><?php endif; ?></th>
                                        <th><i class="icon-calendar"></i> <a href="/admin/boils/<?= $filter ?>/sort/datetime/<?= $sortDateValue ?>">Date</a> <?php if ($sortDate): ?><i class="<?= $sortDateValue == 'asc'? 'icon-chevron-up' : 'icon-chevron-down' ?>"></i><?php endif; ?></th>
                                        <th><i class="icon-edit"></i><span class="hidden-phone"> EDIT</span></th>
                                        <th><i class="icon-trash"></i><span class="hidden-phone"> DELETE</span></th>
                                    </tr>
                                </thead>

                                <tbody>

                                    <?php foreach ($boils as $row): ?>

                                        <tr>
                                            <td class="name"><?= $row->name ?></td>
                                            <td class="date"><?= date($dateFormat, strtotime($row->datetime)) ?></td>
                                            <td class="edit"><a href="/admin/editBoil/<?= $row->boils_id ?>" class="btn btn-small btn-info"><i class="icon-edit icon-white"></i><span class="hidden-phone"> EDIT</span></a></td>
                                            <td class="delete"><a href="/admin/deleteBoil/<?= $row->boils_id ?>" class="btn btn-small btn-danger"><i class="icon-trash icon-white"></i><span class="hidden-phone"> DELETE</span></a></td>
                                        </tr>

                                    <?php endforeach; ?>

                                </tbody>

                            </table>

                        <?php else: ?>

                            <div class="error">
                                <h2>No boils were found =(</h2>
                            </div>

                        <?php endif; ?>

                    </section>

                </div>

            </div>
        </div>
