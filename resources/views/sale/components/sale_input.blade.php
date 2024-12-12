<div class="input-style-1">
    <label>Tanggal</label>
    <input type="date" placeholder="Tanggal Transaksi" name="date" 
    value="{{ old('date', \Carbon\Carbon::now()->toDateString()) }}" required readonly>
</div>
<div class="input-style-1">
    <label>Konsumen</label>
    <input type="text" placeholder="Konsumen" name="consumer" value="{{ old('consumer') }}" required>
</div>
<div class="input-style-1">
    <label>Nama Kasir</label>
    <div class="select-style-1">
        <div class="select-position">
            <select name="store_name" id="" required>
                <option value="" selected>Pilih Kasir</option>
                <option @selected(old('store_name') == 'Linda') value="Linda">Linda</option>
                <option @selected(old('store_name') == 'Arin') value="Arin">Arin</option>
                <option @selected(old('store_name') == 'Vera') value="Vera">Vera</option>
                <option @selected(old('store_name') == 'Ika') value="Ika">Ika</option>
                <option @selected(old('store_name') == 'Tika') value="Tika">Tika</option>
                <option @selected(old('store_name') == 'Atin') value="Atin">Atin</option>
            </select>
        </div>
    </div>
</div>
{{-- <div class="input-style-1">
    <label>Dibawa Oleh</label>
    <input type="text" placeholder="Dibawa Oleh" name="brought_by" value="{{ old('brought_by') }}">
</div> --}}
