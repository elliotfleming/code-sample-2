
        <div class="row-fluid">
            <div class="span12">

                <div class="backdrop">

                    <section class="breadcrumb">

                        <ul class="breadcrumb">
                            <li><a href="/"><i class="icon-home"></i> Home</a> <span class="divider">/</span></li>
                            <li><a href="/admin"><i class="icon-wrench"></i> Admin</a> <span class="divider">/</span></li>
                            <li><a href="/admin/boils"><i class="icon-fire"></i> Boils</a> <span class="divider">/</span></li>
                            <li class="active"><i class="icon-edit"></i> Edit Boil</li>
                        </ul>

                    </section>

                </div>

                <?php if ($status): ?>

                    <div class="backdrop">

                        <section>

                            <?php if (isset($insertError)): ?>

                                <div class="error">
                                    <h2>Boil update failed</h2>
                                    <p>Please try again later</p>
                                    <a href="/admin" class="btn btn-large"><i class="icon-wrench"></i> Admin</a>
                                    <a href="/admin/boils" class="btn btn-large btn-primary"><i class="icon-wrench icon-white"></i> Admin <i class="icon-chevron-right"></i> <i class="icon-fire icon-white"></i> Boils</a>
                                    <a href="/" class="btn btn-large"><i class="icon-home"></i> Home</a>
                                </div>

                            <?php else: ?>

                                <div class="success">
                                    <h2>Boil successfully updated!</h2>
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

                            <h2>Edit Boil</h2>

                            <?php if (validation_errors()): ?>

                                <div class="error">
                                    <?= validation_errors(); ?>
                                </div>

                            <?php endif; ?>

                            <?php echo form_open('admin/editBoil/' . $id); ?>

                                <fieldset>

                                    <legend>Required</legend>

                                    <label for="name">Whatcha call it?</label>
                                    <input type="text" class="input-block-level" id="name" name="name" placeholder="Name your event" value="<?= $boil[0]->name ?>" maxlength="80" required="required">

                                    <label for="date">When is it?</label>
                                    <input type="text" class="span3" id="date" name="date" placeholder="mm/dd/yyyy" value="<?= date($dateFormat, strtotime($boil[0]->datetime)) ?>" maxlength="20" required="required">

                                    <label for="time">When time does it start?</label>
                                    <input type="text" class="span2" id="time" name="time" placeholder="hh:mm am/pm" value="<?= date($timeFormat, strtotime($boil[0]->datetime)) ?>" maxlength="20" required="required">

                                    <label for="address">Address</label>
                                    <input type="text" class="input-block-level" id="address" name="address" placeholder="321 Who Dat Street" value="<?= $boil[0]->address ?>" maxlength="80" required="required">

                                    <label for="city">City</label>
                                    <input type="text" class="input-block-level" id="city" name="city" placeholder="New Orleans" value="<?= $boil[0]->city ?>" maxlength="50" required="required">

                                    <label for="state">State</label>
                                    <input type="text" class="span1" id="state" name="state" placeholder="LA" value="<?= $boil[0]->state ?>" maxlength="2" required="required">

                                    <label for="zip">Zip</label>
                                    <input type="text" class="span2" id="zip" name="zip" placeholder="70124" value="<?= $boil[0]->zip ?>" maxlength="5" required="required">

                                </fieldset>

                                <fieldset>

                                    <legend>Recommended</legend>

                                    <label for="description">Description</label>
                                    <textarea class="input-block-level" id="description" name="description" placeholder="We'll be around back. BYOB" rows="3" maxlength="500"><?= $boil[0]->description ?></textarea>

                                    <label for="website">Website</label>
                                    <input type="url" class="input-block-level" id="website" name="website" placeholder="www.facebook.com/awesome-crawfish-boil" value="<?= $boil[0]->website ?>" maxlength="2083">

                                    <label for="email">Email Address</label>
                                    <input type="email" class="input-block-level" id="email" name="email" placeholder="john@example.com" value="<?= $boil[0]->email ?>" maxlength="80">

                                    <label for="phone">Phone</label>
                                    <input type="tel" class="input-block-level" id="phone" name="phone" placeholder="504-555-5555" value="<?= $boil[0]->phone ?>" maxlength="20">

                                    <label for="price">Price</label>
                                    <div class="input-prepend input-append">
                                        <span class="add-on">$</span>
                                        <input type="number" id="price" name="price" placeholder="0" value="<?= $boil[0]->price ?>" maxlength="6">
                                        <span class="add-on">.00</span>
                                    </div>

                                    <label for="twitter">Twitter</label>
                                    <div class="input-prepend">
                                        <span class="add-on">@</span>
                                        <input type="text" id="twitter" name="twitter" placeholder="crawfinder" value="<?= $boil[0]->twitter ?>" maxlength="140">
                                    </div>

                                </fieldset>

                                <div class="form-actions">
                                    <input type="submit" class="btn btn-large btn-primary" value="Submit">
                                    <a href="/admin/boils" class="btn btn-large">Cancel</a>
                                </div>

                            </form>

                        </section>

                    </div>

                <?php endif; ?>

            </div>
        </div>
