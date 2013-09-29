
        <div class="row-fluid">
            <div class="span12">

                <?php if ($status): ?>

                    <div class="backdrop">

                        <section>

                            <?php if (isset($insertError)): ?>

                                <div class="error">
                                    <h2>Your boil was not added =(</h2>
                                </div>

                            <?php else: ?>

                                <div class="success">
                                    <h2>Your boil was successfully added!</h2>
                                    <a href="/" class="btn btn-large btn-primary">Home</a>
                                    <a href="/boils/addBoil" class="btn btn-large">Add Another Boil</a>
                                </div>

                            <?php endif; ?>

                        </section>

                    </div>

                <?php else: ?>

                    <div class="backdrop">

                        <section>

                            <h2>Add a Boil</h2>

                            <?php if (validation_errors()): ?>

                                <div class="error">
                                    <?= validation_errors(); ?>
                                </div>

                            <?php endif; ?>

                            <?php echo form_open('boils/addBoil'); ?>

                                <fieldset>

                                    <legend>Required</legend>

                                    <label for="name">Whatcha call it?</label>
                                    <input type="text" class="input-block-level" id="name" name="name" placeholder="Name your event" value="<?= set_value('name'); ?>" maxlength="80" required="required">

                                    <label for="date">When is it?</label>
                                    <input type="date" class="span3" id="date" name="date" placeholder="mm/dd/yyyy" value="<?= set_value('date'); ?>" maxlength="20" required="required">

                                    <label for="time">When time does it start?</label>
                                    <input type="time" class="span2" id="time" name="time" placeholder="hh:mm am/pm" value="<?= set_value('time'); ?>" maxlength="20" required="required">

                                    <label for="address">Address</label>
                                    <input type="text" class="input-block-level" id="address" name="address" placeholder="321 Who Dat Street" value="<?= set_value('address'); ?>" maxlength="80" required="required">

                                    <label for="city">City</label>
                                    <input type="text" class="input-block-level" id="city" name="city" placeholder="New Orleans" value="<?= set_value('city'); ?>" maxlength="50" required="required">

                                    <label for="state">State</label>
                                    <input type="text" class="span1" id="state" name="state" placeholder="LA" value="<?= set_value('state'); ?>" maxlength="2" required="required">

                                    <label for="zip">Zip</label>
                                    <input type="text" class="span2" id="zip" name="zip" placeholder="70124" value="<?= set_value('zip'); ?>" maxlength="5" required="required">

                                </fieldset>

                                <fieldset>

                                    <legend>Recommended</legend>

                                    <label for="description">Description</label>
                                    <textarea class="input-block-level" id="description" name="description" placeholder="We'll be around back. BYOB" value="<?= set_value('description'); ?>" rows="3" maxlength="500"></textarea>

                                    <label for="website">Website</label>
                                    <input type="url" class="input-block-level" id="website" name="website" placeholder="www.facebook.com/awesome-crawfish-boil" value="<?= set_value('website'); ?>" maxlength="2083">

                                    <label for="email">Email Address</label>
                                    <input type="email" class="input-block-level" id="email" name="email" placeholder="john@example.com" value="<?= set_value('email'); ?>" maxlength="80">

                                    <label for="phone">Phone</label>
                                    <input type="tel" class="input-block-level" id="phone" name="phone" placeholder="504-555-5555" value="<?= set_value('phone'); ?>" maxlength="20">

                                    <label for="price">Price</label>
                                    <div class="input-prepend input-append">
                                        <span class="add-on">$</span>
                                        <input type="number" id="price" name="price" placeholder="0" value="<?= set_value('price'); ?>" maxlength="6">
                                        <span class="add-on">.00</span>
                                    </div>

                                    <label for="twitter">Twitter</label>
                                    <div class="input-prepend">
                                        <span class="add-on">@</span>
                                        <input type="text" id="twitter" name="twitter" placeholder="crawfinder" value="<?= set_value('twitter'); ?>" maxlength="140">
                                    </div>

                                </fieldset>

                                <div class="form-actions">
                                    <input type="submit" class="btn btn-large btn-primary" value="Submit">
                                    <a href="/" class="btn btn-large">Cancel</a>
                                </div>

                            </form>

                        </section>

                    </div>

                <?php endif; ?>

            </div>
        </div>
