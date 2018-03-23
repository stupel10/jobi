<?php

$resumes = get_user_CVs($user->id);

?>
<div class="page-header">
	<h1>
		THESE ARE ALL YOUR CVS
	</h1>
</div>
<div class="row">
	<div class="col-sm-12">
		<?php
			if( $resumes == false) {
				echo "<br><h3 style='color:red;'>You dont have any CV yet! Go make it!";
			}else {
				?>
				<ul class="list-group">
					<?php

					foreach ( $resumes AS $cv ) {
						echo '<li class="list-group-item">'.
						     '<span>' . $cv["title"] . '</span>'.
							 '<div class="tools pull-right">'.
								'<a href="/user/cv?cv_id='.$cv['id'].'" class="btn btn-success">VIEW</a>'.
								'<a href="/user/edit_cv?cv_id='.$cv['id'].'" class="btn btn-warning">EDIT</a>'.
								'<a href="javascript:void(0)" onclick="deleteCV('.$cv['id'].')" class="btn btn-danger delete">DELETE</a>'.
							 '</div>'.
						     '</li>';
					}
					?>
				</ul>
			<?php } ?>
	</div>
	<div class="col-sm-12">
		<br>
		<a href="/user/edit_cv" class="btn btn-warning">CREATE NEW CV</a>
	</div>
</div>
