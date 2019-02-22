@php
$blogs = \App\Models\Blog::all();
@endphp

<table style="color: rgba(37, 37, 37, 0.7);">
  <thead>
    <tr>
      <th style="background: rgba(199, 199, 199, 0.65); border:  1px solid rgba(37, 37, 37, 0.7);  padding: 8px;"> id </th>
      <th style="background: rgba(199, 199, 199, 0.65); border:  1px solid rgba(37, 37, 37, 0.7);  padding: 8px;"> title </th>
      <th style="background: rgba(199, 199, 199, 0.65); border:  1px solid rgba(37, 37, 37, 0.7);  padding: 8px;"> caption </th>
      <th style="background: rgba(199, 199, 199, 0.65); border:  1px solid rgba(37, 37, 37, 0.7);  padding: 8px;"> desc </th>
      <th style="background: rgba(199, 199, 199, 0.65); border:  1px solid rgba(37, 37, 37, 0.7);  padding: 8px;"> draft </th>
      <th style="background: rgba(199, 199, 199, 0.65); border:  1px solid rgba(37, 37, 37, 0.7);  padding: 8px;"> created at </th>
      <th style="background: rgba(199, 199, 199, 0.65); border:  1px solid rgba(37, 37, 37, 0.7);  padding: 8px;"> user id </th>
      <th style="background: rgba(199, 199, 199, 0.65); border:  1px solid rgba(37, 37, 37, 0.7);  padding: 8px;"> slug </th>
    </tr>
  </thead>
  <tbody>
    @foreach ($blogs as $blog)
    <tr>
      <td style="border: 1px solid  rgba(37, 37, 37, 0.7);  padding: 8px;  text-align: center !important;"> {{ $blog['id'] }} </td>
      <td style="border: 1px solid  rgba(37, 37, 37, 0.7);  padding: 8px;  text-align: center !important;"> {{ $blog['title'] }} </td>
      <td style="border: 1px solid  rgba(37, 37, 37, 0.7);  padding: 8px;  text-align: center !important;"> {{ $blog['caption'] }} </td>
      <td style="border: 1px solid  rgba(37, 37, 37, 0.7);  padding: 8px;  text-align: center !important;"> {{ $blog['desc'] }} </td>
      <td style="border: 1px solid  rgba(37, 37, 37, 0.7);  padding: 8px;  text-align: center !important;"> {{ $blog['draft'] }} </td>
      <td style="border: 1px solid  rgba(37, 37, 37, 0.7);  padding: 8px;  text-align: center !important;"> {{ showDate($blog['created_at']) }} </td>
      <td style="border: 1px solid  rgba(37, 37, 37, 0.7);  padding: 8px;  text-align: center !important;"> {{ $blog['user_id'] }} </td>
      <td style="border: 1px solid  rgba(37, 37, 37, 0.7);  padding: 8px;  text-align: center !important;"> {{ $blog['slug'] }} </td>
    </tr>
    @endforeach
  </tbody>
</table>
