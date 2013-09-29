
        <div class="row-fluid">
            <div class="span12">

                <?php if ($numBoils > 0): ?>

                    <?php foreach ($boils as $row): ?>

                        <div class="backdrop">

                            <article class="boil">

                                <h2 class="name"><?= $row->name ?></h2>

                                <div class="row-fluid">

                                    <div class="span6">

                                        <div class="primary-info">

                                            <span class="date"><i class="icon-calendar icon-white"></i> <?= date($dateFormat, strtotime($row->datetime)) ?></span>
                                            <span class="time"><i class="icon-time icon-white"></i> <?= date($timeFormat, strtotime($row->datetime)) ?></span>
                                            <?php if ($row->price): ?>
                                                <span class="boil-price"><i class="icon-tag icon-white"></i> $<?= $row->price ?></span>
                                            <?php endif; ?>

                                        </div>

                                        <div class="links">

                                            <span class="map-link">
                                                <a class="btn" href="http://maps.google.com/?q=<?= $row->address . ', ' . $row->city . ', ' . $row->state . ' ' . $row->zip ?>" target="_blank"><i class="icon-map-marker"></i> Map</a>
                                            </span>

                                            <?php if ($row->website): ?>
                                                <span class="website">
                                                    <a class="btn" href="<?= $row->website ?>" target="_blank"><i class="icon-globe"></i> Website</a>
                                                </span>
                                            <?php endif; ?>

                                            <?php if ($row->email): ?>
                                                <span class="email">
                                                    <a class="btn" href="mailto:<?= $row->email ?>" target="_blank"><i class="icon-envelope"></i> Email</a>
                                                </span>
                                            <?php endif; ?>

                                            <?php if ($row->twitter): ?>
                                                <span class="twitter">
                                                    <a class="btn" href="http://twitter.com/<?= $row->twitter ?>" target="_blank"><i class="icon-user"></i>  @<?= $row->twitter ?></a>
                                                </span>
                                            <?php endif; ?>

                                        </div>

                                    </div>

                                    <div class="span6">

                                        <address>
                                            <div class="location">
                                                <span><i class="icon-map-marker"></i> <span class="muted">Address</span></span>
                                                <span class="padding-left"><i class="icon-road"></i> <em id="distance_<?= $row->boils_id ?>" class="muted" title="Location information may not be accurate.">(geolocation off)</em></span>
                                                <script>
                                                    getLatLong('<?= $row->address . ', ' . $row->city . ', ' . $row->state . ' ' . $row->zip ?>', function(lat1,lng1) {
                                                        getLocation(function(lat2,lng2) {
                                                            var dist = distance(lat1,lng1,lat2,lng2);
                                                            var mileMiles = dist == 1 ? 'mile' : 'miles';
                                                            $('#distance_<?= $row->boils_id ?>').html(dist + ' ' + mileMiles + ' away');
                                                        });
                                                    });
                                                </script>
                                                <p>
                                                    <span><?= $row->address ?><span>
                                                    <br>
                                                    <span><?= $row->city ?></span>,
                                                    <span><?= $row->state ?></span>
                                                    <span><?= $row->zip ?></span>
                                                </p>
                                            </div>
                                        </address>

                                        <?php if ($row->phone): ?>
                                            <div class="phone">
                                                <span><i class="icon-signal"></i> <span class="muted">Phone</span></span>
                                                <p>
                                                    <?= $row->phone ?>
                                                </p>
                                            </div>
                                        <?php endif; ?>

                                        <?php if ($row->description): ?>
                                            <div id="description_<?= $row->boils_id ?>" class="description">
                                                <span><i class="icon-bullhorn"></i> <span class="muted">Notes</span></span>
                                                <p class="short-description">
                                                    <?= string_summary($row->description, 150, $row->boils_id) ?>
                                                </p>
                                                <p class="full-description">
                                                    <?= nl2br($row->description) ?>
                                                </p>
                                                <div class="show-less">
                                                    <a href="#" data="<?= $row->boils_id ?>">Show Less</a>
                                                </div>
                                            </div>
                                        <?php endif; ?>

                                    </div>

                                </div>

                            </article>

                        </div>

                    <?php endforeach; ?>

                <?php else: ?>

                    <div class="backdrop">

                        <section>

                            <div class="error">
                                <h2>No boils were found =(</h2>
                            </div>

                        </section>

                    </div>

                <?php endif; ?>

                <div class="backdrop">
                    <div class="promo">
                        <a href="/boils/addBoil" class="btn btn-large btn-block btn-primary">Don't Be Shy, Climb Out of Your Shell and Post Your Own Boil<br><i class="icon-plus-sign icon-white"></i> <img src="/img/crawfish.png" width="50" height="34"></a>
                    </div>
                </div>

            </div>
        </div>
