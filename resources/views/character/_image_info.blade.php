{{-- Image Data --}}
<div class="col-md-5 d-flex">
    <div class="card character-bio w-100">
        <div class="card-header">
            <ul class="nav nav-tabs card-header-tabs">
                <li class="nav-item">
                    <a class="nav-link active" id="infoTab-{{ $image->id }}" data-toggle="tab" href="#info-{{ $image->id }}" role="tab">Info</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="notesTab-{{ $image->id }}" data-toggle="tab" href="#notes-{{ $image->id }}" role="tab">Bio</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="creditsTab-{{ $image->id }}" data-toggle="tab" href="#credits-{{ $image->id }}" role="tab">Credits</a>
                </li>
                @if (isset($showMention) && $showMention)
                    <li class="nav-item">
                        <a class="nav-link" id="mentionTab-{{ $image->id }}" data-toggle="tab" href="#mention-{{ $image->id }}" role="tab">Mention</a>
                    </li>
                @endif
                @if (Auth::check() && Auth::user()->hasPower('manage_characters'))
                    <li class="nav-item">
                        <a class="nav-link" id="settingsTab-{{ $image->id }}" data-toggle="tab" href="#settings-{{ $image->id }}" role="tab"><i class="fas fa-cog"></i></a>
                    </li>
                @endif
            </ul>
        </div>
        <div class="card-body tab-content">
            <div class="text-right mb-1">
                <div class="badge badge-primary">Image #{{ $image->id }}</div>
            </div>

            {{-- Basic info --}}
            <div class="tab-pane fade show active" id="info-{{ $image->id }}">
                
                <!-- Nickname -->
                @if ($character->nickname)
                    <div class="row">
                        <div class="col-lg-4 col-md-6 col-4">
                            <h6><b>Nickname</b></h6>
                        </div>
                        <div class="col-lg-8 col-md-6 col-8">{!! $character->nickname !!}</div>
                    </div>
                @endif

                <!-- Herd -->
                @if ($character->herd)
                    <div class="row">
                        <div class="col-lg-4 col-md-6 col-4">
                            <h6><b>Herd</b></h6>
                        </div>
                        <div class="col-lg-8 col-md-6 col-8">{!! $character->herd !!}</div>
                    </div>
                @endif

                <!-- Sub-breed -->
                @if ($image->subtype_id)
                    <div class="row">
                        <div class="col-lg-4 col-md-6 col-4">
                            <h6><b>Sub-breed</b></h6>
                        </div>
                        <div class="col-lg-8 col-md-6 col-8">{!! $image->subtype_id ? $image->subtype->displayName : 'None' !!}</div>
                    </div>
                @endif

                <!-- Gender -->
                @if ($image->sex)
                    <div class="row">
                        <div class="col-lg-4 col-md-6 col-4">
                            <h6><b>Gender</b></h6>
                        </div>
                        <div class="col-lg-8 col-md-6 col-8">{!! $image->sex !!}</div>
                    </div>
                @endif
                
                <!-- Height -->
                <div class="row">
                        <div class="col-lg-4 col-md-6 col-4">
                            <h6><b>Height</b></h6>
                        </div>
                        @if ($character->height)
                        <div class="col-lg-8 col-md-6 col-8">{!! $character->height !!} hh</div>
                        @else <div class="col-lg-8 col-md-6 col-8"> Unknown </div>
                        @endif
                    </div>

                <div class="dropdown-divider"></div>

                <!-- Mutation Status -->
                @if($character->profile->custom_values->count() > 0)
                    @php $valueGroups = $character->profile->custom_values->groupBy('group'); @endphp
                    @foreach($valueGroups as $groupName => $values)
                        <div class="row">
                            @if($groupName)
                                <div class="col-lg-4 col-md-6 col-4">
                                    <h6><b>{{ $groupName }}</b></h6>
                                </div>
                            @endif
                            <div class="col-lg-8 col-md-6 col-8">
                                @foreach($values as $value)
                                    <div class="row mb-2">
                                        @if($value->name && $value->name != "")
                                            <div class="col-12">
                                                <h6 class="mb-0" style="font-weight: bold;">{{ $value->name }}</h6>
                                            </div>
                                            <div class="col-12">{!! $value->data_parsed !!}</div>
                                        @else
                                            <div class="col-12">{!! $value->data_parsed !!}</div>
                                        @endif
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                @endif
                
                <!-- Coat -->
                <div class="row">
                    <div class="col-lg-4 col-md-6 col-4">
                        <h6><b>Coat</b></h6>
                    </div>
                </div>

                <div class="div-6">
                    @if (config('lorekeeper.extensions.traits_by_category'))
                        @php
                            $traitgroup = $image->features()->get()->groupBy('feature_category_id');
                            $hasCoatFeatures = false;
                            $hasChimeraFeatures = false;
                        @endphp
                        @if ($image->features()->count())
                            @foreach ($traitgroup as $key => $group)
                                @foreach ($group as $feature)
                                    @if (in_array($feature->feature->category->name, ['Base Coat', 'White Markings', 'Dilution Genes']))
                                        @php
                                            $hasCoatFeatures = true;
                                            $displayName = str_replace(' (C)', '', $feature->feature->displayName);
                                        @endphp
                                        {!! $displayName !!}
                                        @if ($feature->data)
                                            ({{ $feature->data }})
                                        @endif
                                    @endif
                                @endforeach
                            @endforeach
                            @if (!$hasCoatFeatures)
                                <div>No coat listed</div>
                            @endif

                            @foreach ($traitgroup as $key => $group)
                                @foreach ($group as $feature)
                                    @if ($feature->feature->category->name == 'Chimera')
                                        @if (!$hasChimeraFeatures)
                                            @php $hasChimeraFeatures = true; @endphp
                                            | Chimera:
                                        @endif
                                        @php
                                            $displayName = str_replace(' (C)', '', $feature->feature->displayName);
                                        @endphp
                                        {!! $displayName !!}
                                        @if ($feature->data)
                                            ({{ $feature->data }})
                                        @endif
                                    @endif
                                @endforeach
                            @endforeach
                            @else
                                <div>No coat listed</div>
                            @endif
                            @else
                                <div>
                                    @php
                                        $features = $image->features()->get();
                                        $hasCoatFeatures = false;
                                        $hasChimeraFeatures = false;
                                    @endphp
                                    @if ($features->count())
                                        @foreach ($features as $feature)
                                            @if (in_array($feature->feature->category->name, ['Base Coat', 'White Markings', 'Dilution Genes']))
                                                @php
                                                    $hasCoatFeatures = true;
                                                    $displayName = str_replace(' (C)', '', $feature->feature->displayName);
                                                @endphp
                                                {!! $displayName !!}
                                                @if ($feature->data)
                                                    ({{ $feature->data }})
                                                @endif
                                            @endif
                                        @endforeach
                                        @if (!$hasCoatFeatures)
                                            <div>No coat listed</div>
                                        @endif
                                        @foreach ($features as $feature)
                                            @if ($feature->feature->category->name == 'Chimera')
                                                @if (!$hasChimeraFeatures)
                                                    @php $hasChimeraFeatures = true; @endphp
                                                    | Chimera:
                                                @endif
                                                @php
                                                    $displayName = str_replace(' (C)', '', $feature->feature->displayName);
                                                @endphp
                                                {!! $displayName !!}
                                                @if ($feature->data)
                                                    ({{ $feature->data }})
                                                @endif
                                            @endif
                                        @endforeach
                                        @else
                                            <div>No coat listed</div>
                                        @endif
                                </div>
                @endif

                </div>


                <!-- Mutations -->
                <div class="row">
                    <div class="col-lg-4 col-md-6 col-4">
                        <h6><b>Mutations</b></h6>
                    </div>
                </div>

                @if (config('lorekeeper.extensions.traits_by_category'))
                    @php
                        $traitgroup = $image->features()->get()->groupBy('feature_category_id');
                        $hasMutations = false;
                    @endphp
                    @if ($image->features()->count())
                        @foreach ($traitgroup as $key => $group)
                            @foreach ($group as $feature)
                                @if ($feature->feature->category->name == 'Mutations')
                                    @php $hasMutations = true; @endphp
                                    {!! $feature->feature->displayName !!}
                                    @if ($feature->data)
                                        ({{ $feature->data }})
                                    @endif
                                @endif
                            @endforeach
                        @endforeach
                        @if (!$hasMutations)
                            <div>None</div>
                        @endif
                            @else
                                <div>None</div>
                    @endif
                        @else
                        <div>
                            @php
                                $features = $image->features()->get();
                                $hasMutations = false;
                            @endphp
                            @if ($features->count())
                                @foreach ($features as $feature)
                                    @if ($feature->feature->category->name == 'Mutations')
                                        @php $hasMutations = true; @endphp
                                            {!! $feature->feature->displayName !!}
                                        @if ($feature->data)
                                            ({{ $feature->data }})
                                        @endif
                                    @endif
                                @endforeach
                                    @if (!$hasMutations)
                                        <div>None</div>
                                    @endif
                                @else
                                    <div>None</div>
                            @endif
                        </div>
                @endif

                <!-- Fertility -->
                <div style="margin-top: 10px;">
                    <div class="row">
                        <div class="col-lg-4 col-md-6 col-4">
                            <h6><b>Ferility</b></h6>
                        </div>
                        @php
                            use App\Models\Character\CharacterLineageBlacklist;
                            $blacklistLevel = CharacterLineageBlacklist::getBlacklistLevel($character);
                        @endphp

                        @if ($blacklistLevel == 0 || $blacklistLevel == 2)
                            <div class="col-lg-8 col-md-6 col-8">Fertile</div>
                        @elseif ($blacklistLevel == 1)
                        <div class="col-lg-8 col-md-6 col-8">Infertile</div>
                        @endif
                    </div>
                </div>


                <!-- Created -->
                <div>
                    <div class="dropdown-divider"></div>
                    <small><strong>Created:</strong> {!! format_date($character->created_at) !!}</small>
                </div>

                <!-- Trade Status -->


                @if (Auth::check() && Auth::user()->hasPower('manage_characters'))
                    <div class="mt-3">
                        <a href="#" class="btn btn-outline-info btn-sm edit-features mb-3" data-id="{{ $image->id }}"><i class="fas fa-cog"></i> Edit</a>
                    </div>
                @endif

                @if (count($image->character->pets))
                    <div class="row justify-content-center text-center">
                        {{-- get one random pet --}}
                        @php
                            $pets = $image->character->pets()->orderBy('sort', 'DESC')->limit(config('lorekeeper.pets.display_pet_count'))->get();
                        @endphp
                        @foreach ($pets as $pet)
                            @if (config('lorekeeper.pets.pet_bonding_enabled'))
                                @include('character._pet_bonding_info', ['pet' => $pet])
                            @else
                                <div class="ml-2 mr-3">
                                    <img src="{{ $pet->pet->variantImage($pet->id) }}" style="max-width: 75px;" />
                                    <br>
                                    <span class="text-light badge badge-dark" style="font-size:95%;">{!! $pet->pet_name !!}</span>
                                </div>
                            @endif
                        @endforeach
                        <div class="ml-auto float-right mr-3">
                            <a href="{{ $character->url . '/pets' }}" class="btn btn-outline-info btn-sm">View All</a>
                        </div>
                    </div>
                @endif
                @if (count($image->character->equipment()))
                    <div class="mb-1 mt-4">
                        <div class="mb-0">
                            <h5>Equipment</h5>
                        </div>
                        <div class="text-center row">
                            @foreach ($image->character->equipment()->take(5) as $equipment)
                                <div class="col-md-2">
                                    @if ($equipment->has_image)
                                        <img class="rounded" src="{{ $equipment->imageUrl }}" data-toggle="tooltip" title="{{ $equipment->equipment->name }}" style="max-width: 75px;" />
                                    @elseif($equipment->equipment->imageurl)
                                        <img class="rounded" src="{{ $equipment->equipment->imageUrl }}" data-toggle="tooltip" title="{{ $equipment->equipment->name }}" style="max-width: 75px;" />
                                    @else
                                        {!! $equipment->equipment->displayName !!}
                                    @endif
                                </div>
                            @endforeach
                        </div>
                        <div class="float-right">
                            <a href="{{ $character->url . '/stats' }}">View All...</a>
                        </div>
                    </div>
                @endif
            </div>

            {{-- Image notes --}}
            <div class="tab-pane fade" id="notes-{{ $image->id }}">
                @if ($image->parsed_description)
                    <div class="parsed-text imagenoteseditingparse">{!! $image->parsed_description !!}</div>
                @else
                    <div class="imagenoteseditingparse">No bio yet!</div>
                @endif
                @if (Auth::check() && Auth::user()->hasPower('manage_characters'))
                    <div class="mt-3">
                        <a href="#" class="btn btn-outline-info btn-sm edit-notes" data-id="{{ $image->id }}"><i class="fas fa-cog"></i> Add bio</a>
                    </div>
                @endif
            </div>

            {{-- Image credits --}}
            <div class="tab-pane fade" id="credits-{{ $image->id }}">

                <div class="row mb-2">
                    <div class="col-lg-4 col-md-6 col-4">
                        <h6><b>Design</b></h6>
                    </div>
                    <div class="col-lg-8 col-md-6 col-8">
                        @foreach ($image->designers as $designer)
                            <div>{!! $designer->displayLink() !!}</div>
                        @endforeach
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-4 col-md-6 col-4">
                        <h6><b>Art</b></h6>
                    </div>
                    <div class="col-lg-8 col-md-6 col-8">
                        @foreach ($image->artists as $artist)
                            <div>{!! $artist->displayLink() !!}</div>
                        @endforeach
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-4 col-md-6 col-4"><h6><b>Created</b></h6></div>
                </div>

                @if (Auth::check() && Auth::user()->hasPower('manage_characters'))
                    <div class="mt-3">
                        <a href="#" class="btn btn-outline-info btn-sm edit-credits" data-id="{{ $image->id }}"><i class="fas fa-cog"></i> Edit</a>
                    </div>
                @endif
            </div>

            @if (isset($showMention) && $showMention)
                {{-- Mention This tab --}}
                <div class="tab-pane fade" id="mention-{{ $image->id }}">
                    In the rich text editor:
                    <div class="alert alert-secondary">
                        [character={{ $character->slug }}]
                    </div>
                    In a comment:
                    <div class="alert alert-secondary">
                        [{{ $character->fullName }}]({{ $character->url }})
                    </div>
                    <hr>
                    <div class="my-2">
                        <strong>For Thumbnails:</strong>
                    </div>
                    In the rich text editor:
                    <div class="alert alert-secondary">
                        [charthumb={{ $character->slug }}]
                    </div>
                    In a comment:
                    <div class="alert alert-secondary">
                        [![Thumbnail of {{ $character->fullName }}]({{ $character->image->thumbnailUrl }})]({{ $character->url }})
                    </div>
                </div>
            @endif

            @if (Auth::check() && Auth::user()->hasPower('manage_characters'))
                <div class="tab-pane fade" id="settings-{{ $image->id }}">
                    {!! Form::open(['url' => 'admin/character/image/' . $image->id . '/settings']) !!}
                    <div class="form-group">
                        {!! Form::checkbox('is_visible', 1, $image->is_visible, ['class' => 'form-check-input', 'data-toggle' => 'toggle']) !!}
                        {!! Form::label('is_visible', 'Is Viewable', ['class' => 'form-check-label ml-3']) !!} {!! add_help('If this is turned off, the image will not be visible by anyone without the Manage Masterlist power.') !!}
                    </div>
                    <div class="form-group">
                        {!! Form::checkbox('is_valid', 1, $image->is_valid, ['class' => 'form-check-input', 'data-toggle' => 'toggle']) !!}
                        {!! Form::label('is_valid', 'Is Valid', ['class' => 'form-check-label ml-3']) !!} {!! add_help('If this is turned off, the image will still be visible, but displayed with a note that the image is not a valid reference.') !!}
                    </div>
                    <div class="text-right">
                        {!! Form::submit('Edit', ['class' => 'btn btn-primary']) !!}
                    </div>
                    {!! Form::close() !!}
                    <hr />
                    <div class="text-right">
                        @if ($character->character_image_id != $image->id)
                            <a href="#" class="btn btn-outline-info btn-sm active-image" data-id="{{ $image->id }}">Set Active</a>
                        @endif <a href="#" class="btn btn-outline-info btn-sm reupload-image" data-id="{{ $image->id }}">Reupload Image</a> <a href="#" class="btn btn-outline-danger btn-sm delete-image"
                            data-id="{{ $image->id }}">Delete</a>
                    </div>
                </div>
            @endif
        </div>
    </div>

</div>
