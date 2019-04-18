@component('mail::message')

È arrivato un nuovo ordine dallo store **ma il pagamento non è andato a buon fine**

<br>
#Riepilogo dell'ordine
-----
<br>

<table style="width: 100%;">
  <thead>
    <th style="text-align: left;">Prodotto</th>
    <th style="text-align: left;">Quantità</th>
    <th style="text-align: left;">Prezzo unitario</th>
    <th style="text-align: left;">Prezzo</th>
  </thead>
  @foreach ($items as $item)
    <tbody>
      <tr>
        <td>{{ $item['title'] }}</td>
        <td>{{ $item['quantity'] }}</td>
        <td>€ {{ number_format((float) $item['price'], 2, '.', '') }}</td>
        <td>€ {{ number_format((float) $item['pricetot'], 2, '.', '') }}</td>
      </tr>
    </tbody>
  @endforeach
  <tbody>
    <tr>
      <td colspan="4"><br></td>
    </tr>
  </tbody>
  <tbody>
    <tr valign="middle">
      <td colspan="3"><h3>Subtotale</h3></td>
      <td><h3>€ {{ number_format((float)$amount, 2, '.', '') }}</h3></td>
    </tr>
  </tbody>
  <tbody>
    <tr valign="middle">
      <td colspan="3"><h3>Spedizione</h3></td>
      <td><h3>€ 00.00</h3></td>
    </tr>
  </tbody>
  <tbody>
    <tr>
      <td colspan="4"><br></td>
    </tr>
  </tbody>
  <tbody>
    <tr valign="middle">
      <td colspan="3"><h1>Totale</h1></td>
      <td><h1>€ {{ number_format((float)$amount, 2, '.', '') }}</h1></td>
    </tr>
  </tbody>
</table>
<br>
#Dettagli
-----
<br>
codice identificativo dell'ordine **{{ $order->id }}**.

Per verificare i dettagli dell'ordine, accedi al [Pannello di amministrazione]({{ env('APP_URL').'/admin' }})
<br>
<br>
@endcomponent
