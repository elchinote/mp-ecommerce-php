<?PHP 

// SDK de Mercado Pago
require __DIR__ .  '/vendor/autoload.php';

MercadoPago\SDK::setAccessToken('APP_USR-6317427424180639-042414-47e969706991d3a442922b0702a0da44-469485398');

$type = isset($_GET["type"]) ? $_GET["type"] : isset($_POST["type"]) ? $_POST["type"] : null;
$id = isset($_GET["id"]) ? $_GET["id"] : isset($_POST["id"]) ? $_POST["id"] : null;

$datos = [
    'type' => $_GET['type'],
    'topic' => $_GET['topic'],
    'id' => $_GET['id'],
];
  

if($_GET['topic']=="payment" || $_GET['topic'=="merchant_order"]){

    /* Guardo la información en un archivo de registro temporal para auditar los hooks */
    file_put_contents('webhook.log', json_encode($datos) . PHP_EOL,FILE_APPEND);
}

switch ($type) {
    case "payment":
        $payment = MercadoPago\Payment::find_by_id($id);
        if (!empty($payment)) {
            header("HTTP/1.1 200 OK");

        } else {
            header("HTTP/1.1 400 NOT_OK");
        }
        break;
    case "plan":
        $plan = MercadoPago\Plan::find_by_id($id);
        if (!empty($plan)) {
            header("HTTP/1.1 200 OK");
        } else {
            header("HTTP/1.1 400 NOT_OK");
        }
        break;
    case "subscription":
        $plan = MercadoPago\Subscription::find_by_id($id);
        if (!empty($plan)) {
            header("HTTP/1.1 200 OK");
        } else {
            header("HTTP/1.1 400 NOT_OK");
        }
        break;
    case "invoice":
        $plan = MercadoPago\Invoice::find_by_id($id);
        if (!empty($plan)) {
            header("HTTP/1.1 200 OK");
        } else {
            header("HTTP/1.1 400 NOT_OK");
        }
        break;
    default:
        header("HTTP/1.1 200 OK");
        break;
      
}

?>