<?php 

$ERRORES=0;
$DEPURACION=1;

if ($ERRORES==1){    
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
}


echo "ID: " . $_GET["preapproval_id"];




@$CollectionID=$_GET['collection_id'];
@$CollectionStatus=$_GET['collection_status'];
@$PreferenceID=$_GET['preference_id'];
@$ExternalReference=$_GET['external_reference'];
@$PaymentType=$_GET['payment_type'];
@$MerchantOrderID=$_GET['merchant_order_id'];
@$CompraID=$ExternalReference;


if ($DEPURACION==1){    
    echo "CollectionID: " . $CollectionID . "<br>";
    echo "CollectionStatus: " . $CollectionStatus . "<br>";
    echo "PreferenceID: " . $PreferenceID . "<br>";
    echo "ExternalReference: " . $ExternalReference . "<br>";
    echo "PaymentType: " . $PaymentType . "<br>";
    echo "MerchantOrderID: " . $MerchantOrderID . "<br>";
}

//Defino las rutas a redireccionar según el estado
$RutaPagoPendiente="carrito-pagopendiente.php";
$RutaPagoRealizado="carrito-pagoconfirmado-confirmacion.php";
$RutaPagoRealizado="voucher-emision-procesar.php?uid=" . base64_encode($CompraID);
$RutaPagoEnProceso="carrito-pagoenproceso.php";
$RutaPagoRechazado="carrito-pagofallido.php";



//ESTADOS DE PAGO - MERCADOPAGO
// pending         -> El usuario aún no completó el proceso de pago.
// approved        -> El pago fue aprobado y acreditado.
// in_process      -> El pago está siendo revisado.
// in_mediation    -> Los usuarios tienen iniciada una disputa.
// rejected        -> El pago fue rechazado. El usuario puede intentar pagar nuevamente.
// cancelled       -> El pago fue cancelado por una de las partes, o porque el tiempo expiró.
// refunded        -> El pago fue devuelto al usuario.
// charged_back    -> Fue hecho un contracargo en la tarjeta del pagador.

//ESTADO DE PAGO - GIFT CERTIFICATE
//1 - Pendiente
//2 - Pago Realizado
//3 - Pago Rechazado
//4 - Cancelado
//5 - En Proceso
//6 - En Mediación
//7 - Devuelto
//8 - Contracargo


switch($CollectionStatus){
    case "pending": $Destino=$RutaPagoPendiente; break;
    case "approved": $Destino=$RutaPagoRealizado; break;
    case "in_process": $Destino=$RutaPagoEnProceso; break;
    case "in_mediation": $Destino=$RutaPagoEnProceso; break;
    case "rejected": $Destino=$RutaPagoRechazado; break;
    case "cancelled": $Destino=$RutaPagoRechazado; break;
    case "refunded": $Destino=$RutaPagoRechazado; break;
    case "charged_back": $Destino=$RutaPagoPendiente; break;
    default: $Destino=$RutaPagoRechazado; break;
}

header("location: " . $Destino);

?>





