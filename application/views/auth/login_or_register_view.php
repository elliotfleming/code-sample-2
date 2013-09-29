
        <div class="row-fluid">
            <div class="span12">

                <?php if (!empty($status_messages)): ?>
                    <div class="message">
                        <?= $status_messages ?>
                    </div>
                <?php endif; ?>

                <div class="backdrop">

                    <section>

                        <h2>Login</h2>

                        <?php if (!empty($error_messages) || validation_errors()): ?>

                            <div class="error">

                                <?php if (!empty($error_messages)): ?>
                                    <?= $error_messages ?>
                                <?php endif; ?>

                                <?php if (validation_errors()): ?>
                                    <?= validation_errors(); ?>
                                <?php endif; ?>

                            </div>

                        <?php endif; ?>

                        <?= form_open(current_url()); ?>

                            <label for="email">Email</label>
                            <input type="text" class="input-block-level" id="email" name="email" value="<?= set_value('email') ?>" maxlength="100" required="required">

                            <label for="password">Password</label>
                            <input type="password" class="input-block-level" id="password" name="password" value="<?= set_value('password') ?>" maxlength="100" required="required">
                            <span class="help-block"><a href="/auth/forgotten_password">Forgotten Your Password?</a></span>

                            <?php if (isset($captcha)): ?>
                            <?= $captcha ?>
                            <?php endif; ?>

                            <label for="remember_me" class="checkbox">
                                <input type="checkbox" id="remember_me" name="remember_me" value="1" <?= set_checkbox('remember_me', 1) ?>> Remember Me
                            </label>

                            <div class="form-actions">
                                <input type="submit" name="login_user" class="btn btn-large btn-primary" value="Submit">
                                <a href="/" class="btn btn-large">Cancel</a>
                            </div>

                        </form>

                    </section>

                </div>

                <div class="backdrop">

                    <section>

                        <h2>Register</h2>

                        <?php if (validation_errors()): ?>
                            <div class="error">
                                <?= validation_errors(); ?>
                            </div>
                        <?php endif; ?>

                        <?= form_open(current_url()); ?>

                            <label for="email">Email</label>
                            <input type="text" class="input-block-level" id="email" name="email" value="<?= set_value('email') ?>" maxlength="100" required="required">

                            <label for="password">Password</label>
                            <input type="password" class="input-block-level" id="password" name="password" value="<?= set_value('password') ?>" maxlength="100" required="required">
                            
                            <label for="confirm_password">Confirm Password</label>
                            <input type="password" class="input-block-level" id="confirm_password" name="confirm_password" value="<?= set_value('confirm_password') ?>" maxlength="100" required="required">

                            <?php if (isset($captcha)): ?>
                                <?= $captcha ?>
                            <?php endif; ?>

                            <label for="remember_me" class="checkbox">
                                <input type="checkbox" id="remember_me" name="remember_me" value="1" <?= set_checkbox('remember_me', 1) ?>> Remember Me
                            </label>

                            <div class="form-actions">
                                <input type="submit" name="register_user" class="btn btn-large btn-primary" value="Submit">
                                <a href="/" class="btn btn-large">Cancel</a>
                            </div>

                        </form>

                    </section>

                </div>

            </div>
        </div>
