<ul>
    <li class="sidebar-header"><a href="{{ url('howtoplay') }}" class="card-link">How To Play</a></li>

    @auth
        <li class="sidebar-section">
            <div class="sidebar-section-header">Getting Started</div>
            <div class="sidebar-item"><a href="{{ url('gallery/submissions/pending') }}" class="{{ set_active('gallery/submissions*') }}">My Submission Queue</a></div>
            <div class="sidebar-item"><a href="{{ url('user/' . Auth::user()->name . '/gallery') }}" class="{{ set_active('user/' . Auth::user()->name . '/gallery') }}">My Gallery</a></div>
            <div class="sidebar-item"><a href="{{ url('user/' . Auth::user()->name . '/favorites') }}" class="{{ set_active('user/' . Auth::user()->name . '/favorites') }}">My Favorites</a></div>
        </li>
    @endauth
</ul>
