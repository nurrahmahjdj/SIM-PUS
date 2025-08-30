<!DOCTYPE html>
<html>
<head>
<style>
  h1 {text-align: center;}

#report {
  font-family: Arial, Helvetica, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

#report td, #report th {
  border: 1px solid #ddd;
  padding: 8px;
}

#report tr:nth-child(even){background-color: #f2f2f2;}

#report tr:hover {background-color: #ddd;}

#report th {
  padding-top: 12px;
  padding-bottom: 12px;
  text-align: left;
  background-color: #8d04b9;
  color: white;
}
</style>
</head>
<body>

<h1>Laporan Karya Ilmiah</h1>

<table id="report">
  <tr>
    <th>No</th>
    <th>Tipe</th>
    <th>Judul/No HKI</th>
    <th>Rumpun</th>
    <th>Tanggal Terbit</th>
  </tr>
  @php
      $no=1;
  @endphp
  @foreach ($data as $karyailmiah)
  <tr>
    <td>{{ $no++ }}</td>
    <td>{{ $karyailmiah->tipe }}</td>
    <td>{{ $karyailmiah->judul?? $karyailmiah->no_hki }}</td>
    <td>{{ $karyailmiah->rumpun->nama?? '-' }}</td>
    <td>{{ $karyailmiah->created_at }}</td>
  </tr>

  @endforeach

</table>

</body>
</html>
