<!-- need to remove -->
<li class="nav-item">
    <a href="{{ route('dashboard') }}" class="nav-link {{ Request::is('dashboard') ? 'active' : '' }}">
        <i class="nav-icon fas fa-tachometer-alt"></i>
        <p>Web Site</p>
    </a>
</li>
<li class="nav-item">
    <a href="{{ route('home') }}" class="nav-link {{ Request::is('home') ? 'active' : '' }}">
        <i class="nav-icon fas fa-home"></i>
        <p>Web Site</p>
    </a>
</li>
<li class="nav-item">
    <a href="#" class="nav-link active">
        <i class="nav-icon fas fa-bed"></i>
        <p>
            Rooms
            <i class="right fas fa-angle-left"></i>
        </p>
    </a>
    <ul class="nav nav-treeview" style="display: none;">
        <li class="nav-item">
            <a href="{{route('room.index')}}" class="nav-link active">
                <i class="fas fa-list-ul nav-icon"></i>
                <p>Rooms List</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{route('room.create')}}" class="nav-link">
                <i class="fas fa-plus nav-icon"></i>
                <p>Create Room</p>
            </a>
        </li>
    </ul>
</li>
