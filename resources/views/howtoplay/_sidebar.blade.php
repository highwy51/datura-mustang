<ul>
    <li class="sidebar-header"><a href="{{ url('howtoplay') }}" class="card-link">How To Play</a></li>

    @auth
        <li class="sidebar-section">
            <div class="sidebar-section-header">New Players</div>
            <div class="sidebar-item"><a href="{{ url('/howtoplay/gettingstarted') }}" class="{{ set_active('howtoplay/gettingstarted*') }}">Getting Started</a></div>
            <div class="sidebar-item"><a href="{{ url('user/' . Auth::user()->name . '/gallery') }}" class="{{ set_active('user/' . Auth::user()->name . '/gallery') }}">Obtaining Daturas</a></div>
            <div class="sidebar-item"><a href="{{ url('user/' . Auth::user()->name . '/favorites') }}" class="{{ set_active('user/' . Auth::user()->name . '/favorites') }}">Etc</a></div>
        </li>

        <li class="sidebar-section">
            <div class="sidebar-section-header">Game Mechanics</div>
            <div class="sidebar-item"><a href="{{ url('gallery/submissions/pending') }}" class="{{ set_active('gallery/submissions*') }}">Release</a></div>
            <div class="sidebar-item"><a href="{{ url('user/' . Auth::user()->name . '/gallery') }}" class="{{ set_active('user/' . Auth::user()->name . '/gallery') }}">Adopt</a></div>
            <div class="sidebar-item"><a href="{{ url('user/' . Auth::user()->name . '/favorites') }}" class="{{ set_active('user/' . Auth::user()->name . '/favorites') }}">Traps</a></div>
            <div class="sidebar-item"><a href="{{ url('user/' . Auth::user()->name . '/favorites') }}" class="{{ set_active('user/' . Auth::user()->name . '/favorites') }}">Breeding</a></div>
            <div class="sidebar-item"><a href="{{ url('user/' . Auth::user()->name . '/favorites') }}" class="{{ set_active('user/' . Auth::user()->name . '/favorites') }}">Raffles</a></div>
        </li>
    @endauth
</ul>
