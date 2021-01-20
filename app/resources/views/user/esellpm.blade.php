
<form action="https://perfectmoney.is/api/step1.asp" method="POST" id="payment_form">
    <input type="hidden" name="PAYEE_ACCOUNT" value="{{$gatewayData->val1}}">
    <input type="hidden" name="PAYEE_NAME" value="{{$gnl->sitename}}">
    <input type="hidden" name="PAYMENT_ID" value="{{ $data->trx }}">
    <input type="hidden" name="PAYMENT_AMOUNT" value="{{$data->amount}}">
    <input type="hidden" name="PAYMENT_UNITS" value="USD">
    <input type="hidden" name="STATUS_URL" value="{{route('sellperfectsuccess')}}">
    <input type="hidden" name="PAYMENT_URL" value="{{route('sellperfectsuccess')}}">
    <input type="hidden" name="PAYMENT_URL_METHOD" value="GET">
    <input type="hidden" name="NOPAYMENT_URL" value="{{route('trade')}}">
    <input type="hidden" name="NOPAYMENT_URL_METHOD" value="GET">
    <input type="hidden" name="SUGGESTED_MEMO" value="{{Auth::user()->username}}">
    <input type="hidden" name="BAGGAGE_FIELDS" value="IDENT"><br>
</form>

<script>
    document.getElementById("payment_form").submit();
</script>

