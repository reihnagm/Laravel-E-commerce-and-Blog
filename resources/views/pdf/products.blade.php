

@php
$products = \App\Models\Product::all();
@endphp

<table style="color: rgba(37, 37, 37, 0.7); ">
  <thead>
    <tr>
      <th style="background: rgba(199, 199, 199, 0.65); border:  1px solid rgba(37, 37, 37, 0.7);  padding: 8px;"> id </th>
      <th style="background: rgba(199, 199, 199, 0.65); border:  1px solid rgba(37, 37, 37, 0.7);  padding: 8px;"> name </th>
      <th style="background: rgba(199, 199, 199, 0.65); border:  1px solid rgba(37, 37, 37, 0.7);  padding: 8px;"> desc </th>
      <th style="background: rgba(199, 199, 199, 0.65); border:  1px solid rgba(37, 37, 37, 0.7);  padding: 8px;"> price </th>
      <th style="background: rgba(199, 199, 199, 0.65); border:  1px solid rgba(37, 37, 37, 0.7);  padding: 8px;"> created at </th>
      <th style="background: rgba(199, 199, 199, 0.65); border:  1px solid rgba(37, 37, 37, 0.7);  padding: 8px;"> user id </th>
      <th style="background: rgba(199, 199, 199, 0.65); border:  1px solid rgba(37, 37, 37, 0.7);  padding: 8px;"> slug </th>
    </tr>
  </thead>
  <tbody>
    @foreach ($products as $product)
    <tr>
      <td style="border: 1px solid  rgba(37, 37, 37, 0.7);  padding: 8px;  text-align: center !important;"> {{ $product['id'] }} </td>
      <td style="border: 1px solid  rgba(37, 37, 37, 0.7);  padding: 8px;  text-align: center !important;"> {{ $product['name'] }} </td>
      <td style="border: 1px solid  rgba(37, 37, 37, 0.7);  padding: 8px;  text-align: center !important;"> {{ $product['desc'] }} </td>
      <td style="border: 1px solid  rgba(37, 37, 37, 0.7);  padding: 8px;  text-align: center !important;"> {{ $product['price'] }} </td>
      <td style="border: 1px solid  rgba(37, 37, 37, 0.7);  padding: 8px;  text-align: center !important;"> {{ showDate($product['created_at']) }} </td>
      <td style="border: 1px solid  rgba(37, 37, 37, 0.7);  padding: 8px;  text-align: center !important;"> {{ $product['user_id'] }} </td>
      <td style="border: 1px solid  rgba(37, 37, 37, 0.7);  padding: 8px;  text-align: center !important;"> {{ $product['slug'] }} </td>
    </tr>
    @endforeach
  </tbody>
</table>
