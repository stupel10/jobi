<form action="/_inc/company/edit_profile.php" method="POST">
	<div class="row">
		<div class="col-sm-6">
			<div class="form-group">
				<label for="email">EMAIL</label>
				<input type="email" name="email" placeholder="email" value="<?php echo $user_profile['email']?>">
			</div>
			<div class="form-group">
				<label for="name">NAME</label>
				<input type="text" name="name" placeholder="name" value="<?php echo $user_profile['name']?>">
			</div>
			<div class="form-group">
				<label for="phone">PHONE</label>
				<input type="text" name="phone" placeholder="phone" value="<?php echo $user_profile['phone']?>">
			</div>
		</div>
		<div class="col-sm-6">
			ADDRESS:
			<div class="form-group">
				<label for="street">STREET</label>
				<input type="text" name="street" placeholder="street" value="<?php echo $user_profile['address_street']?>">
			</div>
			<div class="form-group">
				<label for="number">NUMBER</label>
				<input type="text" name="number" placeholder="number" value="<?php echo $user_profile['address_street_number']?>">
			</div>
			<div class="form-group">
				<label for="PSC">PSC</label>
				<input type="number" name="PSC" placeholder="PSC" value="<?php echo $user_profile['address_PSC']?>">
			</div>
			<div class="form-group">
				<label for="city">CITY</label>
				<input type="text" name="city" placeholder="city" value="<?php echo $user_profile['address_city']?>">
			</div>
			<div class="form-group">
				<label for="country">COUNTRY</label>
				<input type="text" name="country" placeholder="country" value="<?php echo $user_profile['address_country']?>">
			</div>
		</div>
		<div class="col-sm-12">
			<input type="submit" value="submit" class="btn btn-danger">
		</div>
	</div>
</form>