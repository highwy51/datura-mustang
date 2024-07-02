<div class="card mb-3">
    <div class="card-header h2">
        Age Information
        <span class="badge badge-{{ $level->nextLevel ? 'dark' : 'success' }} text-white mx-1 float-right" data-toggle="tooltip" title="Level {{ $level->current_level }}">
            {{ $level->nextLevel ? 'Current Age: ' . $level->current_level : 'Max Age' }}
        </span>
    </div>
    <div class="card-body">
        <div class="container text-center mb-3">
            @if ($level->nextLevel)
                <p><b>Next Age:</b> {{ $level->nextLevel->level }}</p>
                {{ $level->current_exp }}/{{ $level->nextLevel->exp_required }}
                <div class="progress">
                    <div class="progress-bar progress-bar-striped active progress-bar-animated" role="progressbar" aria-valuenow="{{ $level->current_exp }}" aria-valuemin="0" aria-valuemax="{{ $level->nextLevel->exp_required }}"
                        style="width:{{ $level->progressBarWidth }}%">
                        {{ $level->current_exp }}/{{ $level->nextLevel->exp_required }}
                    </div>
                </div>
                @if ($level->current_exp >= $level->nextLevel->exp_required && Auth::check() && ($level->user ?? Auth::user()->id == $level->character?->id))
                    <div class="text-center m-1">
                        <b>
                            <p>You have enough AP to Age up!</p>
                        </b>
                    </div>
                    {!! Form::open(['url' => $level->user ? '/stats/level' : $level->character->url . '/stats/level']) !!}

                    {!! Form::submit('Age up!', ['class' => 'btn btn-success mb-2']) !!}

                    {!! Form::close() !!}
                @endif
            @else
                {{ $level->current_exp }} AP (Max Age)
                <div class="progress">
                    <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="{{ $level->current_exp }}" aria-valuemin="0" aria-valuemax="{{ $level->current_exp }}" style="width:100%">
                        {{ $level->current_exp }}
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
