<div class="mb-3">
    <label for="user_id" class="form-label">Usuario</label>
    <select name="user_id" id="user_id" class="form-select" required>
        @foreach($users as $user)
            <option value="{{ $user->id }}" {{ (old('user_id', $reservation->user_id) == $user->id) ? 'selected' : '' }}>{{ $user->name }}</option>
        @endforeach
    </select>
</div>

<div class="mb-3">
    <label for="activity_id" class="form-label">Actividad</label>
    <select name="activity_id" id="activity_id" class="form-select" required>
        @foreach($activities as $activity)
            <option value="{{ $activity->id }}" {{ (old('activity_id', $reservation->activity_id) == $activity->id) ? 'selected' : '' }}>{{ $activity->title }}</option>
        @endforeach
    </select>
</div>

<div class="mb-3">
    <label for="execution_date" class="form-label">Fecha de realización</label>
    <input type="date" name="execution_date" id="execution_date" class="form-control" value="{{ old('execution_date', optional($reservation->execution_date)->format('Y-m-d')) }}" required>
</div>

<div class="mb-3">
    <label for="people" class="form-label">Personas</label>
    <input type="number" name="people" id="people" class="form-control" min="1" value="{{ old('people', $reservation->people) }}" required>
</div>

<div class="mb-3">
    <label for="total_price" class="form-label">Total</label>
    <input type="number" step="0.01" name="total_price" id="total_price" class="form-control" value="{{ old('total_price', $reservation->total_price) }}" required>
</div>

<button type="submit" class="btn btn-primary">Guardar</button>
<a href="{{ route('admin.reservations.index') }}" class="btn btn-secondary">Cancelar</a>