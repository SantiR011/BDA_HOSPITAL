<div class="box">
	<div class="box-header">

		<!------CONTROL TABS START------->
		<ul class="nav nav-tabs nav-tabs-left">
			<?php if (isset($edit_profile)) : ?>
				<li class="active">
					<a href="#edit" data-toggle="tab"><i class="icon-wrench"></i>
						<?php echo ('Editar el tablón de anuncios'); ?>
					</a>
				</li>
			<?php endif; ?>

			<li class="<?php if (!isset($edit_profile)) echo 'active'; ?>">
				<a href="#list" data-toggle="tab"><i class="icon-align-justify"></i>
					<?php echo ('Lista del tablón de anuncios'); ?>
				</a>
			</li>

			<li>
				<a href="#add" data-toggle="tab"><i class="icon-plus"></i>
					<?php echo ('Añadir tablón de anuncios'); ?>
				</a>
			</li>
		</ul>
		<!------CONTROL TABS END------->
	</div>

	<div class="box-content padded">
		<div class="tab-content">

			<!----EDITING FORM STARTS---->
			<?php if (isset($edit_profile)) : ?>
				<div class="tab-pane box active" id="edit" style="padding: 5px">
					<div class="box-content">
						<?php foreach ($edit_profile as $row) : ?>
							<?php echo form_open('admin/gestionar_tablon_de_anuncios/edit/do_update/' . $row['noticia_id'], array('class' => 'form-horizontal validatable')); ?>
							<div class="padded">
								<div class="control-group">
									<label class="control-label"><?php echo ('Título'); ?></label>
									<div class="controls">
										<input type="text" class="validate[required]" name="noticia_titulo" value="<?php echo $row['noticia_titulo']; ?>" />
									</div>
								</div>

								<div class="control-group">
									<label class="control-label"><?php echo ('Aviso'); ?></label>
									<div class="controls">
										<input type="text" class="" name="noticia" value="<?php echo $row['noticia']; ?>" />
									</div>
								</div>

								<div class="control-group">
									<label class="control-label"><?php echo ('Fecha'); ?></label>
									<div class="controls">
										<input type="text" class="datepicker fill-up" name="crear_timestamp" value="<?php echo date('m/d/Y', $row['crear_timestamp']); ?>" />
									</div>
								</div>
							</div>

							<div class="form-actions">
								<button type="submit" class="btn btn-primary"><?php echo ('Editar el tablón de anuncios'); ?></button>
							</div>
							<?php echo form_close(); ?>
						<?php endforeach; ?>
					</div>
				</div>
			<?php endif; ?>
			<!----EDITING FORM ENDS--->

			<!----TABLE LISTING STARTS--->
			<div class="tab-pane box <?php if (!isset($edit_profile)) echo 'active'; ?>" id="list">
				<table cellpadding="0" cellspacing="0" border="0" class="dTable responsive table-hover">
					<thead>
						<tr>
							<th><div>#</div></th>
							<th><div><?php echo ('Título'); ?></div></th>
							<th><div><?php echo ('Aviso'); ?></div></th>
							<th><div><?php echo ('Fecha'); ?></div></th>
							<th><div><?php echo ('Opciones'); ?></div></th>
						</tr>
					</thead>
					<tbody>
						<?php $count = 1;
						foreach ($notices as $row) : ?>
							<tr>
								<td><?php echo $count++; ?></td>
								<td><?php echo $row['noticia_titulo']; ?></td>
								<td><?php echo $row['noticia']; ?></td>
								<td><?php echo date('d M,Y', $row['crear_timestamp']); ?></td>
								<td align="center">
									<a href="<?php echo base_url(); ?>index.php?admin/gestionar_tablon_de_anuncios/edit/<?php echo $row['noticia_id']; ?>" rel="tooltip" data-placement="top" data-original-title="<?php echo ('Edit'); ?>" class="btn btn-primary">
										<i class="icon-wrench"></i>
									</a>
									<a href="<?php echo base_url(); ?>index.php?admin/gestionar_tablon_de_anuncios/delete/<?php echo $row['noticia_id']; ?>" onclick="return confirm('¿Eliminar?')" rel="tooltip" data-placement="top" data-original-title="<?php echo ('Delete'); ?>" class="btn btn-danger">
										<i class="icon-trash"></i>
									</a>
								</td>
							</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
			</div>
			<!----TABLE LISTING ENDS--->

			<!----CREATION FORM STARTS---->
			<div class="tab-pane box" id="add" style="padding: 5px">
				<div class="box-content">
					<?php echo form_open('admin/gestionar_tablon_de_anuncios/create/', array('class' => 'form-horizontal validatable')); ?>
					<div class="padded">
						<div class="control-group">
							<label class="control-label"><?php echo ('Título'); ?></label>
							<div class="controls">
								<input type="text" class="validate[required]" name="noticia_titulo" />
							</div>
						</div>

						<div class="control-group">
							<label class="control-label"><?php echo ('Aviso'); ?></label>
							<div class="controls">
								<input type="text" class="" name="noticia" />
							</div>
						</div>

						<div class="control-group">
							<label class="control-label"><?php echo ('Fecha'); ?></label>
							<div class="controls">
								<input type="text" class="datepicker fill-up" name="crear_timestamp" />
							</div>
						</div>
					</div>

					<div class="form-actions">
						<button type="submit" class="btn btn-primary"><?php echo ('Añadir tablón de anuncios'); ?></button>
					</div>
					<?php echo form_close(); ?>
				</div>
			</div>
			<!----CREATION FORM ENDS--->
		</div>
	</div>
</div>
