<?php
require_once 'vendor/autoload.php';

class PagoController
{
    public static function crearSesionStripe()
    {
        \Stripe\Stripe::setApiKey("sk_test_51TkqsR2HMVshp8hWMi6j0EJq1OzBAEWUMVSMpjizV4UJrfO8I7S8KXZ0fdFGSItxzGUlkqkHy0HiZZcevqG2tvpJ00uNw8rDac");

        $input = json_decode(file_get_contents("php://input"), true);
        $id_usuario = $input["id_usuario"] ?? null;

        if (!$id_usuario) {
            http_response_code(400);
            echo json_encode(["error" => "No se recibió el usuario"]);
            return;
        }

        try {
            $session = \Stripe\Checkout\Session::create([
                "payment_method_types" => ["card"],
                "line_items" => [
                    [
                        "price_data" => [
                            "currency" => "mxn",
                            "product_data" => ["name" => "YMI Premium"],
                            "unit_amount" => 9900
                        ],
                        "quantity" => 1
                    ]
                ],
                "mode" => "payment",
                "success_url" => "https://ymi-repo-mfqa5go9e-mariel125vertzs-projects.vercel.app/premium?status=success",
                "cancel_url" => "https://ymi-repo-mfqa5go9e-mariel125vertzs-projects.vercel.app/premium?status=cancel"
            ]);

            echo json_encode(["url" => $session->url]);

        } catch (Exception $e) {
            http_response_code(500);
            echo json_encode(["error" => $e->getMessage()]);
        }
    }

    public static function activarPremium($conexion, $id_usuario)
    {
        $stmt = $conexion->prepare("UPDATE usuarios SET es_premium = 1 WHERE id_usuario = ?");
        

        $stmt->bind_param("i", $id_usuario);
        $stmt->execute();

        echo json_encode(["mensaje" => "Premium activado"]);
    }

    public static function verificarPremium($conexion, $id_usuario)
    {
        $stmt = $conexion->prepare("SELECT es_premium FROM usuarios WHERE id_usuario = ?");
        $stmt->bind_param("i", $id_usuario);
        $stmt->execute();
        $resultado = $stmt->get_result()->fetch_assoc();

        echo json_encode(["es_premium" => (bool) ($resultado["es_premium"] ?? false)]);
    }
}