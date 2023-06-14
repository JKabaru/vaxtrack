<!-- register_form.php -->

<h2>User Registration</h2>

<?php echo validation_errors(); ?>

<?php echo form_open('register/process'); ?>

<label for="username">Username:</label>
<input type="text" name="username" value="<?php echo set_value('username'); ?>">
<br>

<label for="password">Password:</label>
<input type="password" name="password">
<br>

<label for="confirm_password">Confirm Password:</label>
<input type="password" name="confirm_password">
<br>

<input type="submit" value="Register">

<?php echo form_close(); ?>
