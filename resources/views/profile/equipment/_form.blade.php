@php $e = $equipment ?? null; @endphp

<div class="mb-3">
    <label class="form-label">Equipment name</label>
    <input type="text" name="equipment_name" class="form-control @error('equipment_name') is-invalid @enderror"
           value="{{ old('equipment_name', $e->equipment_name ?? '') }}">
    @error('equipment_name') <div class="invalid-feedback">{{ $message }}</div> @enderror
</div>

<div class="mb-3">
    <label class="form-label">Category</label>
    <select name="category" class="form-select @error('category') is-invalid @enderror">
        <option value="">-- Select --</option>
        @foreach (\App\Models\Equipment::CATEGORIES as $cat)
            <option value="{{ $cat }}" @selected(old('category', $e->category ?? '') === $cat)>{{ $cat }}</option>
        @endforeach
    </select>
    @error('category') <div class="invalid-feedback">{{ $message }}</div> @enderror
</div>

<div class="mb-3">
    <label class="form-label">Unit price</label>
    <input type="text" name="unit_price" class="form-control @error('unit_price') is-invalid @enderror"
           value="{{ old('unit_price', $e->unit_price ?? '') }}">
    @error('unit_price') <div class="invalid-feedback">{{ $message }}</div> @enderror
</div>

<div class="mb-3">
    <label class="form-label">Description</label>
    <textarea name="description" rows="3" class="form-control @error('description') is-invalid @enderror">{{ old('description', $e->description ?? '') }}</textarea>
    @error('description') <div class="invalid-feedback">{{ $message }}</div> @enderror
</div>

<div class="mb-3">
    <label class="form-label">Availability</label>
    <select name="availability_status" class="form-select @error('availability_status') is-invalid @enderror">
        <option value="">-- Select --</option>
        @foreach (\App\Models\Equipment::STATUSES as $s)
            <option value="{{ $s }}" @selected(old('availability_status', $e->availability_status ?? '') === $s)>{{ $s }}</option>
        @endforeach
    </select>
    @error('availability_status') <div class="invalid-feedback">{{ $message }}</div> @enderror
</div>