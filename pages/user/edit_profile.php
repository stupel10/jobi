<form action="/_inc/user/edit_profile.php" method="POST">
	<div class="row">
		<div class="col-sm-6">
			<div class="form-group">
				<label for="email"><?=lang('email')?></label>
				<input class="form-control" type="email" name="email" placeholder="email" value="<?php echo $user_profile['email']?>">
			</div>
			<div class="form-group">
				<label for="title"><?=lang('person_title')?></label>
				<input class="form-control" type="text" name="title" placeholder="title" value="<?php echo $user_profile['title']?>">
			</div>
			<div class="form-group">
				<label for="name"><?=lang('name')?></label>
				<input class="form-control" type="text" name="name" placeholder="name" value="<?php echo $user_profile['name']?>">
			</div>
			<div class="form-group">
				<label for="surname"><?=lang('surname')?></label>
				<input class="form-control" type="text" name="surname" placeholder="surname" value="<?php echo $user_profile['surname']?>">
			</div>
			<div class="form-group">
				<label for="sex"><?=lang('sex')?></label>
				<select name="sex" id="user_sex" class="custom-select">
					<option value="MALE"><?=lang('male')?></option>
					<option value="FEMALE"><?=lang('female')?></option>
				</select>
				<script>
					$('#user_sex').val('<?=$user_profile['sex']?>');
				</script>
				<!--<input class="form-control" type="text" name="sex" placeholder="sex" value="--><?php //echo $user_profile['sex']?><!--">-->
			</div>
			<div class="form-group">
				<label for="birthdate"><?=lang('birth_date')?></label>
				<input class="form-control" type="text" name="birthdate" placeholder="birthdate" value="<?php echo $user_profile['birthdate']?>">
			</div>
			<div class="form-group">
				<label for="phone"><?=lang('phone')?></label>
				<input class="form-control" type="text" name="phone" placeholder="phone" value="<?php echo $user_profile['phone']?>">
			</div>
		</div>
		<div class="col-sm-6">
			<div class="row">
				<div class="col-sm-9">
					<div class="form-group">
						<label for="street"><?=lang('street')?></label>
						<input class="form-control" type="text" name="street" placeholder="street" value="<?php echo $user_profile['address_street']?>">
					</div>
				</div>
				<div class="col-sm-3">
					<div class="form-group">
						<label for="number"><?=lang('street_number')?></label>
						<input class="form-control" type="text" name="number" placeholder="number" value="<?php echo $user_profile['address_street_number']?>">
					</div>
				</div>
			</div>
			<div class="form-group">
				<label for="PSC"><?=lang('psc')?></label>
				<input class="form-control" type="number" name="PSC" placeholder="PSC" value="<?php echo $user_profile['address_PSC']?>">
			</div>
			<div class="form-group">
				<label for="city"><?=lang('city')?></label>
				<input class="form-control" type="text" name="city" placeholder="city" value="<?php echo $user_profile['address_city']?>">
			</div>
			<div class="form-group">
				<label for="country"><?=lang('country')?></label>
				<input class="form-control" type="text" name="country" placeholder="country" value="<?php echo $user_profile['address_country']?>">
			</div>
		</div>
		<div class="col-sm-12">
			<input class="form-control btn btn-success" type="submit" value="<?=lang('submit')?>" class="btn btn-danger">
		</div>
	</div>
</form>