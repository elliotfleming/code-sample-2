
        <div class="row-fluid">
            <div class="span12">

                <div class="backdrop">

                    <section class="breadcrumb">

                        <ul class="breadcrumb">
                            <li><a href="/"><i class="icon-home"></i> Home</a> <span class="divider">/</span></li>
                            <li><a href="/admin"><i class="icon-wrench"></i> Admin</a> <span class="divider">/</span></li>
                            <li><a href="/admin/boils"><i class="icon-fire"></i> Boils</a> <span class="divider">/</span></li>
                            <li class="active"><i class="icon-trash"></i> Delete Boil</li>
                        </ul>

                    </section>

                </div>

                <?php if ($status): ?>

                    <div class="backdrop">

                        <section>

                            <?php if (isset($insertError)): ?>

                                <div class="error">
                                    <h2>Boil deletion failed =(</h2>
                                </div>

                            <?php else: ?>

                                <div class="success">
                                    <h2>Boil successfully deleted.</h2>
                                    <a href="/admin" class="btn btn-large"><i class="icon-wrench"></i> Admin</a>
                                    <a href="/admin/boils" class="btn btn-large btn-primary"><i class="icon-wrench icon-white"></i> Admin <i class="icon-chevron-right"></i> <i class="icon-fire icon-white"></i> Boils</a>
                                    <a href="/" class="btn btn-large"><i class="icon-home"></i> Home</a>
                                </div>

                            <?php endif; ?>

                        </section>

                    </div>

                <?php else: ?>

                    <div class="backdrop">

                        <section>

                            <h2>Delete Boil</h2>

                            <div class="error">
                                <p>Are you sure you wish to delete this boil?</p>
                                <h2><?= $boil[0]->name ?></h2>
                                <a href="/admin/deleteBoil/<?= $id ?>/confirm" class="btn btn-large btn-danger"><i class="icon-trash icon-white"></i> YES</a>
                                <a href="/admin/boils" class="btn btn-large"><i class="icon-remove"></i> NO</a>
                            </div>

                        </section>

                    </div>

                <?php endif; ?>

            </div>
        </div>
