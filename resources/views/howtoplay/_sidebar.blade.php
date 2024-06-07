<ul>
    <li class="sidebar-header"><a href="{{ url('howtoplay/gettingstarted') }}" class="card-link">How To Play</a></li>

    @auth
        <li class="sidebar-section">
            <div class="sidebar-section-header">New Players</div>
            <div class="dropdown-divider"></div>

            <div class="sidebar-item"><a href="{{ url('/howtoplay/gettingstarted') }}" class="{{ set_active('howtoplay/gettingstarted*') }}">Getting Started</a></div>
            <div class="sidebar-item"><a href="{{ url('howtoplay/sitenav') }}" >Site Navigation</a></div>
            <div class="sidebar-item"><a href="{{ url('howtoplay/sitenav') }}" >Obtaining Daturas</a></div>
        </li>

        <li class="sidebar-section">
            <div class="sidebar-section-header">Obtaining</div>
            <div class="dropdown-divider"></div>

            <div class="sidebar-item"><a href="{{ url('user/' . Auth::user()->name . '/favorites') }}" class="{{ set_active('user/' . Auth::user()->name . '/favorites') }}">Traps</a></div>
            <div class="sidebar-item"><a href="{{ url('user/' . Auth::user()->name . '/favorites') }}" class="{{ set_active('user/' . Auth::user()->name . '/favorites') }}">Raffles</a></div>
            
            <div class="dropdown-divider"></div>
            <div class="sidebar-section-header">Discord Only</div>
            <div class="dropdown-divider"></div>

            <div class="sidebar-item"><a href="{{ url('gallery/submissions/pending') }}" class="{{ set_active('gallery/submissions*') }}">Release</a></div>
            <div class="sidebar-item"><a href="{{ url('user/' . Auth::user()->name . '/gallery') }}" class="{{ set_active('user/' . Auth::user()->name . '/gallery') }}">Adopt</a></div>
            <div class="sidebar-item"><a href="{{ url('user/' . Auth::user()->name . '/gallery') }}" class="{{ set_active('user/' . Auth::user()->name . '/gallery') }}">Outcasts</a></div>
            <div class="sidebar-item"><a href="{{ url('user/' . Auth::user()->name . '/gallery') }}" class="{{ set_active('user/' . Auth::user()->name . '/gallery') }}">Gacha</a></div>
        </li>

        <li class="sidebar-section">
            <div class="sidebar-section-header">Activities</div>
            <div class="dropdown-divider"></div>

            <div class="sidebar-item"><a href="{{ url('user/' . Auth::user()->name . '/favorites') }}" class="{{ set_active('user/' . Auth::user()->name . '/favorites') }}">Tracking</a></div>
            <div class="sidebar-item"><a href="{{ url('user/' . Auth::user()->name . '/favorites') }}" class="{{ set_active('user/' . Auth::user()->name . '/favorites') }}">Offspring</a></div>
            <div class="sidebar-item"><a href="{{ url('user/' . Auth::user()->name . '/favorites') }}" class="{{ set_active('user/' . Auth::user()->name . '/favorites') }}">Aging</a></div>
            <div class="sidebar-item"><a href="{{ url('user/' . Auth::user()->name . '/favorites') }}" class="{{ set_active('user/' . Auth::user()->name . '/favorites') }}">Quests</a></div>
            <div class="sidebar-item"><a href="{{ url('user/' . Auth::user()->name . '/favorites') }}" class="{{ set_active('user/' . Auth::user()->name . '/favorites') }}">Prompts</a></div>
        </li>
    @endauth
</ul>
