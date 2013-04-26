
<?php echo form_open('myprofile/save', array('id' => 'contentform')); ?>

	<div class="content-header">
		<div class="content-title">
			<h1>My Profile</h1>
		</div>
		<div class="content-actions">
			<input type="submit" id="save-btn" name="save-btn" class="button" value="Save"/>
			<input type="button" id="cancel-btn" name="cancel-btn" class="button checkdirty" value="Cancel" onclick="window.history.back()"/>
		</div>
	</div>
	
	<div class="content-body">
	
		<table class="datatable">
			<tr>
				<td>name</td>
				<td>
					<input type="text" id="myprofile-name" name="myprofile-name" value="<?php echo $name; ?>" class="mandatory" style="width:240px"/>
				</td>
			</tr>
			<tr>
				<td>sign-in</td>
				<td>
					<input type="text" id="myprofile-signin" name="myprofile-signin" value="<?php echo $username; ?>" class="mandatory" style="width:240px"/>
				</td>
			</tr>
			<tr>
				<td>email</td>
				<td>
					<input type="text" id="myprofile-email" name="myprofile-email" value="<?php echo $email; ?>" class="mandatory" style="width:240px"/>
				</td>
			</tr>
			<tr>
				<td>phone</td>
				<td>
					<input type="text" id="myprofile-phone" name="myprofile-phone" value="<?php echo $phone; ?>" style="width:180px"/>
				</td>
			</tr>
			<tr>
				<td>mobile</td>
				<td>
					<input type="text" id="myprofile-mobile" name="myprofile-mobile" value="<?php echo $mobile; ?>" style="width:180px"/>
				</td>
			</tr>
			<tr>
				<td colspan="2">
					<div id="signin-reset" class="collapsible" style="padding:8px 0">
						<div class="header">
							<img src="<?php echo base_url();?>img/arrow_exp.png"/>Change Password?
						</div>
						<div class="body">
							
							<table class="datatable" style="padding-left:0">
								<tr>
									<td colspan="2">To change your password please enter your current password, new password, then re-enter your new password to confirm.</td>
								</tr>
								<tr>
									<td>current</td>
									<td>
										<input type="password" id="myprofile-password-curr" name="myprofile-password-curr" value="<?php echo $password; ?>" class="mandatory" style="width:240px"/>
									</td>
								</tr>
								<tr>
									<td>new</td>
									<td>
										<input type="password" id="myprofile-password-new" name="myprofile-password-new" value="<?php echo $passwordnew; ?>" class="mandatory" style="width:240px"/>
									</td>
								</tr>
								<tr>
									<td>confirm</td>
									<td>
										<input type="password" id="myprofile-password-conf" name="myprofile-password-conf" value="<?php echo $passwordconf; ?>" class="mandatory" style="width:240px"/>
									</td>
								</tr>
							</table>
							
						</div>
					</div>							
				</td>
			</tr>
		</table>
				
	</div>

<?php echo form_close(); ?>
	