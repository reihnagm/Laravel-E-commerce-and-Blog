@php
$users = \App\Models\User::all();
@endphp

<table style="color: rgba(37, 37, 37, 0.7);">
  <thead>
    <tr>
      <th style="background: rgba(199, 199, 199, 0.65); border:  1px solid rgba(37, 37, 37, 0.7);  padding: 8px;"> id </th>
      <th style="background: rgba(199, 199, 199, 0.65); border:  1px solid rgba(37, 37, 37, 0.7);  padding: 8px;"> name </th>
      <th style="background: rgba(199, 199, 199, 0.65); border:  1px solid rgba(37, 37, 37, 0.7);  padding: 8px;"> email </th>
      <th style="background: rgba(199, 199, 199, 0.65); border:  1px solid rgba(37, 37, 37, 0.7);  padding: 8px;"> created at </th>
    </tr>
  </thead>
  <tbody>
    @foreach ($users as $user)
    <tr>
      <td style="border: 1px solid  rgba(37, 37, 37, 0.7);  padding: 8px;  text-align: center !important;"> {{ $user['id'] }} </td>
      <td style="border: 1px solid  rgba(37, 37, 37, 0.7);  padding: 8px;  text-align: center !important;"> {{ $user['name'] }} </td>
      <td style="border: 1px solid  rgba(37, 37, 37, 0.7);  padding: 8px;  text-align: center !important;"> {{ $user['email'] }} </td>
      <td style="border: 1px solid  rgba(37, 37, 37, 0.7);  padding: 8px;  text-align: center !important;"> {{ showDate($user['created_at']) }} </td>
    </tr>
    @endforeach
  </tbody>
</table>
