<?php

$resumes = get_user_CVs($user->id);

?>
<div class="page-header">
	<h1>
		<?=lang('all_cvs_title')?>
	</h1>
</div>
<div class="row">
	<div class="col-sm-12">
		<?php
			if( $resumes == false) {
				echo "<br><h3 style='color:red;'>".lang('all_cvs_empty')."</h3>";
			}else {
				?>
				<ul class="list-group">
					<?php

					foreach ( $resumes AS $cv ) {
						?>
					<li class="list-group-item">
						<h4><?=$cv["title"]?></h4>
						<div class="tools pull-right">
							<a href="/user/cv?cv_id=<?=$cv['id']?>" class="btn btn-success"><?=lang('detail')?></a>
							<a href="/user/edit_cv?cv_id=<?=$cv['id']?>" class="btn btn-warning"><?=lang('edit')?></a>
							<a href="javascript:void(0)" onclick="deleteCV(<?=$cv['id']?>)" class="btn btn-danger delete"><?=lang('delete')?></a>
						</div>
					</li>
					<?php } ?>
				</ul>
			<?php } ?>
	</div>
	<div class="col-sm-12">
		<br>
		<a href="/user/edit_cv" class="btn btn-warning"><?=lang('create')?></a>
	</div>
</div>
