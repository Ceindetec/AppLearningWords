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
				@endif
			@endif
		</ul>
	</div>
</div>