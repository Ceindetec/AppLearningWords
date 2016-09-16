<div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
	<div class="menu_section">
		<ul class="nav side-menu">
			@if($user != null)
				@if($user->rol == 'superadmin' || $user->rol == 'administrador')
			<li><a  onclick="false"><i class="fa fa-male"></i>Administration<span class="fa fa-chevron-down"></span></a>
				<ul class="nav child_menu">
					@if($user->rol == 'superadmin')
					<li><a href="{{ route('instituciones.index') }}">Institutions</a></li>
					@endif
					<li><a href="{{ route('usuarios.index') }}">Users</a></li>
				</ul>
			</li>
				@elseif($user->rol == 'docente')
					<!-- <li><a href="{{ route('lecciones.index') }}"><i class="fa fa-home"></i>Home</a></li> -->
					<li><a href="#" onclick="return false;"><i class="fa fa-tasks"></i>Lessons<span class="fa fa-chevron-down"></span></a>
						<ul class="nav child_menu">

							<li><a href="{{ route('lecciones.index') }}">Manage lessons</a></li>
							<li><a href="{{ route('lecciones.create') }}">Create lesson</a></li>

						</ul>
					</li>
					<li><a href="{{ route('Palabras') }}"><i class="fa fa-book"></i>Manage words</a></li>

				@elseif($user->rol == 'estudiante')
					<li><a href="{{ route('actividadesRepaso.index') }}"><i class="fa fa-home"></i>home</a></li>
					<li><a href="{{ route('actividadesRepaso.index') }}"><i class="fa fa-tasks"></i>Lessons</a></li>

					<li id="menuleccion"><a id="aLeccion" href="#" onclick="return false;"><i class="fa fa-tasks"></i><span id="spanLeccion"></span><span class="fa fa-chevron-down"></span></a>
						<ul class="nav child_menu">

							<li><a href="#" id="aActividad1">Activity 1</a></li>
							<li><a href="#" id="aActividad2">Activity 2</a></li>
							<li><a href="#" id="aActividad3">Activity 3</a></li>

						</ul>
					</li>

				@endif

			@endif
		</ul>
	</div>
</div>