
        <div class="row-fluid">
            <div class="span12">

                <?php if ($numResults > 0): ?>

                    <?php foreach ($prices as $row): ?>

                        <div class="backdrop">

                            <article>

                                <h2 class="name"><?= $row->name ?></h2>

                                <div class="row-fluid">

                                    <div class="span6">

                                        <div class="prices clearfix">

                                            <div class="live">
                                                <span class="price"><?= $row->live_price = $row->live_price ? '$' . $row->live_price : '<i class="icon-remove icon-white"></i>' ?></span>
                                                <span class="type"><i class="icon-tag icon-white"></i> Live</span>
                                            </div>

                                            <div class="boiled">
                                                <span class="price"><?= $row->boiled_price = $row->boiled_price ? '$' . $row->boiled_price : '<i class="icon-remove icon-white"></i>' ?></span>
                                                <span class="type"><i class="icon-tag icon-white"></i> Boiled</span>
                                            </div>

                                            <div class="dine-in">
                                                <span class="price"><?= $row->dine_in_price = $row->dine_in_price ? '$' . $row->dine_in_price : '<i class="icon-remove icon-white"></i>' ?></span>
                                                <span class="type"><i class="icon-tag icon-white"></i> Dine-In</span>
                                            </div>
                                            
                                        </div>

                                    </div>

                                    <div class="span6">

                                        <div class="contact">
                                            <span class="phone"><i class="icon-signal"></i> <?= $row->phone ?></span>
                                        </div>

                                        <address>
                                            <span class="address">
                                                <i class="icon-road"></i>
                                                <span><?= $row->address ?></span>,
                                                <span><?= $row->city ?></span>,
                                                <span><?= $row->state ?></span>
                                                <span><?= $row->zip ?></span>
                                            </span>
                                        </address>

                                        <?php if ($row->hours): ?>
                                            <span class="hours"><i class="icon-time"></i> <?= $row->hours ?></span>
                                        <?php endif; ?>

                                        <div class="links">

                                            <span class="map-link">
                                                <a class="btn btn-large" href="http://maps.google.com/?q=<?= $row->address . ', ' . $row->city . ', ' . $row->state . $row->zip ?>" target="_blank"><i class="icon-map-marker"></i> Map</a>
                                            </span>

                                            <?php if ($row->website): ?>
                                                <span class="website padding-left">
                                                    <a class="btn btn-large" href="<?= $row->website ?>" target="_blank"><i class="icon-globe"></i> Website</a>
                                                </span>
                                            <?php endif; ?>
                                            
                                        </div>

                                        <div class="timestamp">
                                            <small><em class="muted">Last Update:</em></small>
                                            <br>
                                            <span class="date"><i class="icon-calendar"></i> <?= date($dateFormat, strtotime($row->timestamp)) ?></span>
                                            <span class="time padding-left"><i class="icon-time"></i> <?= date($timeFormat, strtotime($row->timestamp)) ?></span>
                                        </div>

                                    </div>

                                </div>

                            </article>

                        </div>

                    <?php endforeach; ?>

                <?php else: ?>

                    <section>

                        <div class="error">
                            <h2>No results were found =(</h2>
                        </div>

                    </section>

                <?php endif; ?>

            </div>
        </div>
