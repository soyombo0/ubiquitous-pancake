<div class="card">
    <div class="card-body">
        <h5 class="card-title">{{ $taxi->original->name }}</h5>
        <h6 class="card-subtitle mb-2 text-muted">{{ $taxi->price }} руб.</h6>
        <h6 class="card-subtitle">Текущий цвет машины: {{$taxi->original->color?->name}}</h6>
    </div>
    <form action="{{ route('taxi.change.color', ['taxi' => $taxi->original->id]) }}" method="POST">
        @csrf
        <select name="taxiColor" class="form-control">
            @foreach($taxiColors as $taxiColor)
                <option class="form-select"  value="{{ $taxiColor->id }}">{{ $taxiColor->name }}</option>
            @endforeach
        </select>
        <button type="submit" class="btn btn-primary">Покрасить</button>
    </form>
</div>
