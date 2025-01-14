@php
    // This file represents a common source and definition for assets used in loot_select
    // While it is not per se as tidy as defining these in the controller(s),
    // doing so this way enables better compatibility across disparate extensions
    $characterCurrencies = \App\Models\Currency\Currency::where('is_character_owned', 1)
        ->orderBy('sort_character', 'DESC')
        ->pluck('name', 'id');
    $items = \App\Models\Item\Item::orderBy('name')->pluck('name', 'id');
    $pets = \App\Models\Pet\Pet::orderBy('name')->pluck('name', 'id');
    $currencies = \App\Models\Currency\Currency::where('is_user_owned', 1)
        ->orderBy('name')
        ->pluck('name', 'id');
    $gears = \App\Models\Claymore\Gear::orderBy('name')->pluck('name', 'id');
    $weapons = \App\Models\Claymore\Weapon::orderBy('name')->pluck('name', 'id');
    $pets = \App\Models\Pet\Pet::orderBy('name')->pluck('name', 'id');
    $stats =
        ['none' => 'General Point'] +
        \App\Models\Stat\Stat::orderBy('name')
            ->pluck('name', 'id')
            ->toArray();
    if ($showLootTables) {
        $tables = \App\Models\Loot\LootTable::orderBy('name')->pluck('name', 'id');
    }
    if ($showRaffles) {
        $raffles = \App\Models\Raffle\Raffle::where('rolled_at', null)
            ->where('is_active', 1)
            ->orderBy('name')
            ->pluck('name', 'id');
    }
@endphp

<div id="lootRowData" class="hide">
    <table class="table table-sm">
        <tbody id="lootRow">
            <tr class="loot-row">
                <td>{!! Form::select(
                    'rewardable_type[]',
                    ['Item' => 'Item', 'Currency' => 'Currency', 'Pet' => 'Pet', 'Gear' => 'Gear', 'Weapon' => 'Weapon', 'Exp' => 'Exp', 'Points' => 'Stat Points'] +
                        ($showLootTables ? ['LootTable' => 'Loot Table'] : []) +
                        ($showRaffles ? ['Raffle' => 'Raffle Ticket'] : []),
                    null,
                    ['class' => 'form-control reward-type', 'placeholder' => 'Select Reward Type'],
                ) !!}</td>
                <td class="loot-row-select"></td>
                <td>{!! Form::text('quantity[]', 1, ['class' => 'form-control']) !!}</td>
                <td class="text-right"><a href="#" class="btn btn-danger remove-loot-button">Remove</a></td>
            </tr>
        </tbody>
    </table>
    {!! Form::select('rewardable_id[]', $items, null, ['class' => 'form-control item-select', 'placeholder' => 'Select Item']) !!}
    {!! Form::select('rewardable_id[]', $currencies, null, ['class' => 'form-control currency-select', 'placeholder' => 'Select Currency']) !!}
    {!! Form::select('rewardable_id[]', $pets, null, ['class' => 'form-control pet-select', 'placeholder' => 'Select Pet']) !!}
    {!! Form::select('rewardable_id[]', $weapons, null, ['class' => 'form-control weapon-select', 'placeholder' => 'Select Weapon']) !!}
    {!! Form::select('rewardable_id[]', $gears, null, ['class' => 'form-control gear-select', 'placeholder' => 'Select Gear']) !!}
    {!! Form::select('rewardable_id[]', $stats, null, ['class' => 'form-control stat-select', 'placeholder' => 'Select Stat']) !!}
    {!! Form::select('rewardable_id[]', [0 => 1], 0, ['class' => 'form-control claymore-select hide', 'placeholder' => 'Enter Reward']) !!}
    @if ($showLootTables)
        {!! Form::select('rewardable_id[]', $tables, null, ['class' => 'form-control table-select', 'placeholder' => 'Select Loot Table']) !!}
    @endif
    @if ($showRaffles)
        {!! Form::select('rewardable_id[]', $raffles, null, ['class' => 'form-control raffle-select', 'placeholder' => 'Select Raffle']) !!}
    @endif
</div>
