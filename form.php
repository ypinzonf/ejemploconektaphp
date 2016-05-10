<script type="text/javascript">
 
 // Conekta Public Key
    Conekta.setPublishableKey('key_KJysdbf6PotS2ut2');

 
 // ...
</script>

<form action="cargo.php" method="POST" id="card-form">
  <span class="card-errors"></span>
  <div class="form-row">
    <label>
      <span>Nombre del tarjetahabiente</span>
      <input type="text" size="20" data-conekta="card[name]"/>
    </label>
  </div>
  <div class="form-row">
    <label>
      <span>Número de tarjeta de crédito</span>
      <input type="text" size="20" data-conekta="card[number]"/>
    </label>
  </div>
  <div class="form-row">
    <label>
      <span>CVC</span>
      <input type="text" size="4" data-conekta="card[cvc]"/>
    </label>
  </div>
  <div class="form-row">
    <label>
      <span>Fecha de expiración (MM/AAAA)</span>
      <input type="text" size="2" data-conekta="card[exp_month]"/>
    </label>
    <span>/</span>
    <input type="text" size="4" data-conekta="card[exp_year]"/>
  </div>
<!-- Información recomendada para sistema antifraude -->
  <div class="form-row">
    <label>
      <span>Calle</span>
      <input type="text" size="25" data-conekta="card[address][street1]"/>
    </label>
  </div>
<div class="form-row">
    <label>
      <span>Colonia</span>
      <input type="text" size="25" data-conekta="card[address][street2]"/>
    </label>
  </div>
<div class="form-row">
    <label>
      <span>Ciudad</span>
      <input type="text" size="25" data-conekta="card[address][city]"/>
    </label>
  </div>
<div class="form-row">
    <label>
      <span>Estado</span>
      <input type="text" size="25" data-conekta="card[address][state]"/>
    </label>
  </div>
<div class="form-row">
    <label>
      <span>CP</span>
      <input type="text" size="5" data-conekta="card[address][zip]"/>
    </label>
  </div>
<div class="form-row">
    <label>
      <span>País</span>
      <input type="text" size="25" data-conekta="card[address][country]"/>
    </label>
  </div>
  <button type="submit">¡Pagar ahora!</button>
</form>

<script type="text/javascript">
$(function () {
  $("#card-form").submit(function(event) {
    var $form = $(this);

    // Previene hacer submit más de una vez
    $form.find("button").prop("disabled", true);
    Conekta.token.create($form, conektaSuccessResponseHandler, conektaErrorResponseHandler);
   
    // Previene que la información de la forma sea enviada al servidor
    return false;
  });
});

var conektaSuccessResponseHandler = function(token) {
  var $form = $("#card-form");

  /* Inserta el token_id en la forma para que se envíe al servidor */
  $form.append($("<input type='hidden' name='conektaTokenId'>").val(token.id));
 
  /* and submit */
  $form.get(0).submit();
};

var conektaErrorResponseHandler = function(response) {
  var $form = $("#card-form");
  
  /* Muestra los errores en la forma */
  $form.find(".card-errors").text(response.message);
  $form.find("button").prop("disabled", false);
};

</script>

<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script type="text/javascript" src="https://conektaapi.s3.amazonaws.com/v0.3.2/js/conekta.js"></script>