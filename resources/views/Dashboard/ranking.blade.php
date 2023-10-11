<thead>
    <tr>
        <th style="width: 30%"></th>
        @foreach ($kriteria as $dataKriteria)
            <th>
                {{ $dataKriteria->nama_kriteria }}
            </th>
        @endforeach
        <th rowspan="2" style="text-align: center; padding-bottom: 30px; width:100px">
            Total
        </th>
        <th rowspan="2" style="text-align: center; padding-bottom: 30px; width:50px">
            Rank
        </th>
    </tr>
    <th>Bobot</th>
    @foreach ($kriteria as $dataKriteria)
        <th>
            {{ $dataKriteria->bobot * 100 }}%
        </th>
    @endforeach
    </tr>
</thead>
<tbody>
    @php
        $no = 1;
    @endphp
    @foreach ($ranking as $key => $value)
        <tr>
            <td>{{ $key }}</td>
            @foreach ($value as $key_1 => $value_1)
                <td>
                    {{ number_format($value_1, 2) }}
                </td>
            @endforeach
            <td>{{ $no++ }}</td>
        </tr>
    @endforeach
