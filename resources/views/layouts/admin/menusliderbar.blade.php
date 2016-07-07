<div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
	<div class="menu_section">
		<ul class="nav side-menu">
			@if($user != null)
				@if($user->rol == 'superadmin' || $user->rol == 'administrador')
			<li><a href="{{ route('administracion.index') }}"><i class="fa fa-male"></i>Administración<span class="fa fa-chevron-down"></span></a>
				<ul class="nav child_menu">
					@if($user->rol == 'superadmin')
					<li><a href="{{ route('instituciones.index') }}">Instituciones</a></li>
					@endif
					<li><a href="{{ route('usuarios.index') }}">Usuarios</a></li>
				</ul>
			</li>
				@elseif($user->rol == 'docente')
					<li><a href="{{ route('lecciones.index') }}"><i class="fa fa-home"></i>Inicio</a></li>
					<li><a href="#" onclick="return false;"><i class="fa fa-tasks"></i>Lecciones<span class="fa fa-chevron-down"></span></a>
						<ul class="nav child_menu">

								<li><a href="{{ route('lecciones.index') }}">Administrar Lecciones</a></li>
							<li><a href="{{ route('lecciones.create') }}">Crear Lección</a></li>

						</ul>
					</li>
					<li><a href="{{ route('Palabras') }}"><i class="fa fa-book"></i>Gestionar Palabras</a></li>

				@elseif($user->rol == 'estudiante')
					<li><a href="{{ route('actividadesRepaso.index') }}"><i class="fa fa-home"></i>Inicio</a></li>
					<li><a href="{{ route('actividadesRepaso.index') }}"><i class="fa fa-tasks"></i>Lecciones</a></li>
				@endif

			@endif
		</ul>
	</div>
</div>